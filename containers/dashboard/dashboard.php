<?php include "header.php"; ?>
<!-- No usage of 'include nav.php' inside the body flow if using fixed sidebar; handled below -->
<!-- But traditionally this file included nav.php at top. We will follow our new pattern. -->

<!-- Mobile Nav (Hidden on Desktop) handled in nav.php -->
<?php include "nav.php"; ?>

<div class="lg:pl-64 flex flex-col min-h-screen">
    <main class="flex-1">

        <!-- Top Bar for Desktop (Search/Notifications) -->
        <div class="sticky top-0 z-10 flex h-16 flex-shrink-0 bg-white shadow-sm border-b border-slate-200">
            <div class="flex flex-1 justify-between px-4 sm:px-6 lg:px-8">
                <div class="flex flex-1">
                    <form class="flex w-full md:ml-0" action="#" method="GET">
                        <label for="search-field" class="sr-only">Search</label>
                        <div class="relative w-full text-slate-400 focus-within:text-slate-600">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center">
                                <i class="fas fa-search h-5 w-5"></i>
                            </div>
                            <input name="search" id="search-field" class="block h-full w-full border-transparent py-2 pl-8 pr-3 text-slate-900 placeholder-slate-500 focus:border-transparent focus:placeholder-slate-400 focus:outline-none focus:ring-0 sm:text-sm" placeholder="Search..." type="search">
                        </div>
                    </form>
                </div>
                <div class="ml-4 flex items-center md:ml-6">
                    <button type="button" class="rounded-full bg-white p-1 text-slate-400 hover:text-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <span class="sr-only">View notifications</span>
                        <i class="fas fa-bell h-6 w-6"></i>
                    </button>
                    <!-- Profile dropdown could go here -->
                </div>
            </div>
        </div>

        <!-- Page Header -->
        <div class="bg-white shadow">
            <div class="px-4 sm:px-6 lg:px-8 py-6">
                <h1 class="text-3xl font-bold leading-tight tracking-tight text-slate-900"><?php echo isset($getAction) ? $getAction->getTitle() : 'Dashboard'; ?></h1>
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