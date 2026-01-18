<?php
// Entry point for the refreshed installer wizard UI.

declare(strict_types=1);

require __DIR__ . '/includes/bootstrap.php';
require __DIR__ . '/includes/installer_logic.php';

$steps = installer_steps();
$currentStep = installer_current_step($steps);
$flash = installer_get_flash();

// Ensure legacy Apps directory exists (mirrors old installer behavior).
$appsDir = $appRoot . '/Apps';
if (!is_dir($appsDir)) {
    mkdir($appsDir, 0755, true);
}

$isInstalled = file_exists($installedFlagPath);
if ($isInstalled && $currentStep !== 'already-installed') {
    $currentStep = 'already-installed';
}

$pageErrors = [];
$pageMessage = null;
$formValues = [];
$requirements = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$isInstalled) {
    $action = (string) ($_POST['action'] ?? '');
    $formValues = $_POST;
    foreach ($formValues as $key => $value) {
        if (is_string($value)) {
            $formValues[$key] = trim($value);
        }
    }

    switch ($action) {
        case 'save_db':
            $pageErrors = installer_validate_db($formValues);
            if (empty($pageErrors)) {
                $message = installer_write_config($appRoot, $formValues);
                if (strpos($message, 'Unable') === 0) {
                    $pageErrors[] = $message;
                } else {
                    installer_set_flash('success', $message);
                    header('Location: ?step=install');
                    exit;
                }
            }
            $currentStep = 'database';
            break;
        case 'run_install':
            if (!file_exists($appRoot . '/conf.php')) {
                installer_set_flash('error', 'Configuration file not found. Please complete the database step.');
                header('Location: ?step=database');
                exit;
            }

            include $appRoot . '/conf.php';
            $result = installer_run_sql($installerSqlPath, $DB_Data);

            if (!empty($result['errors'])) {
                installer_set_flash('error', $result['message'], $result['errors']);
                header('Location: ?step=failed');
                exit;
            }

            installer_set_flash('success', $result['message']);
            header('Location: ?step=company');
            exit;
        case 'save_company':
            $pageErrors = installer_validate_company($formValues);
            if (empty($pageErrors)) {
                if (!file_exists($appRoot . '/conf.php')) {
                    $pageErrors[] = 'Configuration file not found.';
                } else {
                    include $appRoot . '/conf.php';
                    $saveErrors = installer_save_company($formValues, $DB_Data);
                    if (!empty($saveErrors)) {
                        $pageErrors = $saveErrors;
                    } else {
                        installer_set_flash('success', 'Company information saved.');
                        header('Location: ?step=admin');
                        exit;
                    }
                }
            }
            $currentStep = 'company';
            break;
        case 'save_admin':
            $pageErrors = installer_validate_admin($formValues);
            if (empty($pageErrors)) {
                if (!file_exists($appRoot . '/conf.php')) {
                    $pageErrors[] = 'Configuration file not found.';
                } else {
                    include $appRoot . '/conf.php';
                    $saveErrors = installer_save_admin($formValues, $DB_Data);
                    if (!empty($saveErrors)) {
                        $pageErrors = $saveErrors;
                    } else {
                        if (!file_exists($installedFlagPath)) {
                            file_put_contents($installedFlagPath, 'installed:' . date('c'));
                        }
                        installer_set_flash('success', 'Installation completed successfully.');
                        header('Location: ?step=success');
                        exit;
                    }
                }
            }
            $currentStep = 'admin';
            break;
        case 'confirm_requirements':
            header('Location: ?step=database');
            exit;
        default:
            break;
    }
}

if ($currentStep === 'requirements') {
    $requirements = installer_requirements($appRoot);
}

$logoPath = '../assets/images/jslogobird.png';
$productName = 'JamilX';
$orderedSteps = ['welcome', 'requirements', 'database', 'install', 'company', 'admin'];

require __DIR__ . '/steps/layout.php';
