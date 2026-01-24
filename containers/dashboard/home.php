<?php
    global $Me;

    $fullname = $Me->Fullname() ?? 'Welcome back';
    $role = $Me->role() ?? 'User';
    $email = $Me->email() ?? 'No Email';
?>

<div class="space-y-8">
    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
            <div class="<?php echo $ui['card']; ?>">
                <div class="<?php echo $ui['card_header']; ?>">
                    <div>
                        <p class="text-sm font-semibold text-blue-600">Account Overview</p>
                        <h2 class="text-2xl font-bold text-slate-900">Hello, <?php echo $fullname; ?></h2>
                        <p class="mt-1 text-sm text-slate-500">Here is a quick summary of your workspace.</p>
                    </div>
                    <span class="<?php echo $ui['badge_info']; ?>"><?php echo ucfirst($role); ?></span>
                </div>
                <div class="mt-6 grid gap-4 sm:grid-cols-3">
                    <div class="rounded-xl border border-slate-200 p-4">
                        <p class="text-xs uppercase tracking-wide text-slate-500">Profile</p>
                        <p class="mt-2 text-sm font-semibold text-slate-900"><?php echo $email; ?></p>
                        <p class="mt-1 text-xs text-slate-500">Primary email</p>
                    </div>
                    <div class="rounded-xl border border-slate-200 p-4">
                        <p class="text-xs uppercase tracking-wide text-slate-500">Plan</p>
                        <p class="mt-2 text-sm font-semibold text-slate-900">Standard</p>
                        <p class="mt-1 text-xs text-slate-500">TODO: connect plan details.</p>
                    </div>
                    <div class="rounded-xl border border-slate-200 p-4">
                        <p class="text-xs uppercase tracking-wide text-slate-500">Support</p>
                        <p class="mt-2 text-sm font-semibold text-slate-900">Help Center</p>
                        <a href="about" class="mt-1 text-xs font-semibold text-blue-600">Contact support →</a>
                    </div>
                </div>
            </div>

            <?php include "app-cat-card.php"; ?>

            <div class="<?php echo $ui['card']; ?>">
                <div class="<?php echo $ui['card_header']; ?>">
                    <div>
                        <h2 class="<?php echo $ui['card_title']; ?>">Recent Notifications</h2>
                        <p class="text-sm text-slate-500">Stay on top of updates that matter.</p>
                    </div>
                    <span class="<?php echo $ui['badge_success']; ?>">All caught up</span>
                </div>
                <div class="mt-4 space-y-4 text-sm text-slate-600">
                    <div class="flex items-start gap-3">
                        <div class="mt-1 h-2 w-2 rounded-full bg-emerald-500"></div>
                        <div>
                            <p class="font-semibold text-slate-900">Email campaigns are healthy</p>
                            <p class="text-xs text-slate-500">Review performance in your email dashboard.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="mt-1 h-2 w-2 rounded-full bg-blue-500"></div>
                        <div>
                            <p class="font-semibold text-slate-900">System update available</p>
                            <p class="text-xs text-slate-500">TODO: connect release notes.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="mt-1 h-2 w-2 rounded-full bg-amber-500"></div>
                        <div>
                            <p class="font-semibold text-slate-900">Draft content pending</p>
                            <p class="text-xs text-slate-500">Complete your draft pages to publish.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="<?php echo $ui['card']; ?>">
                <div class="<?php echo $ui['card_header']; ?>">
                    <h2 class="<?php echo $ui['card_title']; ?>">Quick Shortcuts</h2>
                </div>
                <div class="mt-4 space-y-3">
                    <a href="?action=emails" class="flex items-center justify-between rounded-lg border border-slate-200 px-4 py-3 text-sm text-slate-600 transition hover:border-blue-200 hover:bg-blue-50">
                        <span class="flex items-center gap-2"><i class="fa fa-envelope text-blue-600"></i> Email campaigns</span>
                        <i class="fa fa-arrow-right text-xs text-slate-400"></i>
                    </a>
                    <a href="?action=pages" class="flex items-center justify-between rounded-lg border border-slate-200 px-4 py-3 text-sm text-slate-600 transition hover:border-blue-200 hover:bg-blue-50">
                        <span class="flex items-center gap-2"><i class="fa fa-file-alt text-blue-600"></i> Manage pages</span>
                        <i class="fa fa-arrow-right text-xs text-slate-400"></i>
                    </a>
                    <a href="?action=updatesetting" class="flex items-center justify-between rounded-lg border border-slate-200 px-4 py-3 text-sm text-slate-600 transition hover:border-blue-200 hover:bg-blue-50">
                        <span class="flex items-center gap-2"><i class="fa fa-cog text-blue-600"></i> Business settings</span>
                        <i class="fa fa-arrow-right text-xs text-slate-400"></i>
                    </a>
                    <a href="?action=myprofile" class="flex items-center justify-between rounded-lg border border-slate-200 px-4 py-3 text-sm text-slate-600 transition hover:border-blue-200 hover:bg-blue-50">
                        <span class="flex items-center gap-2"><i class="fa fa-user text-blue-600"></i> Edit profile</span>
                        <i class="fa fa-arrow-right text-xs text-slate-400"></i>
                    </a>
                </div>
            </div>

            <div class="<?php echo $ui['card']; ?>">
                <div class="<?php echo $ui['card_header']; ?>">
                    <h2 class="<?php echo $ui['card_title']; ?>">Profile Summary</h2>
                    <a href="?action=myprofile" class="text-sm font-semibold text-blue-600">View</a>
                </div>
                <div class="mt-4 flex items-center gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-100 text-blue-600">
                        <i class="fa fa-user"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-900"><?php echo $fullname; ?></p>
                        <p class="text-xs text-slate-500"><?php echo $email; ?></p>
                        <span class="mt-2 inline-flex text-xs font-semibold text-slate-500">Role: <?php echo ucfirst($role); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
