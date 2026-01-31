<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Services | JamilX Documentation</title>
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
      <a class="rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-900 hover:bg-slate-200" href="actions.md">Next: Actions</a>
    </div>
  </header>

  <main class="mx-auto max-w-6xl px-6 pb-20 pt-12">
    <section class="rounded-3xl border border-slate-800 bg-slate-900/60 p-10">
      <p class="text-sm font-semibold uppercase tracking-[0.2em] text-indigo-300">Services</p>
      <h1 class="mt-3 text-3xl font-semibold text-white md:text-4xl">Service classes own routes and orchestrate Actions and Containers.</h1>
      <p class="mt-4 text-lg text-slate-300">Each route resolves to a Service class in <code class="text-indigo-200">services/</code>. The router instantiates the Service and calls <code class="text-indigo-200">main()</code> to drive the response.</p>
    </section>

    <section class="mt-10 grid gap-6 lg:grid-cols-2">
      <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6">
        <h2 class="text-lg font-semibold text-white">Minimal Service</h2>
        <pre class="mt-4 overflow-hidden rounded-xl bg-slate-950 p-4 text-xs text-slate-200"><code>class Billing extends JX_Serivce implements JX_service
{
    public function main()
    {
        include "containers/billing/index.php";
    }
}</code></pre>
        <p class="mt-3 text-sm text-slate-300">Save as <code class="text-indigo-200">services/billing.php</code> and visit <code class="text-indigo-200">/billing</code>.</p>
      </div>
      <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6">
        <h2 class="text-lg font-semibold text-white">Typical Flow</h2>
        <p class="mt-2 text-sm text-slate-300">Services often select an Action based on the <code class="text-indigo-200">action</code> query parameter, then load a Container.</p>
        <pre class="mt-4 overflow-hidden rounded-xl bg-slate-950 p-4 text-xs text-slate-200"><code>$action = is_null($Url->get('action')) ? 'home' : $Url->get('action');
include 'containers/dashboard/dashboard.php';</code></pre>
      </div>
    </section>

    <section class="mt-10 grid gap-6 lg:grid-cols-3">
      <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6">
        <h3 class="text-lg font-semibold text-white">Naming</h3>
        <p class="mt-2 text-sm text-slate-300">Service class names align with their route and file name. Keep the class definition at the top-level of the file.</p>
      </div>
      <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6">
        <h3 class="text-lg font-semibold text-white">Actions</h3>
        <p class="mt-2 text-sm text-slate-300">Actions encapsulate specialized logic and can be invoked inside the Service.</p>
        <a class="mt-4 inline-flex text-sm font-semibold text-indigo-300 hover:text-indigo-200" href="actions.md">Explore Actions →</a>
      </div>
      <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-6">
        <h3 class="text-lg font-semibold text-white">Containers</h3>
        <p class="mt-2 text-sm text-slate-300">Containers render UI output and keep templates close to the Service.</p>
        <a class="mt-4 inline-flex text-sm font-semibold text-indigo-300 hover:text-indigo-200" href="containers.md">Explore Containers →</a>
      </div>
    </section>
  </main>

  <footer class="border-t border-slate-800 bg-slate-950/80">
    <div class="mx-auto flex max-w-6xl flex-col gap-4 px-6 py-8 text-sm text-slate-400 md:flex-row md:items-center md:justify-between">
      <span>Next: detail how Actions support Services.</span>
      <a class="font-semibold text-indigo-300 hover:text-indigo-200" href="actions.md">Next: Actions →</a>
    </div>
  </footer>
</body>
</html>
