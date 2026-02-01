<?php include "header.php"; ?>
<!-- No usage of 'include nav.php' inside the body flow if using fixed sidebar; handled below -->
<!-- But traditionally this file included nav.php at top. We will follow our new pattern. -->

<!-- Mobile Nav (Hidden on Desktop) handled in nav.php -->
<?php include "nav.php"; ?>

<div class="lg:pl-64 flex flex-col min-h-screen">
    <main class="flex-1">

        <!-- Top Bar for Desktop (Search/Notifications) -->
        <div class="sticky top-0 z-10 flex h-16 flex-shrink-0 bg-white shadow-sm border-b border-slate-200">
            <div class="flex flex-1 items-center justify-between px-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-4">
                    <div class="hidden sm:flex items-center gap-2 text-sm text-slate-500">
                        <i class="fas fa-layer-group text-blue-500"></i>
                        <span class="font-semibold text-slate-700">ERP Dashboard</span>
                    </div>
                    <form class="flex w-full md:ml-0" action="#" method="GET">
                        <label for="search-field" class="sr-only">Search</label>
                        <div class="relative w-full text-slate-400 focus-within:text-slate-600">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center">
                                <i class="fas fa-search h-5 w-5"></i>
                            </div>
                            <input name="search" id="search-field" class="block h-10 w-64 rounded-lg border border-slate-200 bg-slate-50 py-2 pl-8 pr-3 text-slate-900 placeholder-slate-500 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-0 sm:text-sm" placeholder="Search modules or actions..." type="search">
                        </div>
                    </form>
                </div>
                <div class="ml-4 flex items-center gap-3 md:ml-6">
                    <a href="invoice?action=new" class="hidden sm:inline-flex items-center gap-2 rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                        <i class="fas fa-plus-circle"></i>
                        New Invoice
                    </a>
                    <button type="button" class="rounded-full bg-white p-1 text-slate-400 hover:text-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <span class="sr-only">View notifications</span>
                        <i class="fas fa-bell h-6 w-6"></i>
                    </button>
                    <div class="hidden sm:flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1 text-xs text-slate-500">
                        <i class="fas fa-user-circle text-slate-400"></i>
                        Account
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Header -->
        <div class="bg-white shadow">
            <div class="px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-widest text-slate-400">Control Center</p>
                        <h1 class="text-3xl font-bold leading-tight tracking-tight text-slate-900"><?php echo isset($getAction) ? $getAction->getTitle() : 'Dashboard'; ?></h1>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="billing/" class="inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-700 shadow-sm hover:border-blue-500 hover:text-blue-600">
                            <i class="fas fa-credit-card text-blue-500"></i>
                            Billing
                        </a>
                    </div>
                </div>
                <?php if (isset($getAction) && method_exists($getAction, 'getText') && $getAction->getText() !== '') : ?>
                    <p class="mt-2 text-sm text-slate-500"><?php echo $getAction->getText(); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Main Content -->
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
            <?php $getAction->getAction(); ?>
        </div>
    </main>
</div>

</body>

</html>
