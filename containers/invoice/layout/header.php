<?php
$pageTitle = $pageTitle ?? 'Invoices';
$navLinks = [
    ['label' => 'Invoices', 'href' => 'invoice'],
    ['label' => 'Clients', 'href' => 'invoice/clients'],
    ['label' => 'Billing', 'href' => 'billing'],
    ['label' => 'Forum', 'href' => 'forum'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo invoice_html($pageTitle); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-900">
<header class="border-b border-slate-200 bg-white">
    <div class="mx-auto flex max-w-6xl flex-col gap-4 px-4 py-6 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-xs uppercase tracking-[0.2em] text-slate-500">JamilX Service</p>
            <h1 class="text-2xl font-semibold">Invoice & Billing</h1>
            <p class="text-sm text-slate-500">Track invoices, clients, and payments in one place.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="dashboard" class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100">Dashboard</a>
            <a href="invoice/new" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">New Invoice</a>
        </div>
    </div>
    <nav class="border-t border-slate-200 bg-slate-100">
        <div class="mx-auto flex max-w-6xl flex-wrap gap-4 px-4 py-3 text-sm font-medium">
            <?php foreach ($navLinks as $link): ?>
                <a href="<?php echo invoice_html($link['href']); ?>" class="text-slate-600 hover:text-slate-900">
                    <?php echo invoice_html($link['label']); ?>
                </a>
            <?php endforeach; ?>
            <?php if (invoice_is_admin()): ?>
                <a href="invoice/settings" class="text-slate-600 hover:text-slate-900">Settings</a>
            <?php endif; ?>
        </div>
    </nav>
</header>
<main class="mx-auto max-w-6xl space-y-6 px-4 py-8">
