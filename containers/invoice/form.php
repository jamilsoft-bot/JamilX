<?php
$pageTitle = isset($invoice) ? 'Edit Invoice' : 'New Invoice';
include __DIR__ . '/layout/header.php';
$values = $values ?? [];
$currentInvoice = $invoice ?? [];
$itemRows = $items ?? [];
if (empty($itemRows)) {
    $itemRows = [
        ['description' => '', 'quantity' => 1, 'unit_price' => 0, 'discount' => 0, 'tax' => 0],
    ];
}
?>
<section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-semibold"><?php echo invoice_html($pageTitle); ?></h2>
            <p class="text-sm text-slate-500">Capture invoice details and line items.</p>
        </div>
        <a href="invoice" class="text-sm text-slate-600 hover:text-slate-900">Back to invoices</a>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="mt-4 rounded-lg border border-rose-200 bg-rose-50 p-3 text-sm text-rose-700">
            <ul class="list-disc pl-4">
                <?php foreach ($errors as $error): ?>
                    <li><?php echo invoice_html($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" class="mt-6 space-y-6">
        <input type="hidden" name="csrf_token" value="<?php echo invoice_html($csrf ?? ''); ?>">
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <label class="text-sm font-semibold">Client</label>
                <select name="client_id" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                    <option value="">Select a client</option>
                    <?php $selectedClient = $values['client_id'] ?? ($currentInvoice['client_id'] ?? ''); ?>
                    <?php foreach ($clients as $client): ?>
                        <option value="<?php echo (int) $client['id']; ?>" <?php echo (string) $selectedClient === (string) $client['id'] ? 'selected' : ''; ?>>
                            <?php echo invoice_html($client['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="text-sm font-semibold">Status</label>
                <?php $selectedStatus = $values['status'] ?? ($currentInvoice['status'] ?? 'Draft'); ?>
                <select name="status" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
                    <?php foreach (['Draft', 'Sent', 'Partially Paid', 'Paid', 'Overdue', 'Cancelled'] as $option): ?>
                        <option value="<?php echo invoice_html($option); ?>" <?php echo $selectedStatus === $option ? 'selected' : ''; ?>><?php echo invoice_html($option); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="text-sm font-semibold">Issue Date</label>
                <input type="date" name="issue_date" value="<?php echo invoice_html($values['issue_date'] ?? ($currentInvoice['issue_date'] ?? date('Y-m-d'))); ?>" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
            </div>
            <div>
                <label class="text-sm font-semibold">Due Date</label>
                <input type="date" name="due_date" value="<?php echo invoice_html($values['due_date'] ?? ($currentInvoice['due_date'] ?? '')); ?>" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
            </div>
        </div>

        <div>
            <h3 class="text-lg font-semibold">Invoice Items</h3>
            <div class="mt-3 space-y-3">
                <?php foreach ($itemRows as $index => $item): ?>
                    <div class="grid gap-3 md:grid-cols-5">
                        <input type="text" name="item_description[]" value="<?php echo invoice_html($item['description'] ?? ''); ?>" placeholder="Description" class="rounded-lg border border-slate-300 px-3 py-2 text-sm md:col-span-2">
                        <input type="number" step="0.01" name="item_quantity[]" value="<?php echo invoice_html($item['quantity'] ?? 1); ?>" placeholder="Qty" class="rounded-lg border border-slate-300 px-3 py-2 text-sm">
                        <input type="number" step="0.01" name="item_unit_price[]" value="<?php echo invoice_html($item['unit_price'] ?? 0); ?>" placeholder="Unit price" class="rounded-lg border border-slate-300 px-3 py-2 text-sm">
                        <input type="number" step="0.01" name="item_discount[]" value="<?php echo invoice_html($item['discount'] ?? 0); ?>" placeholder="Discount" class="rounded-lg border border-slate-300 px-3 py-2 text-sm">
                        <input type="number" step="0.01" name="item_tax[]" value="<?php echo invoice_html($item['tax'] ?? 0); ?>" placeholder="Tax" class="rounded-lg border border-slate-300 px-3 py-2 text-sm">
                    </div>
                <?php endforeach; ?>
            </div>
            <p class="mt-2 text-xs text-slate-500">Add additional rows by duplicating the last line item before submitting.</p>
        </div>

        <div>
            <label class="text-sm font-semibold">Notes</label>
            <textarea name="notes" rows="4" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"><?php echo invoice_html($values['notes'] ?? ($currentInvoice['notes'] ?? '')); ?></textarea>
        </div>

        <div class="flex flex-wrap gap-2">
            <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Save Invoice</button>
            <a href="invoice" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100">Cancel</a>
        </div>
    </form>
</section>
<?php include __DIR__ . '/layout/footer.php'; ?>
