<?php
$displayName = $user['name'] ?? $user['username'] ?? 'Profile';
?>

<div class="max-w-5xl mx-auto space-y-6">
    <div class="bg-white rounded-lg shadow px-6 py-4 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-semibold text-gray-900">Experience for <?php echo $displayName; ?></h3>
            <p class="text-sm text-gray-500">Add or review work history entries.</p>
        </div>
        <a class="text-sm font-semibold text-blue-600 hover:text-blue-700" href="?action=overview">Back to overview</a>
    </div>

    <?php if (!empty($message)) : ?>
        <div class="px-6 py-3 rounded-md bg-blue-50 text-blue-700 text-sm">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-100">
            <h4 class="text-base font-semibold text-gray-900">Add Experience</h4>
        </div>
        <form method="post" class="px-6 py-6 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <label class="block text-sm font-medium text-gray-700">Title
                    <input class="mt-2 w-full rounded-md border border-gray-200 px-3 py-2" name="title" required>
                </label>
                <label class="block text-sm font-medium text-gray-700">Company
                    <input class="mt-2 w-full rounded-md border border-gray-200 px-3 py-2" name="company_name" required>
                </label>
                <label class="block text-sm font-medium text-gray-700">Location
                    <input class="mt-2 w-full rounded-md border border-gray-200 px-3 py-2" name="location">
                </label>
                <label class="block text-sm font-medium text-gray-700">Start Date
                    <input type="date" class="mt-2 w-full rounded-md border border-gray-200 px-3 py-2" name="start_date" required>
                </label>
                <label class="block text-sm font-medium text-gray-700">End Date
                    <input type="date" class="mt-2 w-full rounded-md border border-gray-200 px-3 py-2" name="end_date">
                </label>
                <label class="flex items-center gap-2 text-sm text-gray-700 mt-6">
                    <input type="checkbox" class="rounded border-gray-300" name="is_current" value="1">
                    Currently working here
                </label>
            </div>
            <label class="block text-sm font-medium text-gray-700">Description
                <textarea class="mt-2 w-full rounded-md border border-gray-200 px-3 py-2" name="description" rows="4"></textarea>
            </label>
            <div class="flex justify-end">
                <button class="px-6 py-2 rounded-md bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700" type="submit">Add experience</button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-100">
            <h4 class="text-base font-semibold text-gray-900">Experience Timeline</h4>
        </div>
        <div class="px-6 py-4 space-y-4">
            <?php if (!empty($experiences)) : ?>
                <?php foreach ($experiences as $experience) : ?>
                    <div class="border border-gray-100 rounded-lg p-4">
                        <h5 class="text-sm font-semibold text-gray-900"><?php echo $experience['title']; ?> · <?php echo $experience['company_name']; ?></h5>
                        <p class="text-xs text-gray-500 mt-1"><?php echo $experience['location'] ?? 'Remote'; ?> · <?php echo $experience['start_date']; ?> - <?php echo $experience['is_current'] ? 'Present' : ($experience['end_date'] ?? ''); ?></p>
                        <p class="text-sm text-gray-600 mt-2"><?php echo $experience['description'] ?? ''; ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="text-sm text-gray-500">No experience entries yet. Add one above to get started.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
