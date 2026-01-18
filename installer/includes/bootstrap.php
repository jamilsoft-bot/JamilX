<?php
// Shared bootstrap for the new installer wizard.
// Defines common paths, session helpers, and basic utilities.

declare(strict_types=1);

session_start();

$installerRoot = dirname(__DIR__);
$appRoot = dirname($installerRoot);
$installerSqlPath = $installerRoot . '/sql.sql';
$installedFlagPath = $appRoot . '/data/installed.lock';

/**
 * Escape output for safe HTML rendering.
 */
function installer_escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

/**
 * Store a flash message in session.
 */
function installer_set_flash(string $type, string $message, array $details = []): void
{
    $_SESSION['installer_flash'] = [
        'type' => $type,
        'message' => $message,
        'details' => $details,
    ];
}

/**
 * Retrieve and clear flash message.
 */
function installer_get_flash(): ?array
{
    if (!isset($_SESSION['installer_flash'])) {
        return null;
    }

    $flash = $_SESSION['installer_flash'];
    unset($_SESSION['installer_flash']);

    return $flash;
}

/**
 * Map installer steps for navigation and validation.
 */
function installer_steps(): array
{
    return [
        'welcome' => 'Welcome',
        'requirements' => 'Requirements',
        'database' => 'Database',
        'install' => 'Install',
        'company' => 'Company Info',
        'admin' => 'Admin Account',
        'success' => 'Complete',
        'failed' => 'Failure',
        'already-installed' => 'Already Installed',
    ];
}

/**
 * Normalize and validate the current step from query string.
 */
function installer_current_step(array $steps): string
{
    $step = isset($_GET['step']) ? (string) $_GET['step'] : 'welcome';

    return array_key_exists($step, $steps) ? $step : 'welcome';
}
