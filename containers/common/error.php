<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internal Error</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-950 text-slate-100">
    <main class="mx-auto flex min-h-screen max-w-5xl items-center px-6 py-16">
        <div class="w-full rounded-3xl border border-slate-800 bg-gradient-to-br from-slate-900 via-slate-900 to-slate-800 p-10 shadow-2xl">
            <div class="flex flex-wrap items-center justify-between gap-6">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-blue-300">System alert</p>
                    <h1 class="mt-3 text-3xl font-semibold text-white sm:text-4xl">An internal error has been detected.</h1>
                    <p class="mt-3 max-w-2xl text-sm text-slate-300">
                        The platform logged the issue below so your team can respond quickly.
                    </p>
                </div>
                <span class="inline-flex items-center gap-2 rounded-full border border-slate-700 bg-slate-900/70 px-4 py-2 text-xs font-semibold text-slate-300">
                    Status: 500
                </span>
            </div>
            <div class="mt-8 rounded-2xl border border-slate-800 bg-slate-950/70 p-6 font-mono text-xs leading-relaxed text-slate-200">
                <?php include "logs/errors.log" ?>
            </div>
        </div>
    </main>
</body>
</html>
