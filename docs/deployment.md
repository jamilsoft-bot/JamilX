<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Deployment | JamilX Documentation</title>
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
      <a class="rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-900 hover:bg-slate-200" href="troubleshooting.md">Next: Support</a>
    </div>
  </header>

  <main class="mx-auto max-w-6xl px-6 pb-20 pt-12">
    <section class="rounded-3xl border border-slate-800 bg-slate-900/60 p-10">
      <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-300">Deployment</p>
      <h1 class="mt-3 text-3xl font-semibold text-white md:text-4xl">Deploy JamilX confidently on Apache and PHP.</h1>
      <p class="mt-4 text-lg text-slate-300">JamilX expects the repository root to be the public webroot so routing and installer paths resolve correctly.</p>
    </section>

    <section class="mt-10 grid gap-6 lg:grid-cols-2">
      <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6">
        <h2 class="text-lg font-semibold text-white">Webroot</h2>
        <p class="mt-2 text-sm text-slate-300">Point your server document root to the repository root.</p>
        <div class="mt-4 rounded-xl bg-slate-950 p-4 text-sm text-slate-200">
          <code>DocumentRoot = /path/to/JamilX</code>
        </div>
      </div>
      <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6">
        <h2 class="text-lg font-semibold text-white">Rewrite Rules</h2>
        <p class="mt-2 text-sm text-slate-300">Ensure Apache <code class="text-indigo-200">mod_rewrite</code> is enabled and that <code class="text-indigo-200">.htaccess</code> is honored.</p>
      </div>
    </section>

    <section class="mt-10 grid gap-6 lg:grid-cols-3">
      <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6">
        <h3 class="text-lg font-semibold text-white">Writable Paths</h3>
        <p class="mt-2 text-sm text-slate-300">Make sure <code class="text-indigo-200">logs/</code> and <code class="text-indigo-200">data/</code> are writable.</p>
      </div>
      <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6">
        <h3 class="text-lg font-semibold text-white">Production Mode</h3>
        <p class="mt-2 text-sm text-slate-300">Set <code class="text-indigo-200">MODE="production"</code> in <code class="text-indigo-200">.env</code> for production bootstrapping.</p>
      </div>
      <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6">
        <h3 class="text-lg font-semibold text-white">Installer Access</h3>
        <p class="mt-2 text-sm text-slate-300">Protect or remove the installer once deployment is complete.</p>
      </div>
    </section>
  </main>

  <footer class="border-t border-slate-800 bg-slate-950/80">
    <div class="mx-auto flex max-w-6xl flex-col gap-4 px-6 py-8 text-sm text-slate-400 md:flex-row md:items-center md:justify-between">
      <span>Need operational guidance? Visit support next.</span>
      <a class="font-semibold text-indigo-300 hover:text-indigo-200" href="troubleshooting.md">Next: Support →</a>
    </div>
  </footer>
</body>
</html>
