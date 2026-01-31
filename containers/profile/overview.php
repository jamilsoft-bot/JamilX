<?php
$displayName = $user['name'] ?? $user['username'] ?? 'Profile';
$avatar = $user['avatar'] ?? 'user.png';
$bio = $user['bio'] ?? '';
$role = $user['role'] ?? 'user';
?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center gap-4">
            <img class="h-16 w-16 rounded-full object-cover" src="data/<?php echo $avatar; ?>" alt="<?php echo $displayName; ?>">
            <div>
                <h2 class="text-xl font-semibold text-gray-900"><?php echo $displayName; ?></h2>
                <p class="text-sm text-gray-500">@<?php echo $user['username'] ?? '-'; ?></p>
                <span class="inline-flex items-center mt-2 px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700">
                    <?php echo $role; ?>
                </span>
            </div>
        </div>
        <p class="mt-4 text-sm text-gray-600"><?php echo $bio !== '' ? $bio : 'Add a short bio to introduce yourself.'; ?></p>
        <div class="mt-6 flex flex-col gap-2">
            <a class="w-full text-center px-4 py-2 rounded-md bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700" href="?action=edit">Edit Profile</a>
            <a class="w-full text-center px-4 py-2 rounded-md border border-gray-200 text-sm font-semibold text-gray-700 hover:bg-gray-50" href="?action=experience">Manage Experience</a>
        </div>
    </div>

    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Profile Overview</h3>
                    <p class="text-sm text-gray-500">Key details and contact info.</p>
                </div>
                <a class="text-sm font-semibold text-blue-600 hover:text-blue-700" href="?action=edit">Update details</a>
            </div>
            <div class="divide-y divide-gray-100">
                <div class="px-6 py-4 text-sm text-gray-700"><span class="font-medium">Email:</span> <?php echo $user['email'] ?? '-'; ?></div>
                <div class="px-6 py-4 text-sm text-gray-700"><span class="font-medium">Phone:</span> <?php echo $user['phone'] ?? '-'; ?></div>
                <div class="px-6 py-4 text-sm text-gray-700"><span class="font-medium">Location:</span> <?php echo trim(($user['city'] ?? '') . ' ' . ($user['country'] ?? '')) ?: '-'; ?></div>
                <div class="px-6 py-4 text-sm text-gray-700"><span class="font-medium">DOB:</span> <?php echo $user['dob'] ?? '-'; ?></div>
                <div class="px-6 py-4 text-sm text-gray-700"><span class="font-medium">Gender:</span> <?php echo $user['gender'] ?? '-'; ?></div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Experience</h3>
                    <p class="text-sm text-gray-500">Recent roles and highlights.</p>
                </div>
                <a class="text-sm font-semibold text-blue-600 hover:text-blue-700" href="?action=experience">Add experience</a>
            </div>
            <div class="px-6 py-4 space-y-4">
                <?php if (!empty($experiences)) : ?>
                    <?php foreach ($experiences as $experience) : ?>
                        <div class="border border-gray-100 rounded-lg p-4">
                            <h4 class="text-sm font-semibold text-gray-900"><?php echo $experience['title']; ?> · <?php echo $experience['company_name']; ?></h4>
                            <p class="text-xs text-gray-500 mt-1"><?php echo $experience['location'] ?? 'Remote'; ?> · <?php echo $experience['start_date']; ?> - <?php echo $experience['is_current'] ? 'Present' : ($experience['end_date'] ?? ''); ?></p>
                            <p class="text-sm text-gray-600 mt-2"><?php echo $experience['description'] ?? ''; ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p class="text-sm text-gray-500">No experiences yet. Add your first role to showcase your background.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
