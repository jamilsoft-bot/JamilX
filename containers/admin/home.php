<?php
global $JX_db;

$stats = [
    'users' => null,
    'apps' => null,
    'roles' => null,
    'categories' => null,
];

if (isset($JX_db)) {
    $queries = [
        'users' => 'SELECT COUNT(*) AS total FROM users',
        'apps' => 'SELECT COUNT(*) AS total FROM apps',
        'roles' => 'SELECT COUNT(*) AS total FROM roles',
        'categories' => 'SELECT COUNT(*) AS total FROM categories',
    ];

    foreach ($queries as $key => $sql) {
        $result = $JX_db->query($sql);
        if ($result) {
            foreach ($result as $row) {
                $stats[$key] = (int) $row['total'];
                break;
            }
        }
    }
}

$recentUsers = [];
if (isset($JX_db)) {
    $recentResult = $JX_db->query('SELECT name, username, role, date_reg FROM users ORDER BY id DESC LIMIT 5');
    if ($recentResult) {
        foreach ($recentResult as $row) {
            $recentUsers[] = $row;
        }
    }
}

$statValue = function ($value) {
    return $value === null ? '—' : number_format($value);
};
?>

<div class="space-y-8">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <p class="text-sm font-semibold text-blue-600">Admin Overview</p>
            <h1 class="text-2xl font-bold text-slate-900">Welcome back to JamilX</h1>
            <p class="mt-1 text-sm text-slate-500">Monitor activity, manage content, and keep the platform healthy.</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="?action=createapp" class="<?php echo $ui['btn_primary']; ?>">
                <i class="fa fa-plus"></i>
                New App
            </a>
            <a href="?action=createuser" class="<?php echo $ui['btn_secondary']; ?>">
                <i class="fa fa-user-plus"></i>
                Invite User
            </a>
        </div>
    </div>

    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        <div class="<?php echo $ui['card']; ?>">
            <div class="<?php echo $ui['card_header']; ?>">
                <div>
                    <p class="text-sm text-slate-500">Total Users</p>
                    <p class="mt-2 text-2xl font-bold text-slate-900"><?php echo $statValue($stats['users']); ?></p>
                </div>
                <span class="<?php echo $ui['badge_info']; ?>">Active</span>
            </div>
            <p class="mt-4 text-xs text-slate-400">Based on registered users.</p>
        </div>
        <div class="<?php echo $ui['card']; ?>">
            <div class="<?php echo $ui['card_header']; ?>">
                <div>
                    <p class="text-sm text-slate-500">Apps Installed</p>
                    <p class="mt-2 text-2xl font-bold text-slate-900"><?php echo $statValue($stats['apps']); ?></p>
                </div>
                <span class="<?php echo $ui['badge_success']; ?>">Operational</span>
            </div>
            <p class="mt-4 text-xs text-slate-400">Apps available in the ecosystem.</p>
        </div>
        <div class="<?php echo $ui['card']; ?>">
            <div class="<?php echo $ui['card_header']; ?>">
                <div>
                    <p class="text-sm text-slate-500">Roles Configured</p>
                    <p class="mt-2 text-2xl font-bold text-slate-900"><?php echo $statValue($stats['roles']); ?></p>
                </div>
                <span class="<?php echo $ui['badge_warning']; ?>">Review</span>
            </div>
            <p class="mt-4 text-xs text-slate-400">Ensure access aligns with policy.</p>
        </div>
        <div class="<?php echo $ui['card']; ?>">
            <div class="<?php echo $ui['card_header']; ?>">
                <div>
                    <p class="text-sm text-slate-500">Categories</p>
                    <p class="mt-2 text-2xl font-bold text-slate-900"><?php echo $statValue($stats['categories']); ?></p>
                </div>
                <span class="<?php echo $ui['badge_info']; ?>">Organized</span>
            </div>
            <p class="mt-4 text-xs text-slate-400">Content categories ready.</p>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
            <div class="<?php echo $ui['card']; ?>">
                <div class="<?php echo $ui['card_header']; ?>">
                    <div>
                        <h2 class="<?php echo $ui['card_title']; ?>">Recent Users</h2>
                        <p class="text-sm text-slate-500">Newest registrations in the system.</p>
                    </div>
                    <a href="?action=users" class="<?php echo $ui['btn_secondary']; ?>">View all</a>
                </div>
                <div class="mt-4">
                    <label class="sr-only" for="user-search">Search users</label>
                    <input id="user-search" type="search" placeholder="Search users" class="<?php echo $ui['input']; ?>" onkeyup="filterAdminTable('user-search','user-table')">
                </div>
                <div class="mt-4 overflow-x-auto">
                    <table id="user-table" class="<?php echo $ui['table']; ?>">
                        <thead class="<?php echo $ui['table_head']; ?>">
                            <tr>
                                <th class="<?php echo $ui['table_cell']; ?>">Name</th>
                                <th class="<?php echo $ui['table_cell']; ?>">Username</th>
                                <th class="<?php echo $ui['table_cell']; ?>">Role</th>
                                <th class="<?php echo $ui['table_cell']; ?>">Registered</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <?php if (!empty($recentUsers)) : ?>
                                <?php foreach ($recentUsers as $user) : ?>
                                    <tr>
                                        <td class="<?php echo $ui['table_cell']; ?> font-medium text-slate-900"><?php echo $user['name'] ?? '—'; ?></td>
                                        <td class="<?php echo $ui['table_cell']; ?>"><?php echo $user['username'] ?? '—'; ?></td>
                                        <td class="<?php echo $ui['table_cell']; ?>">
                                            <span class="<?php echo $ui['badge_info']; ?>"><?php echo $user['role'] ?? 'User'; ?></span>
                                        </td>
                                        <td class="<?php echo $ui['table_cell']; ?> text-slate-500">
                                            <?php echo isset($user['date_reg']) ? date('M d, Y', strtotime($user['date_reg'])) : '—'; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td class="<?php echo $ui['table_cell']; ?> text-slate-500" colspan="4">No recent user data found. <span class="text-xs text-slate-400">TODO: connect user table data.</span></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="<?php echo $ui['card']; ?>">
                <div class="<?php echo $ui['card_header']; ?>">
                    <div>
                        <h2 class="<?php echo $ui['card_title']; ?>">Quick Actions</h2>
                        <p class="text-sm text-slate-500">Jump into frequent admin tasks.</p>
                    </div>
                </div>
                <div class="mt-4 grid gap-4 sm:grid-cols-2">
                    <a href="?action=createuser" class="rounded-xl border border-slate-200 p-4 transition hover:border-blue-200 hover:bg-blue-50">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 text-blue-600">
                                <i class="fa fa-user-plus"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-900">Create user</p>
                                <p class="text-xs text-slate-500">Invite new team members.</p>
                            </div>
                        </div>
                    </a>
                    <a href="?action=cats" class="rounded-xl border border-slate-200 p-4 transition hover:border-blue-200 hover:bg-blue-50">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 text-blue-600">
                                <i class="fa fa-code-branch"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-900">Manage categories</p>
                                <p class="text-xs text-slate-500">Organize app content.</p>
                            </div>
                        </div>
                    </a>
                    <a href="?action=applist" class="rounded-xl border border-slate-200 p-4 transition hover:border-blue-200 hover:bg-blue-50">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 text-blue-600">
                                <i class="fa fa-th"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-900">Apps marketplace</p>
                                <p class="text-xs text-slate-500">Install or remove apps.</p>
                            </div>
                        </div>
                    </a>
                    <a href="?action=updatecomp" class="rounded-xl border border-slate-200 p-4 transition hover:border-blue-200 hover:bg-blue-50">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100 text-blue-600">
                                <i class="fa fa-cog"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-900">Company settings</p>
                                <p class="text-xs text-slate-500">Update business profile.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="<?php echo $ui['card']; ?>">
                <div class="<?php echo $ui['card_header']; ?>">
                    <h2 class="<?php echo $ui['card_title']; ?>">System Status</h2>
                    <span class="<?php echo $ui['badge_success']; ?>">All systems normal</span>
                </div>
                <ul class="mt-4 space-y-3 text-sm text-slate-600">
                    <li class="flex items-center justify-between">
                        <span>PHP Version</span>
                        <span class="font-semibold text-slate-900"><?php echo phpversion(); ?></span>
                    </li>
                    <li class="flex items-center justify-between">
                        <span>Server Time</span>
                        <span class="font-semibold text-slate-900"><?php echo date('M d, Y g:i A'); ?></span>
                    </li>
                    <li class="flex items-center justify-between">
                        <span>Security</span>
                        <span class="<?php echo $ui['badge_info']; ?>">Review ACLs weekly</span>
                    </li>
                </ul>
            </div>

            <div class="<?php echo $ui['card']; ?>">
                <div class="<?php echo $ui['card_header']; ?>">
                    <h2 class="<?php echo $ui['card_title']; ?>">Recent Activity</h2>
                    <a href="?action=users" class="text-sm font-semibold text-blue-600 hover:text-blue-700">View</a>
                </div>
                <div class="mt-4 space-y-4 text-sm text-slate-600">
                    <div class="flex items-start gap-3">
                        <div class="mt-1 h-2 w-2 rounded-full bg-blue-500"></div>
                        <div>
                            <p class="font-medium text-slate-900">New user registrations</p>
                            <p class="text-xs text-slate-500">Track signups and invite new admins. <span class="text-xs text-slate-400">TODO: connect activity logs.</span></p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="mt-1 h-2 w-2 rounded-full bg-emerald-500"></div>
                        <div>
                            <p class="font-medium text-slate-900">Apps updates ready</p>
                            <p class="text-xs text-slate-500">Review updates in the app list before deploying.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="mt-1 h-2 w-2 rounded-full bg-amber-500"></div>
                        <div>
                            <p class="font-medium text-slate-900">Role audits due</p>
                            <p class="text-xs text-slate-500">Revalidate admin access and permissions.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function filterAdminTable(inputId, tableId) {
        const input = document.getElementById(inputId);
        const filter = input.value.toLowerCase();
        const table = document.getElementById(tableId);
        if (!table) return;
        const rows = table.querySelectorAll('tbody tr');
        rows.forEach((row) => {
            const text = row.innerText.toLowerCase();
            row.style.display = text.indexOf(filter) > -1 ? '' : 'none';
        });
    }
</script>
