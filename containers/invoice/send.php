<?php
$pageTitle = 'Send Invoice';
include __DIR__ . '/layout/header.php';
?>
<section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
    <h2 class="text-xl font-semibold">Send Invoice</h2>
    <p class="text-sm text-slate-500">Send invoice <?php echo invoice_html($invoice['invoice_number']); ?> to <?php echo invoice_html($invoice['client_email']); ?>.</p>

    <?php if (!empty($notice)): ?>
        <div class="mt-4 rounded-lg border px-3 py-2 text-sm <?php echo $notice['success'] ? 'border-emerald-200 bg-emerald-50 text-emerald-700' : 'border-rose-200 bg-rose-50 text-rose-700'; ?>">
            <?php echo invoice_html($notice['message']); ?>
        </div>
    <?php endif; ?>

    <form method="post" class="mt-4 space-y-4">
        <input type="hidden" name="csrf_token" value="<?php echo invoice_html(invoice_csrf_token()); ?>">
        <div>
            <label class="text-sm font-semibold">Message</label>
            <textarea name="message" rows="4" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">Hello <?php echo invoice_html($invoice['client_name']); ?>,\n\nPlease find your invoice attached. Let us know if you have any questions.</textarea>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Send Invoice</button>
            <a href="invoice?action=view&id=<?php echo (int) $invoice['id']; ?>" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-600">Back</a>
        </div>
    </form>
</section>
<?php include __DIR__ . '/layout/footer.php'; ?>
