<?php
$pageTitle = 'Refund Payment';
include __DIR__ . '/layout/header.php';
$values = $values ?? [];
?>
<section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-semibold">Refund Payment</h2>
            <p class="text-sm text-slate-500">Refund a recorded payment.</p>
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

    <div class="mt-4 rounded-lg border border-slate-200 p-4 text-sm text-slate-600">
        <p>Payment Amount: <strong>$<?php echo invoice_currency($payment['amount']); ?></strong></p>
        <p>Refunded to Date: <strong>$<?php echo invoice_currency($payment['refunded_amount']); ?></strong></p>
    </div>

    <form method="post" class="mt-6 grid gap-4 md:grid-cols-2">
        <input type="hidden" name="csrf_token" value="<?php echo billing_html($csrf ?? ''); ?>">
        <div>
            <label class="text-sm font-semibold">Refund Amount</label>
            <input type="number" step="0.01" name="refund_amount" value="<?php echo billing_html($values['refund_amount'] ?? ''); ?>" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" required>
        </div>
        <div class="md:col-span-2">
            <label class="text-sm font-semibold">Notes</label>
            <textarea name="notes" rows="3" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"><?php echo billing_html($values['notes'] ?? ''); ?></textarea>
        </div>
        <div class="md:col-span-2 flex gap-2">
            <button type="submit" class="rounded-lg bg-rose-600 px-4 py-2 text-sm font-semibold text-white hover:bg-rose-700">Process Refund</button>
            <a href="billing?action=payments" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-600">Cancel</a>
        </div>
    </form>
</section>
<?php include __DIR__ . '/layout/footer.php'; ?>
