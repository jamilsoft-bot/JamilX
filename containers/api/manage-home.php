<?php
// API management overview content.
?>
<section class="space-y-6">
    <div>
        <h2 class="text-2xl font-semibold text-blue-700">Getting Started</h2>
        <p class="mt-2 text-slate-600">Use this console to manage API access. Keys are configured in <code class="rounded bg-slate-100 px-2 py-1 text-sm">.env</code> and should be rotated regularly.</p>
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        <div class="rounded-xl border border-blue-100 bg-blue-50 p-4">
            <h3 class="text-lg font-semibold text-blue-700">Key Security</h3>
            <p class="mt-2 text-sm text-slate-600">Keep keys secret, rotate them on a schedule, and revoke compromised keys immediately.</p>
        </div>
        <div class="rounded-xl border border-blue-100 bg-blue-50 p-4">
            <h3 class="text-lg font-semibold text-blue-700">Rate Limits</h3>
            <p class="mt-2 text-sm text-slate-600">Configure rate limits in <code class="rounded bg-white px-1 py-0.5 text-xs">API_RATE_LIMIT</code> and <code class="rounded bg-white px-1 py-0.5 text-xs">API_RATE_WINDOW</code>.</p>
        </div>
    </div>

    <div>
        <h3 class="text-lg font-semibold text-blue-700">Recommended Next Steps</h3>
        <ul class="mt-3 list-disc pl-5 text-sm text-slate-600 space-y-2">
            <li>Generate a new API key and store it in a password manager.</li>
            <li>Update <code class="rounded bg-slate-100 px-2 py-1 text-sm">API_KEYS</code> in <code class="rounded bg-slate-100 px-2 py-1 text-sm">.env</code>.</li>
            <li>Verify access by calling <code class="rounded bg-slate-100 px-2 py-1 text-sm">/api/v1/health</code>.</li>
        </ul>
    </div>
</section>
