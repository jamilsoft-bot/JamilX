<?php
$pageTitle = 'Clients';
include __DIR__ . '/layout/header.php';
?>
<section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-semibold">Clients</h2>
            <p class="text-sm text-slate-500">Keep your billing contacts organized.</p>
        </div>
        <a href="invoice/clients-new" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Add Client</a>
    </div>

    <?php if (empty($clients)): ?>
        <div class="mt-4 rounded-lg border border-dashed border-slate-300 p-6 text-center text-sm text-slate-500">
            No clients yet. Add your first client to start invoicing.
        </div>
    <?php else: ?>
        <div class="mt-4 overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="text-xs uppercase text-slate-500">
                    <tr>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Phone</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    <?php foreach ($clients as $client): ?>
                        <tr>
                            <td class="px-4 py-3 font-semibold"><?php echo invoice_html($client['name']); ?></td>
                            <td class="px-4 py-3 text-slate-600"><?php echo invoice_html($client['email']); ?></td>
                            <td class="px-4 py-3 text-slate-600"><?php echo invoice_html($client['phone']); ?></td>
                            <td class="px-4 py-3">
                                <div class="flex gap-2 text-sm">
                                    <a href="invoice/clients-edit/<?php echo (int) $client['id']; ?>" class="text-slate-600 hover:text-slate-900">Edit</a>
                                    <a href="invoice/clients-delete/<?php echo (int) $client['id']; ?>" class="text-rose-600 hover:text-rose-800">Archive</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</section>
<?php include __DIR__ . '/layout/footer.php'; ?>
