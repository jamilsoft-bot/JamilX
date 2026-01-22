<?php
$pageTitle = 'Payments';
include __DIR__ . '/layout/header.php';
?>
<section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-semibold">Payments</h2>
            <p class="text-sm text-slate-500">Track incoming payments and refunds.</p>
        </div>
        <a href="billing/new-payment" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Record Payment</a>
    </div>

    <?php if (empty($payments)): ?>
        <div class="mt-4 rounded-lg border border-dashed border-slate-300 p-6 text-center text-sm text-slate-500">
            No payments recorded yet.
        </div>
    <?php else: ?>
        <div class="mt-4 overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="text-xs uppercase text-slate-500">
                    <tr>
                        <th class="px-4 py-3">Invoice</th>
                        <th class="px-4 py-3">Client</th>
                        <th class="px-4 py-3">Amount</th>
                        <th class="px-4 py-3">Method</th>
                        <th class="px-4 py-3">Refunded</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    <?php foreach ($payments as $payment): ?>
                        <tr>
                            <td class="px-4 py-3 font-semibold"><?php echo billing_html($payment['invoice_number']); ?></td>
                            <td class="px-4 py-3 text-slate-600"><?php echo billing_html($payment['client_name']); ?></td>
                            <td class="px-4 py-3">$<?php echo invoice_currency($payment['amount']); ?></td>
                            <td class="px-4 py-3"><?php echo billing_html($payment['method']); ?></td>
                            <td class="px-4 py-3">$<?php echo invoice_currency($payment['refunded_amount']); ?></td>
                            <td class="px-4 py-3">
                                <a href="billing/refund/<?php echo (int) $payment['id']; ?>" class="text-rose-600 hover:text-rose-800">Refund</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <?php if ($pagination['total_pages'] > 1): ?>
        <div class="mt-4 flex gap-2">
            <?php for ($i = 1; $i <= $pagination['total_pages']; $i++): ?>
                <a href="billing/payments?page=<?php echo $i; ?>" class="rounded-lg px-3 py-2 text-sm <?php echo $i === $pagination['page'] ? 'bg-indigo-600 text-white' : 'bg-white text-slate-600 border border-slate-200'; ?>">
                    <?php echo billing_html($i); ?>
                </a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</section>
<?php include __DIR__ . '/layout/footer.php'; ?>
