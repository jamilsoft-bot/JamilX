<?php
// Requirements check step.
$allGood = true;
foreach ($requirements as $requirement) {
    if (!$requirement['ok']) {
        $allGood = false;
        break;
    }
}
?>
<div>
    <h2 class="text-2xl font-semibold text-slate-900">Server Requirements</h2>
    <p class="mt-2 text-slate-600">Review each requirement below. All checks should pass before proceeding.</p>

    <div class="mt-6 space-y-4">
        <?php foreach ($requirements as $requirement) : ?>
            <div class="flex items-center justify-between rounded-lg border border-slate-200 px-4 py-3">
                <div>
                    <p class="font-medium text-slate-800"><?php echo installer_escape($requirement['label']); ?></p>
                    <p class="text-sm text-slate-500"><?php echo installer_escape($requirement['details']); ?></p>
                </div>
                <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-medium <?php echo $requirement['ok'] ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700'; ?>">
                    <?php echo $requirement['ok'] ? 'Pass' : 'Fail'; ?>
                </span>
            </div>
        <?php endforeach; ?>
    </div>

    <form method="post" class="mt-8" data-validate-form>
        <input type="hidden" name="action" value="confirm_requirements">
        <div class="flex flex-wrap gap-3">
            <a href="?step=welcome" class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-4 py-2 text-slate-600 hover:bg-slate-50">Back</a>
            <button type="submit" data-submit class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2 font-medium text-white shadow-sm hover:bg-blue-700" <?php echo $allGood ? '' : 'disabled'; ?>>
                Continue
            </button>
        </div>
        <?php if (!$allGood) : ?>
            <p class="mt-3 text-sm text-rose-600">Resolve the failing checks before continuing.</p>
        <?php endif; ?>
    </form>
</div>
