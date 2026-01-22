<?php
$pageTitle = 'Invoice Settings';
include __DIR__ . '/layout/header.php';
?>
<section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
    <h2 class="text-xl font-semibold">Invoice Settings</h2>
    <p class="text-sm text-slate-500">Configure invoice numbering and prefixes.</p>

    <?php if (!empty($notice)): ?>
        <div class="mt-4 rounded-lg border px-3 py-2 text-sm <?php echo $notice['success'] ? 'border-emerald-200 bg-emerald-50 text-emerald-700' : 'border-rose-200 bg-rose-50 text-rose-700'; ?>">
            <?php echo invoice_html($notice['message']); ?>
        </div>
    <?php endif; ?>

    <form method="post" class="mt-6 space-y-4">
        <input type="hidden" name="csrf_token" value="<?php echo invoice_html($csrf ?? ''); ?>">
        <div>
            <label class="text-sm font-semibold">Invoice Prefix</label>
            <input type="text" name="prefix" value="<?php echo invoice_html($settings['prefix'] ?? 'INV-'); ?>" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
        </div>
        <div>
            <label class="text-sm font-semibold">Next Number</label>
            <input type="number" name="next_number" value="<?php echo invoice_html($settings['next_number'] ?? 1); ?>" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
        </div>
        <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Save Settings</button>
    </form>
</section>
<?php include __DIR__ . '/layout/footer.php'; ?>
