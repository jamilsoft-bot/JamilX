<?php
$overview = ADKShowcase::overview();
$highlights = ADKShowcase::highlights();
$toolkit = ADKShowcase::toolkit();
$modules = ADKShowcase::modules();
$workflow = ADKShowcase::workflow();
$faqs = ADKShowcase::faqs();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ADK - Application Development Kit</title>
        <script src="assets/tailwindcss.js"></script>
    </head>
    <body class="bg-slate-950 text-slate-100">
        <div class="min-h-screen">
            <header class="border-b border-slate-800">
                <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-6">
                    <div>
                        <p class="text-sm uppercase tracking-[0.3em] text-slate-400">JamilX</p>
                        <h1 class="text-2xl font-semibold">Application Development Kit</h1>
                    </div>
                    <div class="hidden gap-4 text-sm text-slate-300 md:flex">
                        <span class="rounded-full border border-slate-700 px-3 py-1">SaaS Ready</span>
                        <span class="rounded-full border border-slate-700 px-3 py-1">cPanel Friendly</span>
                        <span class="rounded-full border border-slate-700 px-3 py-1">Rapid Scaffold</span>
                    </div>
                </div>
            </header>

            <main class="mx-auto max-w-6xl px-6 py-12">
                <section class="grid gap-10 lg:grid-cols-[1.2fr_0.8fr]">
                    <div class="space-y-6">
                        <p class="text-sm uppercase tracking-[0.3em] text-cyan-400">ADK launchpad</p>
                        <h2 class="text-4xl font-semibold leading-tight md:text-5xl">
                            <?php echo $overview['title']; ?>
                        </h2>
                        <p class="text-lg text-slate-300"><?php echo $overview['subtitle']; ?></p>
                        <p class="text-slate-400"><?php echo $overview['description']; ?></p>
                        <div class="flex flex-wrap gap-4">
                            <span class="rounded-xl bg-cyan-500 px-5 py-3 text-sm font-semibold text-slate-900">
                                Start Building
                            </span>
                            <span class="rounded-xl border border-slate-700 px-5 py-3 text-sm text-slate-300">
                                View Blueprint
                            </span>
                        </div>
                        <div class="rounded-2xl border border-slate-800 bg-slate-900/60 p-5">
                            <p class="text-xs uppercase tracking-[0.3em] text-slate-500">CLI quickstart</p>
                            <p class="mt-3 font-mono text-sm text-slate-200">
                                php jamilx make:service MySaaS<br>
                                php jamilx make:action Onboarding<br>
                                php jamilx make:container Dashboard --service mysass
                            </p>
                        </div>
                    </div>
                    <div class="space-y-6 rounded-3xl border border-slate-800 bg-gradient-to-br from-slate-900/60 to-slate-950 p-8">
                        <div>
                            <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Release playbook</p>
                            <h3 class="mt-3 text-2xl font-semibold">Ship with confidence</h3>
                            <p class="mt-2 text-sm text-slate-400">
                                ADK keeps your deployment checklist close so teams can iterate without chaos.
                            </p>
                        </div>
                        <ul class="space-y-4 text-sm text-slate-300">
                            <li class="flex gap-3">
                                <span class="mt-1 h-2 w-2 rounded-full bg-cyan-400"></span>
                                Validate environment variables, database credentials, and mailer config.
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-1 h-2 w-2 rounded-full bg-cyan-400"></span>
                                Run seeded workflows with staging data before production cutover.
                            </li>
                            <li class="flex gap-3">
                                <span class="mt-1 h-2 w-2 rounded-full bg-cyan-400"></span>
                                Snapshot assets and enable rollback container backups.
                            </li>
                        </ul>
                        <div class="rounded-2xl border border-slate-800 bg-slate-950/70 p-4 text-sm text-slate-300">
                            <p class="text-xs uppercase tracking-[0.3em] text-slate-500">Last mile</p>
                            <p class="mt-2">Promote, monitor, and iterate with the built-in KPI dashboard module.</p>
                        </div>
                    </div>
                </section>

                <section class="mt-16">
                    <div class="grid gap-6 md:grid-cols-3">
                        <?php foreach ($highlights as $highlight) { ?>
                            <div class="rounded-2xl border border-slate-800 bg-slate-900/40 p-6">
                                <h3 class="text-lg font-semibold"><?php echo $highlight['title']; ?></h3>
                                <p class="mt-2 text-sm text-slate-400"><?php echo $highlight['text']; ?></p>
                            </div>
                        <?php } ?>
                    </div>
                </section>

                <section class="mt-16 grid gap-12 lg:grid-cols-[1fr_1fr]">
                    <div>
                        <h3 class="text-2xl font-semibold">What ships with ADK</h3>
                        <p class="mt-3 text-sm text-slate-400">
                            Build fast with a curated set of templates and prebuilt flows aligned to the JamilX ecosystem.
                        </p>
                        <div class="mt-6 space-y-4">
                            <?php foreach ($toolkit as $item) { ?>
                                <div class="rounded-2xl border border-slate-800 bg-slate-900/40 p-5">
                                    <h4 class="text-base font-semibold"><?php echo $item['name']; ?></h4>
                                    <p class="mt-2 text-sm text-slate-400"><?php echo $item['detail']; ?></p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="rounded-3xl border border-slate-800 bg-slate-900/30 p-8">
                        <h3 class="text-2xl font-semibold">Starter modules</h3>
                        <p class="mt-3 text-sm text-slate-400">
                            Mix and match modules to create a launch-ready SaaS in days, not weeks.
                        </p>
                        <div class="mt-6 grid gap-4">
                            <?php foreach ($modules as $module) { ?>
                                <div class="rounded-xl border border-slate-800 bg-slate-950/60 p-4">
                                    <div class="flex items-center justify-between">
                                        <h4 class="text-base font-semibold"><?php echo $module['label']; ?></h4>
                                        <span class="text-xs uppercase tracking-[0.2em] text-cyan-400">Included</span>
                                    </div>
                                    <p class="mt-2 text-sm text-slate-400"><?php echo $module['text']; ?></p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </section>

                <section class="mt-16 grid gap-10 lg:grid-cols-[0.8fr_1.2fr]">
                    <div class="rounded-3xl border border-slate-800 bg-gradient-to-br from-cyan-500/10 to-slate-950 p-8">
                        <h3 class="text-2xl font-semibold">Workflow</h3>
                        <p class="mt-3 text-sm text-slate-400">Simple steps to get your product live.</p>
                        <ol class="mt-6 space-y-4 text-sm text-slate-300">
                            <?php foreach ($workflow as $index => $step) { ?>
                                <li class="flex gap-3">
                                    <span class="flex h-7 w-7 items-center justify-center rounded-full bg-cyan-500 text-sm font-semibold text-slate-900">
                                        <?php echo $index + 1; ?>
                                    </span>
                                    <span><?php echo $step; ?></span>
                                </li>
                            <?php } ?>
                        </ol>
                    </div>
                    <div class="rounded-3xl border border-slate-800 bg-slate-900/40 p-8">
                        <h3 class="text-2xl font-semibold">Frequently asked</h3>
                        <div class="mt-6 space-y-4">
                            <?php foreach ($faqs as $faq) { ?>
                                <div class="rounded-2xl border border-slate-800 bg-slate-950/60 p-5">
                                    <h4 class="text-base font-semibold"><?php echo $faq['question']; ?></h4>
                                    <p class="mt-2 text-sm text-slate-400"><?php echo $faq['answer']; ?></p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </section>
            </main>

            <section class="border-t border-slate-800 bg-slate-950/60">
                <div class="mx-auto flex max-w-6xl flex-col items-start justify-between gap-6 px-6 py-10 md:flex-row md:items-center">
                    <div>
                        <h3 class="text-2xl font-semibold">Launch your next SaaS on JamilX</h3>
                        <p class="mt-2 text-sm text-slate-400">
                            ADK is designed for teams that want speed, clarity, and consistency.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-4">
                        <span class="rounded-xl bg-cyan-500 px-6 py-3 text-sm font-semibold text-slate-900">
                            Download Blueprint
                        </span>
                        <span class="rounded-xl border border-slate-700 px-6 py-3 text-sm text-slate-300">
                            Talk to the Team
                        </span>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>
