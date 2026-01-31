<?php
$pageTitle = isset($client['id']) ? 'Edit Client' : 'New Client';
include __DIR__ . '/layout/header.php';
$clientData = is_array($client) ? $client : [];
$errors = $errors ?? [];
?>
<section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-semibold"><?php echo invoice_html($pageTitle); ?></h2>
            <p class="text-sm text-slate-500">Keep client details up to date.</p>
        </div>
        <a href="invoice?action=clients" class="text-sm text-slate-600 hover:text-slate-900">Back to clients</a>
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

    <form method="post" class="mt-6 grid gap-4 md:grid-cols-2">
        <input type="hidden" name="csrf_token" value="<?php echo invoice_html($csrf ?? ''); ?>">
        <div>
            <label class="text-sm font-semibold">Name</label>
            <input type="text" name="name" value="<?php echo invoice_html($clientData['name'] ?? ''); ?>" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm" required>
        </div>
        <div>
            <label class="text-sm font-semibold">Company</label>
            <input type="text" name="company" value="<?php echo invoice_html($clientData['company'] ?? ''); ?>" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
        </div>
        <div>
            <label class="text-sm font-semibold">Email</label>
            <input type="email" name="email" value="<?php echo invoice_html($clientData['email'] ?? ''); ?>" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
        </div>
        <div>
            <label class="text-sm font-semibold">Phone</label>
            <input type="text" name="phone" value="<?php echo invoice_html($clientData['phone'] ?? ''); ?>" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm">
        </div>
        <div class="md:col-span-2">
            <label class="text-sm font-semibold">Address</label>
            <textarea name="address" rows="3" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-2 text-sm"><?php echo invoice_html($clientData['address'] ?? ''); ?></textarea>
        </div>
        <div class="md:col-span-2 flex gap-2">
            <button type="submit" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Save Client</button>
            <a href="invoice?action=clients" class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-600">Cancel</a>
        </div>
    </form>
</section>
<?php include __DIR__ . '/layout/footer.php'; ?>
