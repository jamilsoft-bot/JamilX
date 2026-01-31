<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Routing | JamilX Documentation</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-100">
  <header class="sticky top-0 z-50 border-b border-slate-800 bg-slate-950/90 backdrop-blur">
    <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
      <a class="flex items-center gap-3" href="README.md">
        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 text-sm font-semibold">JX</div>
        <div>
          <p class="text-lg font-semibold">JamilX</p>
          <p class="text-xs text-slate-300">Framework Documentation</p>
        </div>
      </a>
      <nav class="hidden items-center gap-6 text-sm text-slate-200 md:flex">
        <a class="hover:text-white" href="overview.md">Overview</a>
        <a class="hover:text-white" href="installation.md">Installation</a>
        <a class="hover:text-white" href="configuration.md">Configuration</a>
        <a class="hover:text-white" href="routing.md">Routing</a>
        <a class="hover:text-white" href="services.md">Services</a>
        <a class="hover:text-white" href="cli.md">CLI</a>
      </nav>
      <a class="rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-900 hover:bg-slate-200" href="services.md">Next: Services</a>
    </div>
  </header>

  <main class="mx-auto max-w-6xl px-6 pb-20 pt-12">
    <section class="rounded-3xl border border-slate-800 bg-slate-900/60 p-10">
      <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-300">Routing</p>
      <h1 class="mt-3 text-3xl font-semibold text-white md:text-4xl">Map URLs to Services with clean, predictable rules.</h1>
      <p class="mt-4 text-lg text-slate-300">JamilX uses Apache rewrite rules to funnel requests into <code class="text-indigo-200">index.php</code>, then resolves the matching Service based on the <code class="text-indigo-200">route</code> query string.</p>
    </section>

    <section class="mt-10 grid gap-6 lg:grid-cols-2">
      <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6">
        <h2 class="text-lg font-semibold text-white">Rewrite Rule</h2>
        <p class="mt-2 text-sm text-slate-300">All non-file requests become a route parameter.</p>
        <pre class="mt-4 overflow-hidden rounded-xl bg-slate-950 p-4 text-xs text-slate-200"><code>index.php?route=&lt;path&gt;</code></pre>
        <p class="mt-3 text-sm text-slate-300">Ensure <code class="text-indigo-200">mod_rewrite</code> is enabled in Apache and that <code class="text-indigo-200">.htaccess</code> is respected.</p>
      </div>
      <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6">
        <h2 class="text-lg font-semibold text-white">Service Resolution</h2>
        <p class="mt-2 text-sm text-slate-300">The first URL segment determines the Service class name.</p>
        <pre class="mt-4 overflow-hidden rounded-xl bg-slate-950 p-4 text-xs text-slate-200"><code>/dashboard → class Dashboard
/blog → class blog</code></pre>
        <p class="mt-3 text-sm text-slate-300">When the route is empty, JamilX falls back to the default Service index.</p>
      </div>
    </section>

    <section class="mt-10 grid gap-6 lg:grid-cols-3">
      <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6">
        <h3 class="text-lg font-semibold text-white">Actions</h3>
        <p class="mt-2 text-sm text-slate-300">Use the <code class="text-indigo-200">action</code> query parameter to delegate to specific Actions within a Service.</p>
        <div class="mt-4 rounded-xl bg-slate-950 p-4 text-sm text-slate-200">
          <code>/dashboard?action=home</code>
        </div>
      </div>
      <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6">
        <h3 class="text-lg font-semibold text-white">Special Cases</h3>
        <p class="mt-2 text-sm text-slate-300">The router includes tailored rules for paths like <code class="text-indigo-200">/admin/blog</code> so legacy services continue to load correctly.</p>
      </div>
      <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6">
        <h3 class="text-lg font-semibold text-white">Next Step</h3>
        <p class="mt-2 text-sm text-slate-300">Once routing resolves to a Service, the Service orchestrates Actions and Containers.</p>
        <a class="mt-4 inline-flex text-sm font-semibold text-indigo-300 hover:text-indigo-200" href="services.md">See Services →</a>
      </div>
    </section>
  </main>

  <footer class="border-t border-slate-800 bg-slate-950/80">
    <div class="mx-auto flex max-w-6xl flex-col gap-4 px-6 py-8 text-sm text-slate-400 md:flex-row md:items-center md:justify-between">
      <span>Ready to build Services and wire Actions?</span>
      <a class="font-semibold text-indigo-300 hover:text-indigo-200" href="services.md">Next: Services →</a>
    </div>
  </footer>
</body>
</html>
