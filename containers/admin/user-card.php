<?php
// Default avatar if null
$displayLogo = ($logo == null) ? "assets/images/user.png" : "data/$logo";
?>
<div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 overflow-hidden border border-gray-100 flex flex-col">
    <!-- Top Action Bar (Overlay or Top Right) -->
    <div class="flex justify-end p-2 space-x-1 bg-gray-50 border-b border-gray-100">
        <a href="?serve=users&action=update&id=<?php echo $id; ?>" class="p-1.5 text-gray-500 hover:text-indigo-600 hover:bg-white rounded-md transition-colors" title="Edit">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
        </a>
        <a href="?serve=users&action=read&id=<?php echo $id; ?>" class="p-1.5 text-gray-500 hover:text-green-600 hover:bg-white rounded-md transition-colors" title="View">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
        </a>
        <a href="?action=users&del=<?php echo $id; ?>" class="p-1.5 text-gray-500 hover:text-red-600 hover:bg-white rounded-md transition-colors" title="Delete" onclick="return confirm('Are you sure you want to delete this user?');">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
        </a>
    </div>

    <div class="p-6 flex flex-col items-center flex-grow">
        <!-- Avatar -->
        <div class="relative w-24 h-24 mb-4">
            <img src="<?php echo $displayLogo; ?>" alt="<?php echo htmlspecialchars($name); ?>" class="w-full h-full object-cover rounded-full border-4 border-indigo-50 shadow-sm">
            <span class="absolute bottom-1 right-1 w-4 h-4 bg-green-400 border-2 border-white rounded-full" title="Active"></span>
        </div>

        <!-- User Info -->
        <h3 class="text-lg font-bold text-gray-900 text-center mb-1"><?php echo htmlspecialchars($username); ?></h3>
        <p class="text-sm text-gray-500 text-center mb-3"><?php echo htmlspecialchars($name); ?></p>

        <!-- Role Badge -->
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 uppercase tracking-wide">
            <?php echo htmlspecialchars($type); ?>
        </span>
    </div>

    <!-- Footer Stats / Info -->
    <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 flex justify-between items-center text-xs text-gray-400">
        <span title="Registered Date"><?php echo $date; ?></span>
        <span title="Location" class="flex items-center">
            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <?php echo htmlspecialchars($city ?: $country ?: 'Unknown'); ?>
        </span>
    </div>
</div>