<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Apps & Modules | JamilX Documentation</title>
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
      <a class="rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-900 hover:bg-slate-200" href="cli.md">Next: CLI</a>
    </div>
  </header>

  <main class="mx-auto max-w-6xl px-6 pb-20 pt-12">
    <section class="rounded-3xl border border-slate-800 bg-slate-900/60 p-10">
      <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-300">Apps & Modules</p>
      <h1 class="mt-3 text-3xl font-semibold text-white md:text-4xl">Ship modular features with app packages and module scaffolding.</h1>
      <p class="mt-4 text-lg text-slate-300">Apps live in <code class="text-indigo-200">Apps/</code> and load at runtime from the database. Modules scaffold a Service, Action, Container, and Prototype in a single command.</p>
    </section>

    <section class="mt-10 grid gap-6 lg:grid-cols-2">
      <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6">
        <h2 class="text-lg font-semibold text-white">Apps</h2>
        <p class="mt-2 text-sm text-slate-300">Each app has its own folder and <code class="text-indigo-200">conf.json</code> definition.</p>
        <div class="mt-4 rounded-xl bg-slate-950 p-4 text-sm text-slate-200">
          <code>Apps/MyApp/conf.json</code>
        </div>
        <ul class="mt-4 space-y-2 text-sm text-slate-300">
          <li>Install the app so it appears in the <code class="text-indigo-200">apps</code> table.</li>
          <li>Apps load during boot via <code class="text-indigo-200">Apps->Get_Installed_Apps()</code>.</li>
        </ul>
      </div>
      <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6">
        <h2 class="text-lg font-semibold text-white">Modules</h2>
        <p class="mt-2 text-sm text-slate-300">Generate a full feature stack with one CLI command.</p>
        <div class="mt-4 rounded-xl bg-slate-950 p-4 text-sm text-slate-200">
          <code>php jamilx make:module Blog</code>
        </div>
        <p class="mt-3 text-sm text-slate-300">The generator creates a Service, Action, Container, and Prototype wired together for you.</p>
      </div>
    </section>

    <section class="mt-10 rounded-3xl border border-slate-800 bg-slate-900/60 p-8">
      <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
          <h2 class="text-xl font-semibold text-white">Create a new app</h2>
          <p class="mt-2 text-sm text-slate-300">Use the built-in generator to scaffold a new app package.</p>
        </div>
        <div class="rounded-2xl bg-slate-950 px-6 py-4 text-sm text-slate-200">
          <code>php jamilx create:app MyApp</code>
        </div>
      </div>
    </section>
  </main>

  <footer class="border-t border-slate-800 bg-slate-950/80">
    <div class="mx-auto flex max-w-6xl flex-col gap-4 px-6 py-8 text-sm text-slate-400 md:flex-row md:items-center md:justify-between">
      <span>Next: learn the CLI toolkit in detail.</span>
      <a class="font-semibold text-indigo-300 hover:text-indigo-200" href="cli.md">Next: CLI →</a>
    </div>
  </footer>
</body>
</html>
