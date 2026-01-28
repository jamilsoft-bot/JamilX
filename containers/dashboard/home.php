<?php
global $Me;
$fullname = $Me->Fullname() ?? 'User';
$role = $Me->role() ?? 'User';
$email = $Me->email() ?? '';
?>

<div class="grid grid-cols-1 gap-6 mb-6 lg:grid-cols-4">
    <!-- Welcome Card -->
    <div class="lg:col-span-4 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-700 p-8 shadow-lg text-white relative overflow-hidden">
        <div class="relative z-10">
            <h2 class="text-3xl font-bold mb-2">Welcome back, <?php echo htmlspecialchars($fullname); ?>!</h2>
            <p class="text-blue-100 max-w-2xl">Manage your content, campaigns, and business settings all from one place. You have <span class="font-semibold text-white">4 pending tasks</span> today.</p>
            <div class="mt-6 flex gap-3">
                <a href="?action=posts" class="bg-white text-blue-700 px-5 py-2.5 rounded-lg font-semibold hover:bg-blue-50 transition shadow-sm">Manage Posts</a>
                <a href="?action=emails" class="bg-blue-500 bg-opacity-30 text-white border border-white/20 px-5 py-2.5 rounded-lg font-semibold hover:bg-white/10 transition backdrop-blur-sm">View Campaigns</a>
            </div>
        </div>
        <!-- Decorative bg elements -->
        <div class="absolute right-0 top-0 h-64 w-64 bg-white opacity-5 rounded-full -mr-16 -mt-16 blur-2xl"></div>
        <div class="absolute right-20 bottom-0 h-40 w-40 bg-blue-400 opacity-10 rounded-full blur-xl"></div>
    </div>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
    <div class="bg-white overflow-hidden shadow rounded-xl border border-slate-100">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-blue-50 rounded-md p-3">
                    <i class="fas fa-users text-blue-600 text-xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-slate-500 truncate">Total Users</dt>
                        <dd class="flex items-baseline">
                            <div class="text-2xl font-semibold text-slate-900">12,345</div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-slate-50 px-5 py-3">
            <div class="text-sm">
                <a href="?action=users" class="font-medium text-blue-600 hover:text-blue-500">View all users</a>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-xl border border-slate-100">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-green-50 rounded-md p-3">
                    <i class="fas fa-file-alt text-green-600 text-xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-slate-500 truncate">Published Posts</dt>
                        <dd class="flex items-baseline">
                            <div class="text-2xl font-semibold text-slate-900">48</div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-slate-50 px-5 py-3">
            <div class="text-sm">
                <a href="?action=posts" class="font-medium text-blue-600 hover:text-blue-500">Manage content</a>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-xl border border-slate-100">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-purple-50 rounded-md p-3">
                    <i class="fas fa-envelope-open-text text-purple-600 text-xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-slate-500 truncate">Emails Sent</dt>
                        <dd class="flex items-baseline">
                            <div class="text-2xl font-semibold text-slate-900">85%</div>
                            <span class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                <i class="fas fa-arrow-up self-center flex-shrink-0 text-green-500" aria-hidden="true"></i>
                                <span class="sr-only">Increased by</span>
                                12%
                            </span>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-slate-50 px-5 py-3">
            <div class="text-sm">
                <a href="?action=emails" class="font-medium text-blue-600 hover:text-blue-500">View campaigns</a>
            </div>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-xl border border-slate-100">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-yellow-50 rounded-md p-3">
                    <i class="fas fa-shopping-cart text-yellow-600 text-xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-slate-500 truncate">Products</dt>
                        <dd class="flex items-baseline">
                            <div class="text-2xl font-semibold text-slate-900">24</div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-slate-50 px-5 py-3">
            <div class="text-sm">
                <a href="?action=products" class="font-medium text-blue-600 hover:text-blue-500">View inventory</a>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
    <!-- Quick Actions -->
    <div class="bg-white shadow rounded-lg p-6 border border-slate-200">
        <h3 class="text-lg font-medium leading-6 text-slate-900 mb-4">Quick Actions</h3>
        <div class="grid grid-cols-2 gap-4">
            <a href="?action=pages" class="flex items-center p-4 border border-slate-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition group">
                <div class="bg-blue-100 p-2 rounded-lg group-hover:bg-blue-200 text-blue-600 mr-3">
                    <i class="fas fa-plus"></i>
                </div>
                <span class="font-medium text-slate-700 group-hover:text-blue-700">Add New Page</span>
            </a>
            <a href="?action=postadd" class="flex items-center p-4 border border-slate-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition group">
                <div class="bg-green-100 p-2 rounded-lg group-hover:bg-green-200 text-green-600 mr-3">
                    <i class="fas fa-edit"></i>
                </div>
                <span class="font-medium text-slate-700 group-hover:text-green-700">Write Post</span>
            </a>
            <a href="?action=productadd" class="flex items-center p-4 border border-slate-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition group">
                <div class="bg-purple-100 p-2 rounded-lg group-hover:bg-purple-200 text-purple-600 mr-3">
                    <i class="fas fa-box-open"></i>
                </div>
                <span class="font-medium text-slate-700 group-hover:text-purple-700">Add Product</span>
            </a>
            <a href="?action=emailadd" class="flex items-center p-4 border border-slate-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition group">
                <div class="bg-red-100 p-2 rounded-lg group-hover:bg-red-200 text-red-600 mr-3">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <span class="font-medium text-slate-700 group-hover:text-red-700">Create Campaign</span>
            </a>
        </div>
    </div>

    <!-- Recent Activity / Info -->
    <div class="bg-white shadow rounded-lg p-6 border border-slate-200">
        <h3 class="text-lg font-medium leading-6 text-slate-900 mb-4">System Status</h3>
        <div class="space-y-4">
            <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg">
                <div class="flex items-center">
                    <span class="h-2.5 w-2.5 rounded-full bg-green-500 mr-3"></span>
                    <span class="text-sm font-medium text-slate-700">Database Connection</span>
                </div>
                <span class="text-xs text-slate-500">Stable</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg">
                <div class="flex items-center">
                    <span class="h-2.5 w-2.5 rounded-full bg-green-500 mr-3"></span>
                    <span class="text-sm font-medium text-slate-700">Email Service</span>
                </div>
                <span class="text-xs text-slate-500">Operational</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg">
                <div class="flex items-center">
                    <span class="h-2.5 w-2.5 rounded-full bg-yellow-500 mr-3"></span>
                    <span class="text-sm font-medium text-slate-700">Disk Usage</span>
                </div>
                <span class="text-xs text-slate-500">45% used</span>
            </div>
            <div class="mt-4 pt-4 border-t border-slate-100">
                <p class="text-xs text-slate-400 text-center">Last system check: <?php echo date("Y-m-d H:i:s"); ?></p>
            </div>
        </div>
    </div>
</div>