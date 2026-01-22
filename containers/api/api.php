<?php
// API documentation UI (public).
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JamilX API Documentation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-slate-900">
    <div class="max-w-5xl mx-auto px-6 py-10">
        <header class="mb-10">
            <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-sm font-semibold text-blue-700">JamilX API</span>
            <h1 class="mt-4 text-4xl font-semibold text-blue-700">API Documentation</h1>
            <p class="mt-2 text-slate-600">Use this reference to integrate with the JamilX API. All endpoints return JSON with a consistent response envelope.</p>
        </header>

        <section class="mb-8 rounded-2xl border border-blue-100 bg-blue-50 p-6">
            <h2 class="text-xl font-semibold text-blue-700">Base URL</h2>
            <p class="mt-2 text-slate-600">All versioned endpoints live under:</p>
            <code class="mt-3 block rounded-lg bg-white px-4 py-3 text-sm text-slate-700">/api/v1</code>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-blue-700">Authentication</h2>
            <p class="mt-2 text-slate-600">Include your API key in a header or query parameter:</p>
            <div class="mt-4 grid gap-4 md:grid-cols-2">
                <div class="rounded-xl border border-blue-100 p-4">
                    <p class="font-semibold">Header</p>
                    <code class="mt-2 block text-sm text-slate-600">X-API-Key: &lt;your-key&gt;</code>
                </div>
                <div class="rounded-xl border border-blue-100 p-4">
                    <p class="font-semibold">Bearer Token</p>
                    <code class="mt-2 block text-sm text-slate-600">Authorization: Bearer &lt;your-key&gt;</code>
                </div>
            </div>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-blue-700">Endpoints</h2>
            <div class="mt-4 space-y-4">
                <div class="rounded-xl border border-blue-100 p-4">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="rounded-full bg-blue-100 px-3 py-1 text-sm font-semibold text-blue-700">GET</span>
                        <code class="text-sm">/api/v1/health</code>
                    </div>
                    <p class="mt-2 text-sm text-slate-600">Check service status.</p>
                </div>
                <div class="rounded-xl border border-blue-100 p-4">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="rounded-full bg-blue-100 px-3 py-1 text-sm font-semibold text-blue-700">GET</span>
                        <code class="text-sm">/api/v1/notes</code>
                    </div>
                    <p class="mt-2 text-sm text-slate-600">List sample notes.</p>
                </div>
                <div class="rounded-xl border border-blue-100 p-4">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="rounded-full bg-blue-100 px-3 py-1 text-sm font-semibold text-blue-700">POST</span>
                        <code class="text-sm">/api/v1/notes</code>
                    </div>
                    <p class="mt-2 text-sm text-slate-600">Create a note (title + body required).</p>
                </div>
                <div class="rounded-xl border border-blue-100 p-4">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="rounded-full bg-blue-100 px-3 py-1 text-sm font-semibold text-blue-700">GET</span>
                        <code class="text-sm">/api/v1/notes/{id}</code>
                    </div>
                    <p class="mt-2 text-sm text-slate-600">Fetch a single note.</p>
                </div>
                <div class="rounded-xl border border-blue-100 p-4">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="rounded-full bg-blue-100 px-3 py-1 text-sm font-semibold text-blue-700">PUT/PATCH</span>
                        <code class="text-sm">/api/v1/notes/{id}</code>
                    </div>
                    <p class="mt-2 text-sm text-slate-600">Update a note.</p>
                </div>
                <div class="rounded-xl border border-blue-100 p-4">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="rounded-full bg-blue-100 px-3 py-1 text-sm font-semibold text-blue-700">DELETE</span>
                        <code class="text-sm">/api/v1/notes/{id}</code>
                    </div>
                    <p class="mt-2 text-sm text-slate-600">Delete a note.</p>
                </div>
            </div>
        </section>

        <section class="mb-8">
            <h2 class="text-2xl font-semibold text-blue-700">Response Envelope</h2>
            <pre class="mt-3 rounded-xl bg-slate-900 p-4 text-sm text-blue-100 overflow-auto">{
  "success": true,
  "message": "Notes retrieved.",
  "data": [],
  "errors": [],
  "meta": { "total": 0 }
}</pre>
        </section>

        <section>
            <h2 class="text-2xl font-semibold text-blue-700">Example cURL</h2>
            <pre class="mt-3 rounded-xl bg-slate-900 p-4 text-sm text-blue-100 overflow-auto">curl -H "X-API-Key: YOUR_API_KEY" \
  -H "Content-Type: application/json" \
  -d '{"title":"First note","body":"Hello world"}' \
  https://your-domain.com/api/v1/notes</pre>
        </section>
    </div>
</body>
</html>
