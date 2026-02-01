<?php include "header.php"; ?>
<?php include "nav.php"; ?>

<div class="lg:pl-64 min-h-screen">
    <!-- Top Bar -->
    <div class="sticky top-0 z-10 bg-white shadow-sm border-b border-slate-200">
        <div class="px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-900"><?php echo $getAction->getTitle(); ?></h1>
            </div>
            <div class="flex items-center gap-3">
                <a href="?serve=appdev&action=create" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-4 py-2 rounded-lg font-semibold hover:shadow-lg transition-all">
                    <i class="fas fa-plus"></i>
                    <span>New App</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="px-4 sm:px-6 lg:px-8 py-8">
        <?php
        global $Url;
        $action = $Url->get('action') ?? 'home';

        // Route to appropriate view
        switch ($action) {
            case 'home':
                include 'home.php';
                break;
            case 'list':
                include 'list.php';
                break;
            case 'create':
                include 'create.php';
                break;
            case 'edit':
                include 'edit.php';
                break;
            case 'details':
                include 'details.php';
                break;
            case 'studio':
                include 'studio.php';
                break;
            case 'settings':
                include 'settings.php';
                break;
            default:
                include 'home.php';
        }
        ?>
    </main>
</div>

</body>

</html>
