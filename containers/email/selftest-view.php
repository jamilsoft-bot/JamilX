<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
    <h4 class="text-lg font-semibold text-slate-900">Self-Test</h4>
    <p class="mt-2 text-sm text-slate-500">Run the CLI self-test to verify configuration, template rendering, and log driver output.</p>
    <pre class="mt-4 rounded-xl border border-slate-200 bg-slate-50 p-4 text-xs text-slate-600">php containers/email/selftest.php</pre>
    <p class="mt-3 text-sm text-slate-500">The self-test will perform a non-destructive SMTP handshake (when configured), render templates, and write a log entry using the log driver.</p>
</div>
