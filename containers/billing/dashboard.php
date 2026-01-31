<?php
$pageTitle = 'Billing Dashboard';
include __DIR__ . '/layout/header.php';
?>
<section class="grid gap-4 md:grid-cols-3">
    <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
        <p class="text-xs uppercase text-slate-400">Total Received</p>
        <p class="mt-2 text-2xl font-semibold">$<?php echo invoice_currency($stats['total_received'] ?? 0); ?></p>
    </div>
    <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
        <p class="text-xs uppercase text-slate-400">Outstanding Balance</p>
        <p class="mt-2 text-2xl font-semibold">$<?php echo invoice_currency($stats['total_outstanding'] ?? 0); ?></p>
    </div>
    <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
        <p class="text-xs uppercase text-slate-400">Overdue Invoices</p>
        <p class="mt-2 text-2xl font-semibold"><?php echo billing_html((int) ($stats['overdue_count'] ?? 0)); ?></p>
    </div>
</section>

<section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
    <h2 class="text-xl font-semibold">Next Steps</h2>
    <p class="text-sm text-slate-500">Record payments or review outstanding invoices.</p>
    <div class="mt-4 flex flex-wrap gap-2">
        <a href="billing?action=new-payment" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Record a Payment</a>
        <a href="invoice" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100">Review Invoices</a>
    </div>
</section>
<?php include __DIR__ . '/layout/footer.php'; ?>
