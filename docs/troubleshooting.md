<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Support & Diagnostics | JamilX Documentation</title>
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
      <a class="rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-900 hover:bg-slate-200" href="glossary.md">Next: Glossary</a>
    </div>
  </header>

  <main class="mx-auto max-w-6xl px-6 pb-20 pt-12">
    <section class="rounded-3xl border border-slate-800 bg-slate-900/60 p-10">
      <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-300">Support & Diagnostics</p>
      <h1 class="mt-3 text-3xl font-semibold text-white md:text-4xl">Keep environments healthy with built-in diagnostics.</h1>
      <p class="mt-4 text-lg text-slate-300">Use the CLI doctor command, logs, and bootstrap checks to validate a healthy runtime.</p>
    </section>

    <section class="mt-10 grid gap-6 lg:grid-cols-2">
      <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6">
        <h2 class="text-lg font-semibold text-white">CLI Doctor</h2>
        <p class="mt-2 text-sm text-slate-300">Run an end-to-end environment validation at any time.</p>
        <div class="mt-4 rounded-xl bg-slate-950 p-4 text-sm text-slate-200">
          <code>php jamilx doctor</code>
        </div>
      </div>
      <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6">
        <h2 class="text-lg font-semibold text-white">Live Log Monitoring</h2>
        <p class="mt-2 text-sm text-slate-300">Follow runtime errors in real time to surface issues quickly.</p>
        <div class="mt-4 rounded-xl bg-slate-950 p-4 text-sm text-slate-200">
          <code>php jamilx logs:tail --follow</code>
        </div>
      </div>
    </section>

    <section class="mt-10 grid gap-6 lg:grid-cols-3">
      <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6">
        <h3 class="text-lg font-semibold text-white">Installer Lock</h3>
        <p class="mt-2 text-sm text-slate-300">Confirm that <code class="text-indigo-200">data/installed.lock</code> exists in production to prevent re-installs.</p>
      </div>
      <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6">
        <h3 class="text-lg font-semibold text-white">Bootstrap Status</h3>
        <p class="mt-2 text-sm text-slate-300">Use <code class="text-indigo-200">MODE</code> settings in <code class="text-indigo-200">.env</code> to verify the correct bootstrap class is loaded.</p>
      </div>
      <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6">
        <h3 class="text-lg font-semibold text-white">Configuration Review</h3>
        <p class="mt-2 text-sm text-slate-300">Re-check database credentials and mail settings after environment changes.</p>
      </div>
    </section>
  </main>

  <footer class="border-t border-slate-800 bg-slate-950/80">
    <div class="mx-auto flex max-w-6xl flex-col gap-4 px-6 py-8 text-sm text-slate-400 md:flex-row md:items-center md:justify-between">
      <span>Next: quick definitions for JamilX terminology.</span>
      <a class="font-semibold text-indigo-300 hover:text-indigo-200" href="glossary.md">Next: Glossary →</a>
    </div>
  </footer>
</body>
</html>
