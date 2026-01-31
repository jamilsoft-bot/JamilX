<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Containers | JamilX Documentation</title>
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
      <a class="rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-900 hover:bg-slate-200" href="prototypes.md">Next: Prototypes</a>
    </div>
  </header>

  <main class="mx-auto max-w-6xl px-6 pb-20 pt-12">
    <section class="rounded-3xl border border-slate-800 bg-slate-900/60 p-10">
      <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-300">Containers</p>
      <h1 class="mt-3 text-3xl font-semibold text-white md:text-4xl">Containers are view templates that render the UI.</h1>
      <p class="mt-4 text-lg text-slate-300">Containers live in <code class="text-indigo-200">containers/</code> and are included by Services or Actions to generate HTML responses.</p>
    </section>

    <section class="mt-10 grid gap-6 lg:grid-cols-2">
      <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6">
        <h2 class="text-lg font-semibold text-white">Minimal Container</h2>
        <pre class="mt-4 overflow-hidden rounded-xl bg-slate-950 p-4 text-xs text-slate-200"><code>&lt;div&gt;
  &lt;h1&gt;Dashboard&lt;/h1&gt;
&lt;/div&gt;</code></pre>
        <p class="mt-3 text-sm text-slate-300">Save the file in a relevant container directory and include it from a Service.</p>
      </div>
      <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6">
        <h2 class="text-lg font-semibold text-white">Typical Include</h2>
        <pre class="mt-4 overflow-hidden rounded-xl bg-slate-950 p-4 text-xs text-slate-200"><code>include "containers/dashboard/index.php";</code></pre>
        <p class="mt-3 text-sm text-slate-300">Containers can access variables set by the Service or Action.</p>
      </div>
    </section>

    <section class="mt-10 grid gap-6 lg:grid-cols-3">
      <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6">
        <h3 class="text-lg font-semibold text-white">Composition</h3>
        <p class="mt-2 text-sm text-slate-300">Compose a page from multiple containers to keep layouts modular.</p>
      </div>
      <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6">
        <h3 class="text-lg font-semibold text-white">Action Hooks</h3>
        <p class="mt-2 text-sm text-slate-300">Some containers directly call <code class="text-indigo-200">getAction()</code> for data hydration.</p>
      </div>
      <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6">
        <h3 class="text-lg font-semibold text-white">Next</h3>
        <p class="mt-2 text-sm text-slate-300">Prototypes help you package data access for your containers and actions.</p>
        <a class="mt-4 inline-flex text-sm font-semibold text-indigo-300 hover:text-indigo-200" href="prototypes.md">Explore Prototypes →</a>
      </div>
    </section>
  </main>

  <footer class="border-t border-slate-800 bg-slate-950/80">
    <div class="mx-auto flex max-w-6xl flex-col gap-4 px-6 py-8 text-sm text-slate-400 md:flex-row md:items-center md:justify-between">
      <span>Next: Prototypes for data access.</span>
      <a class="font-semibold text-indigo-300 hover:text-indigo-200" href="prototypes.md">Next: Prototypes →</a>
    </div>
  </footer>
</body>
</html>
