<?php
// API key management view.
$maskedKeys = $maskedKeys ?? [];
$generatedKey = $generatedKey ?? null;
?>
<section class="space-y-6">
    <div>
        <h2 class="text-2xl font-semibold text-blue-700">API Keys</h2>
        <p class="mt-2 text-slate-600">Keys are configured in <code class="rounded bg-slate-100 px-2 py-1 text-sm">.env</code> as a comma-separated list in <code class="rounded bg-slate-100 px-2 py-1 text-sm">API_KEYS</code>.</p>
    </div>

    <div class="rounded-xl border border-blue-100 bg-blue-50 p-4">
        <h3 class="text-lg font-semibold text-blue-700">Current Keys</h3>
        <?php if (empty($maskedKeys)) : ?>
            <p class="mt-2 text-sm text-slate-600">No keys configured yet.</p>
        <?php else : ?>
            <ul class="mt-3 space-y-2 text-sm text-slate-600">
                <?php foreach ($maskedKeys as $key) : ?>
                    <li class="rounded-lg bg-white px-3 py-2 border border-blue-100"><?php echo htmlspecialchars($key, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

    <div class="rounded-xl border border-blue-100 p-4">
        <h3 class="text-lg font-semibold text-blue-700">Generate New Key</h3>
        <p class="mt-2 text-sm text-slate-600">Generate a new key and add it to <code class="rounded bg-slate-100 px-2 py-1 text-sm">API_KEYS</code> in <code class="rounded bg-slate-100 px-2 py-1 text-sm">.env</code>.</p>
        <form method="post" class="mt-4">
            <button type="submit" name="generate_key" value="1" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">Generate Key</button>
        </form>
        <?php if ($generatedKey) : ?>
            <div class="mt-4 rounded-lg border border-blue-100 bg-blue-50 p-3">
                <p class="text-sm font-semibold text-blue-700">New API Key</p>
                <code class="mt-2 block break-all text-sm text-slate-700"><?php echo htmlspecialchars($generatedKey, ENT_QUOTES, 'UTF-8'); ?></code>
                <p class="mt-2 text-xs text-slate-500">Store this key securely. It will not be shown again.</p>
            </div>
        <?php endif; ?>
    </div>
</section>
