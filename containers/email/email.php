<?php include "header.php"; ?>

<body class="bg-slate-50 min-h-screen">

    <!-- Navigation Sidebar -->
    <?php include "nav.php"; ?>

    <!-- Main Content -->
    <div class="lg:pl-64 flex flex-col flex-1">
        <main class="flex-1 pb-8">
            <!-- Page Header -->
            <div class="bg-white shadow-sm border-b border-slate-200">
                <div class="px-4 sm:px-6 lg:px-8 py-4">
                    <h1 class="text-2xl font-bold leading-7 text-slate-900 sm:truncate sm:tracking-tight">
                        <?php echo $getAction->getTitle(); ?>
                    </h1>
                </div>
            </div>

            <!-- Page Content -->
            <div class="px-4 sm:px-6 lg:px-8 py-8">
                <?php $getAction->getAction(); ?>
            </div>
        </main>
    </div>

    <script src="assets/lib/bs5/js/bootstrap.bundle.min.js"></script>
</body>

</html>