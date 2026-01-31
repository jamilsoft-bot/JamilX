<?php
$pageTitle = 'Record Payment';
include __DIR__ . '/layout/header.php';
$values = $values ?? [];
?>
<section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-semibold">Record Payment</h2>
            <p class="text-sm text-slate-500">Apply a payment to an invoice.</p>
        </div>
        <a href="billing?action=payments" class="text-sm text-slate-600 hover:text-slate-900">Back to payments</a>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="mt-4 rounded-lg border border-rose-200 bg-rose-50 p-3 text-sm text-rose-700">
            <ul class="list-disc pl-4">
                <?php foreach ($errors as $error): ?>
                    <li><?php echo billing_html($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" class="mt-6 grid gap-4 md:grid-cols-2">
        <input type="hidden" name="csrf_token" value="<?php echo billing_html($csrf ?? ''); ?>">
        <div>
            <label class="text-sm font-semibold">Invoice ID</label>
            <input type="number" name="invoice_id" value="<?php echo billing_html($values['invoice_id'] ?? ''); ?>" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" required>
        </div>
        <div>
            <label class="text-sm font-semibold">Amount</label>
            <input type="number" step="0.01" name="amount" value="<?php echo billing_html($values['amount'] ?? ''); ?>" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" required>
        </div>
        <div>
            <label class="text-sm font-semibold">Method</label>
            <select name="method" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                <?php $method = $values['method'] ?? ''; ?>
                <?php foreach (['Cash', 'Bank Transfer', 'Card', 'Check', 'Other'] as $option): ?>
                    <option value="<?php echo billing_html($option); ?>" <?php echo $method === $option ? 'selected' : ''; ?>><?php echo billing_html($option); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="md:col-span-2">
            <label class="text-sm font-semibold">Notes</label>
            <textarea name="notes" rows="3" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"><?php echo billing_html($values['notes'] ?? ''); ?></textarea>
        </div>
        <div class="md:col-span-2 flex gap-2">
            <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Save Payment</button>
            <a href="billing?action=payments" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-600">Cancel</a>
        </div>
    </form>
</section>
<?php include __DIR__ . '/layout/footer.php'; ?>
