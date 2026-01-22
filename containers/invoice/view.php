<?php
$pageTitle = 'Invoice ' . ($invoice['invoice_number'] ?? '');
include __DIR__ . '/layout/header.php';
?>
<section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-xs uppercase text-slate-400">Invoice</p>
            <h2 class="text-2xl font-semibold"><?php echo invoice_html($invoice['invoice_number']); ?></h2>
            <p class="text-sm text-slate-500">Status: <?php echo invoice_html($invoice['status']); ?></p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="invoice/print/<?php echo (int) $invoice['id']; ?>" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100">Print</a>
            <a href="invoice/send/<?php echo (int) $invoice['id']; ?>" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Send</a>
            <a href="invoice/edit/<?php echo (int) $invoice['id']; ?>" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100">Edit</a>
        </div>
    </div>

    <div class="mt-6 grid gap-6 md:grid-cols-2">
        <div class="rounded-lg border border-slate-200 p-4">
            <h3 class="text-sm font-semibold text-slate-700">Client</h3>
            <p class="mt-2 text-sm"><?php echo invoice_html($invoice['client_name']); ?></p>
            <p class="text-xs text-slate-500"><?php echo invoice_html($invoice['client_email']); ?></p>
            <p class="text-xs text-slate-500"><?php echo invoice_html($invoice['client_phone']); ?></p>
            <p class="text-xs text-slate-500"><?php echo invoice_html($invoice['client_address']); ?></p>
        </div>
        <div class="rounded-lg border border-slate-200 p-4">
            <h3 class="text-sm font-semibold text-slate-700">Details</h3>
            <div class="mt-2 text-sm text-slate-600">
                <div>Issue Date: <?php echo invoice_html($invoice['issue_date']); ?></div>
                <div>Due Date: <?php echo invoice_html($invoice['due_date'] ?: '—'); ?></div>
                <div>Total: $<?php echo invoice_currency($invoice['total']); ?></div>
                <div>Amount Paid: $<?php echo invoice_currency($invoice['amount_paid']); ?></div>
                <div>Balance Due: $<?php echo invoice_currency($invoice['balance_due']); ?></div>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <h3 class="text-lg font-semibold">Line Items</h3>
        <div class="mt-3 overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="text-xs uppercase text-slate-500">
                    <tr>
                        <th class="px-4 py-2">Description</th>
                        <th class="px-4 py-2">Qty</th>
                        <th class="px-4 py-2">Unit Price</th>
                        <th class="px-4 py-2">Discount</th>
                        <th class="px-4 py-2">Tax</th>
                        <th class="px-4 py-2">Line Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td class="px-4 py-2"><?php echo invoice_html($item['description']); ?></td>
                            <td class="px-4 py-2"><?php echo invoice_html($item['quantity']); ?></td>
                            <td class="px-4 py-2">$<?php echo invoice_currency($item['unit_price']); ?></td>
                            <td class="px-4 py-2">$<?php echo invoice_currency($item['discount']); ?></td>
                            <td class="px-4 py-2">$<?php echo invoice_currency($item['tax']); ?></td>
                            <td class="px-4 py-2">$<?php echo invoice_currency($item['line_total']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php if (!empty($invoice['notes'])): ?>
        <div class="mt-6 rounded-lg border border-slate-200 p-4 text-sm text-slate-600">
            <h4 class="font-semibold">Notes</h4>
            <p class="mt-2"><?php echo invoice_html($invoice['notes']); ?></p>
        </div>
    <?php endif; ?>
</section>
<?php include __DIR__ . '/layout/footer.php'; ?>
