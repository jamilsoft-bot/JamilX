<?php
$showEmail = !empty($preferences['show_email']);
$showPhone = !empty($preferences['show_phone']);
$showLocation = !empty($preferences['show_location']);
$newsletter = !empty($preferences['newsletter']);
?>

<form action="profile?action=settingsupdate" method="post" class="space-y-6">
    <div class="rounded-3xl bg-white p-6 shadow-sm">
        <h3 class="text-lg font-semibold text-slate-900">Visibility Preferences</h3>
        <p class="mt-2 text-sm text-slate-500">Choose what information is visible on your public profile.</p>
        <div class="mt-6 space-y-4">
            <label class="flex items-center justify-between rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3 text-sm text-slate-600">
                <span>Show email address</span>
                <input type="checkbox" name="show_email" class="h-5 w-5 rounded border-slate-300 text-blue-600" <?php echo $showEmail ? 'checked' : ''; ?>>
            </label>
            <label class="flex items-center justify-between rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3 text-sm text-slate-600">
                <span>Show phone number</span>
                <input type="checkbox" name="show_phone" class="h-5 w-5 rounded border-slate-300 text-blue-600" <?php echo $showPhone ? 'checked' : ''; ?>>
            </label>
            <label class="flex items-center justify-between rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3 text-sm text-slate-600">
                <span>Show location</span>
                <input type="checkbox" name="show_location" class="h-5 w-5 rounded border-slate-300 text-blue-600" <?php echo $showLocation ? 'checked' : ''; ?>>
            </label>
        </div>
    </div>

    <div class="rounded-3xl bg-white p-6 shadow-sm">
        <h3 class="text-lg font-semibold text-slate-900">Notifications</h3>
        <p class="mt-2 text-sm text-slate-500">Stay in the loop with product updates and announcements.</p>
        <label class="mt-6 flex items-center justify-between rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3 text-sm text-slate-600">
            <span>Subscribe to the newsletter</span>
            <input type="checkbox" name="newsletter" class="h-5 w-5 rounded border-slate-300 text-blue-600" <?php echo $newsletter ? 'checked' : ''; ?>>
        </label>
    </div>

    <div class="flex justify-end gap-3">
        <a href="profile?action=view" class="rounded-full border border-slate-200 px-6 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-100">Back</a>
        <button class="rounded-full bg-blue-600 px-6 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700" type="submit">Save Settings</button>
    </div>
</form>
