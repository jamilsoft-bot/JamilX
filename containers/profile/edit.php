<?php
$displayName = $profile['display_name'] ?? ($userRow['name'] ?? '');
$headline = $profile['headline'] ?? '';
$bio = $profile['bio'] ?? '';
$website = $profile['website'] ?? '';
$location = $profile['location'] ?? '';
$timezone = $profile['timezone'] ?? '';
$pronouns = $profile['pronouns'] ?? '';
$skillsValue = is_array($skills) ? implode(', ', $skills) : '';
$twitter = $socialLinks['twitter'] ?? '';
$linkedin = $socialLinks['linkedin'] ?? '';
$github = $socialLinks['github'] ?? '';
?>

<form action="profile?action=update" method="post" class="space-y-6">
    <div class="rounded-3xl bg-white p-6 shadow-sm">
        <h3 class="text-lg font-semibold text-slate-900">Core Details</h3>
        <div class="mt-6 grid gap-4 md:grid-cols-2">
            <div>
                <label class="text-sm font-medium text-slate-600" for="display_name">Display Name</label>
                <input class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm" type="text" id="display_name" name="display_name" value="<?php echo htmlspecialchars($displayName); ?>">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-600" for="headline">Headline</label>
                <input class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm" type="text" id="headline" name="headline" value="<?php echo htmlspecialchars($headline); ?>" placeholder="Product designer at JamilX">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-600" for="website">Website</label>
                <input class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm" type="url" id="website" name="website" value="<?php echo htmlspecialchars($website); ?>" placeholder="https://">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-600" for="location">Location</label>
                <input class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm" type="text" id="location" name="location" value="<?php echo htmlspecialchars($location); ?>" placeholder="City, Country">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-600" for="timezone">Timezone</label>
                <input class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm" type="text" id="timezone" name="timezone" value="<?php echo htmlspecialchars($timezone); ?>" placeholder="UTC+1">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-600" for="pronouns">Pronouns</label>
                <input class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm" type="text" id="pronouns" name="pronouns" value="<?php echo htmlspecialchars($pronouns); ?>" placeholder="she/her">
            </div>
        </div>
        <div class="mt-4">
            <label class="text-sm font-medium text-slate-600" for="bio">Bio</label>
            <textarea class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm" rows="4" id="bio" name="bio" placeholder="Share a short bio..."><?php echo htmlspecialchars($bio); ?></textarea>
        </div>
    </div>

    <div class="rounded-3xl bg-white p-6 shadow-sm">
        <h3 class="text-lg font-semibold text-slate-900">Skills & Expertise</h3>
        <p class="mt-2 text-sm text-slate-500">Add skills separated by commas.</p>
        <input class="mt-4 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm" type="text" id="skills" name="skills" value="<?php echo htmlspecialchars($skillsValue); ?>" placeholder="Design systems, PHP, Product strategy">
    </div>

    <div class="rounded-3xl bg-white p-6 shadow-sm">
        <h3 class="text-lg font-semibold text-slate-900">Social Links</h3>
        <div class="mt-4 grid gap-4 md:grid-cols-3">
            <div>
                <label class="text-sm font-medium text-slate-600" for="twitter">Twitter</label>
                <input class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm" type="text" id="twitter" name="twitter" value="<?php echo htmlspecialchars($twitter); ?>" placeholder="@handle">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-600" for="linkedin">LinkedIn</label>
                <input class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm" type="text" id="linkedin" name="linkedin" value="<?php echo htmlspecialchars($linkedin); ?>" placeholder="linkedin.com/in/">
            </div>
            <div>
                <label class="text-sm font-medium text-slate-600" for="github">GitHub</label>
                <input class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm" type="text" id="github" name="github" value="<?php echo htmlspecialchars($github); ?>" placeholder="github.com/">
            </div>
        </div>
    </div>

    <div class="flex justify-end gap-3">
        <a href="profile?action=view" class="rounded-full border border-slate-200 px-6 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100">Cancel</a>
        <button class="rounded-full bg-blue-600 px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700" type="submit">Save Profile</button>
    </div>
</form>
