<?php
$pageTitle = 'Invoices';
include __DIR__ . '/layout/header.php';
?>
<section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h2 class="text-xl font-semibold">Invoice Dashboard</h2>
            <p class="text-sm text-slate-500">Manage draft, sent, and paid invoices.</p>
        </div>
        <form method="get" action="invoice" class="flex flex-wrap gap-2">
            <input type="text" name="q" value="<?php echo invoice_html($search ?? ''); ?>" placeholder="Search invoices" class="rounded-lg border border-slate-300 px-3 py-2 text-sm">
            <select name="status" class="rounded-lg border border-slate-300 px-3 py-2 text-sm">
                <?php $statusFilter = $status ?? ''; ?>
                <option value="">All statuses</option>
                <?php foreach (['Draft', 'Sent', 'Partially Paid', 'Paid', 'Overdue', 'Cancelled'] as $option): ?>
                    <option value="<?php echo invoice_html($option); ?>" <?php echo $statusFilter === $option ? 'selected' : ''; ?>><?php echo invoice_html($option); ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white">Filter</button>
        </form>
    </div>
</section>

<section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
    <?php if (empty($invoices)): ?>
        <div class="rounded-lg border border-dashed border-slate-300 p-6 text-center text-sm text-slate-500">
            No invoices yet. Create your first invoice to get started.
        </div>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="text-xs uppercase text-slate-500">
                    <tr>
                        <th class="px-4 py-3">Invoice</th>
                        <th class="px-4 py-3">Client</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Total</th>
                        <th class="px-4 py-3">Balance</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    <?php foreach ($invoices as $invoice): ?>
                        <tr>
                            <td class="px-4 py-3 font-semibold text-slate-800">
                                <?php echo invoice_html($invoice['invoice_number']); ?>
                                <div class="text-xs text-slate-400"><?php echo invoice_html($invoice['issue_date']); ?></div>
                            </td>
                            <td class="px-4 py-3">
                                <div><?php echo invoice_html($invoice['client_name']); ?></div>
                                <div class="text-xs text-slate-400"><?php echo invoice_html($invoice['client_email']); ?></div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs text-slate-600"><?php echo invoice_html($invoice['status']); ?></span>
                            </td>
                            <td class="px-4 py-3">$<?php echo invoice_currency($invoice['total']); ?></td>
                            <td class="px-4 py-3">$<?php echo invoice_currency($invoice['balance_due']); ?></td>
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-2">
                                    <a class="text-indigo-600 hover:text-indigo-800" href="invoice?action=view&id=<?php echo (int) $invoice['id']; ?>">View</a>
                                    <a class="text-slate-600 hover:text-slate-800" href="invoice?action=edit&id=<?php echo (int) $invoice['id']; ?>">Edit</a>
                                    <a class="text-rose-600 hover:text-rose-800" href="invoice?action=delete&id=<?php echo (int) $invoice['id']; ?>">Delete</a>
                                </div>
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
                <a href="invoice?page=<?php echo $i; ?>" class="rounded-lg px-3 py-2 text-sm <?php echo $i === $pagination['page'] ? 'bg-indigo-600 text-white' : 'bg-white text-slate-600 border border-slate-200'; ?>">
                    <?php echo invoice_html($i); ?>
                </a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</section>
<?php include __DIR__ . '/layout/footer.php'; ?>
