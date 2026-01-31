<?php
$displayName = $profile['display_name'] ?? '';
$displayName = $displayName !== '' ? $displayName : ($userRow['name'] ?? 'Profile');
$username = $userRow['username'] ?? 'user';
$headline = $profile['headline'] ?? 'Add a headline to introduce yourself.';
$bio = $profile['bio'] ?? 'Share a short bio to help people understand what you do.';
$website = $profile['website'] ?? '';
$location = $profile['location'] ?? 'Not specified';
$timezone = $profile['timezone'] ?? 'Not specified';
$pronouns = $profile['pronouns'] ?? 'Not specified';
$skills = is_array($skills) ? $skills : [];
$socialLinks = is_array($socialLinks) ? $socialLinks : [];
$preferences = is_array($preferences) ? $preferences : [];
?>

<div class="grid gap-6 lg:grid-cols-3">
    <div class="lg:col-span-1 space-y-6">
        <div class="rounded-3xl bg-white p-6 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                    <i class="fas fa-user-circle text-2xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-slate-900"><?php echo htmlspecialchars($displayName); ?></h2>
                    <p class="text-sm text-slate-500">@<?php echo htmlspecialchars($username); ?></p>
                </div>
            </div>
            <p class="mt-4 text-sm text-slate-500"><?php echo htmlspecialchars($headline); ?></p>
            <?php if ($website !== '') : ?>
                <a class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-500" href="<?php echo htmlspecialchars($website); ?>" target="_blank" rel="noreferrer">
                    <i class="fas fa-link"></i>
                    <?php echo htmlspecialchars($website); ?>
                </a>
            <?php endif; ?>
        </div>

        <div class="rounded-3xl bg-white p-6 shadow-sm">
            <h3 class="text-sm font-semibold uppercase tracking-widest text-slate-400">Profile Details</h3>
            <dl class="mt-4 space-y-3 text-sm">
                <div class="flex items-center justify-between">
                    <dt class="text-slate-500">Location</dt>
                    <dd class="font-medium text-slate-700"><?php echo htmlspecialchars($location); ?></dd>
                </div>
                <div class="flex items-center justify-between">
                    <dt class="text-slate-500">Timezone</dt>
                    <dd class="font-medium text-slate-700"><?php echo htmlspecialchars($timezone); ?></dd>
                </div>
                <div class="flex items-center justify-between">
                    <dt class="text-slate-500">Pronouns</dt>
                    <dd class="font-medium text-slate-700"><?php echo htmlspecialchars($pronouns); ?></dd>
                </div>
            </dl>
        </div>
    </div>

    <div class="lg:col-span-2 space-y-6">
        <div class="rounded-3xl bg-white p-6 shadow-sm">
            <h3 class="text-lg font-semibold text-slate-900">About</h3>
            <p class="mt-3 text-sm leading-relaxed text-slate-600"><?php echo nl2br(htmlspecialchars($bio)); ?></p>
        </div>

        <div class="rounded-3xl bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-slate-900">Skills</h3>
                <a href="profile?action=edit" class="text-sm font-semibold text-blue-600 hover:text-blue-500">Update</a>
            </div>
            <div class="mt-4 flex flex-wrap gap-2">
                <?php if (count($skills) === 0) : ?>
                    <span class="text-sm text-slate-500">Add skills to showcase your strengths.</span>
                <?php else : ?>
                    <?php foreach ($skills as $skill) : ?>
                        <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700"><?php echo htmlspecialchars($skill); ?></span>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="grid gap-6 md:grid-cols-2">
            <div class="rounded-3xl bg-white p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-slate-900">Social Links</h3>
                <ul class="mt-4 space-y-3 text-sm text-slate-600">
                    <?php if (!empty($socialLinks['twitter'])) : ?>
                        <li class="flex items-center gap-2"><i class="fab fa-twitter text-blue-500"></i><?php echo htmlspecialchars($socialLinks['twitter']); ?></li>
                    <?php endif; ?>
                    <?php if (!empty($socialLinks['linkedin'])) : ?>
                        <li class="flex items-center gap-2"><i class="fab fa-linkedin text-blue-500"></i><?php echo htmlspecialchars($socialLinks['linkedin']); ?></li>
                    <?php endif; ?>
                    <?php if (!empty($socialLinks['github'])) : ?>
                        <li class="flex items-center gap-2"><i class="fab fa-github text-slate-700"></i><?php echo htmlspecialchars($socialLinks['github']); ?></li>
                    <?php endif; ?>
                    <?php if (empty($socialLinks['twitter']) && empty($socialLinks['linkedin']) && empty($socialLinks['github'])) : ?>
                        <li class="text-slate-500">Add your social links in the edit panel.</li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="rounded-3xl bg-white p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-slate-900">Visibility</h3>
                <ul class="mt-4 space-y-3 text-sm text-slate-600">
                    <li class="flex items-center justify-between">
                        <span>Email</span>
                        <span class="font-semibold text-slate-700"><?php echo !empty($preferences['show_email']) ? 'Visible' : 'Hidden'; ?></span>
                    </li>
                    <li class="flex items-center justify-between">
                        <span>Phone</span>
                        <span class="font-semibold text-slate-700"><?php echo !empty($preferences['show_phone']) ? 'Visible' : 'Hidden'; ?></span>
                    </li>
                    <li class="flex items-center justify-between">
                        <span>Location</span>
                        <span class="font-semibold text-slate-700"><?php echo !empty($preferences['show_location']) ? 'Visible' : 'Hidden'; ?></span>
                    </li>
                </ul>
                <a href="profile?action=settings" class="mt-4 inline-flex text-sm font-semibold text-blue-600 hover:text-blue-500">Manage settings</a>
            </div>
        </div>
    </div>
</div>
