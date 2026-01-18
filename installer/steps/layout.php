<?php
// Shared layout for installer steps with TailwindCSS styling.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo installer_escape($productName); ?> Installer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-900">
    <div class="min-h-screen flex flex-col">
        <header class="bg-white border-b border-slate-200">
            <div class="max-w-5xl mx-auto px-6 py-6 flex items-center gap-4">
                <img src="<?php echo installer_escape($logoPath); ?>" alt="<?php echo installer_escape($productName); ?> logo" class="h-12 w-12">
                <div>
                    <p class="text-sm uppercase tracking-wide text-slate-500">Installer Wizard</p>
                    <h1 class="text-2xl font-semibold text-slate-900"><?php echo installer_escape($productName); ?></h1>
                </div>
            </div>
        </header>

        <main class="flex-1">
            <div class="max-w-5xl mx-auto px-6 py-10">
                <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 md:p-10">
                    <?php if (!in_array($currentStep, ['success', 'failed', 'already-installed'], true)) : ?>
                        <div class="flex flex-wrap items-center gap-4 mb-8">
                            <?php foreach ($orderedSteps as $index => $stepKey) : ?>
                                <?php
                                    $isActive = $currentStep === $stepKey;
                                    $isComplete = array_search($currentStep, $orderedSteps, true) > $index;
                                    $baseClasses = 'flex items-center gap-3 px-4 py-2 rounded-full border text-sm font-medium';
                                    $stateClasses = $isActive ? 'border-blue-500 text-blue-600 bg-blue-50' : ($isComplete ? 'border-emerald-500 text-emerald-600 bg-emerald-50' : 'border-slate-200 text-slate-500');
                                ?>
                                <div class="<?php echo $baseClasses . ' ' . $stateClasses; ?>">
                                    <span class="flex h-7 w-7 items-center justify-center rounded-full border <?php echo $isComplete ? 'border-emerald-500 text-emerald-600' : 'border-slate-300 text-slate-500'; ?>">
                                        <?php echo $index + 1; ?>
                                    </span>
                                    <span><?php echo installer_escape($steps[$stepKey]); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($flash) : ?>
                        <div class="mb-6 rounded-lg border px-4 py-3 <?php echo $flash['type'] === 'error' ? 'border-rose-200 bg-rose-50 text-rose-700' : 'border-emerald-200 bg-emerald-50 text-emerald-700'; ?>">
                            <p class="font-medium"><?php echo installer_escape($flash['message']); ?></p>
                            <?php if (!empty($flash['details'])) : ?>
                                <ul class="mt-2 list-disc pl-5 text-sm">
                                    <?php foreach ($flash['details'] as $detail) : ?>
                                        <li><?php echo installer_escape((string) $detail); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($pageErrors)) : ?>
                        <div class="mb-6 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-rose-700">
                            <p class="font-medium">Please resolve the following:</p>
                            <ul class="mt-2 list-disc pl-5 text-sm">
                                <?php foreach ($pageErrors as $error) : ?>
                                    <li><?php echo installer_escape((string) $error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php
                        // Route to the appropriate step view.
                        switch ($currentStep) {
                            case 'requirements':
                                require __DIR__ . '/requirements.php';
                                break;
                            case 'database':
                                require __DIR__ . '/database.php';
                                break;
                            case 'install':
                                require __DIR__ . '/install.php';
                                break;
                            case 'company':
                                require __DIR__ . '/company.php';
                                break;
                            case 'admin':
                                require __DIR__ . '/admin.php';
                                break;
                            case 'success':
                                require __DIR__ . '/success.php';
                                break;
                            case 'failed':
                                require __DIR__ . '/failed.php';
                                break;
                            case 'already-installed':
                                require __DIR__ . '/already-installed.php';
                                break;
                            case 'welcome':
                            default:
                                require __DIR__ . '/welcome.php';
                                break;
                        }
                    ?>
                </div>
            </div>
        </main>

        <footer class="py-6 text-center text-sm text-slate-500">
            &copy; <?php echo date('Y'); ?> Jamilsoft. All rights reserved.
        </footer>
    </div>

    <script>
        // Basic client-side validation to enable next buttons only when required fields are filled.
        document.querySelectorAll('[data-validate-form]').forEach((form) => {
            const requiredFields = form.querySelectorAll('[data-required]');
            const submitButton = form.querySelector('[data-submit]');

            const validate = () => {
                let valid = true;
                requiredFields.forEach((field) => {
                    if (!field.value.trim()) {
                        valid = false;
                    }
                    if (field.type === 'email' && field.value && !field.value.includes('@')) {
                        valid = false;
                    }
                });
                if (submitButton) {
                    submitButton.disabled = !valid;
                    submitButton.classList.toggle('opacity-50', !valid);
                    submitButton.classList.toggle('cursor-not-allowed', !valid);
                }
            };

            requiredFields.forEach((field) => {
                field.addEventListener('input', validate);
            });

            validate();
        });
    </script>
</body>
</html>
