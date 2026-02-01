<?php
global $Url;

// Handle form submission (processed in service)
if (isset($_POST['createBtn'])) {
    // Processing happens in appdev service
                $this->processAppCreation();

}
?>

<!-- Form Header -->
<div class="mb-8">
    <h2 class="text-2xl font-bold text-slate-900 mb-2">Create New Application</h2>
    <p class="text-slate-500">Fill in the details below to create your new JamilX application</p>
</div>

<form method="POST" action="" class="max-w-4xl">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">

        <!-- Basic Information Section -->
        <div class="p-6 border-b border-slate-200">
            <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                <span class="bg-blue-100 text-blue-600 w-8 h-8 rounded-lg flex items-center justify-center">
                    <i class="fas fa-info-circle"></i>
                </span>
                Basic Information
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="Nick" class="block text-sm font-semibold text-slate-700 mb-2">
                        App Nickname <span class="text-red-600">*</span>
                    </label>
                    <input type="text"
                        id="Nick"
                        name="Nick"
                        required
                        placeholder="e.g., myapp"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <p class="text-xs text-slate-500 mt-1">Unique identifier for your app (lowercase, no spaces)</p>
                </div>

                <div>
                    <label for="Name" class="block text-sm font-semibold text-slate-700 mb-2">
                        App Name <span class="text-red-600">*</span>
                    </label>
                    <input type="text"
                        id="Name"
                        name="Name"
                        required
                        placeholder="e.g., My Awesome App"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <p class="text-xs text-slate-500 mt-1">Display name for your application</p>
                </div>

                <div>
                    <label for="Version" class="block text-sm font-semibold text-slate-700 mb-2">
                        Version
                    </label>
                    <input type="text"
                        id="Version"
                        name="Version"
                        value="1.0.0"
                        placeholder="1.0.0"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    <p class="text-xs text-slate-500 mt-1">Semantic version number</p>
                </div>

                <div>
                    <label for="author" class="block text-sm font-semibold text-slate-700 mb-2">
                        Author
                    </label>
                    <input type="text"
                        id="author"
                        name="author"
                        placeholder="Your name"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>
            </div>
        </div>

        <!-- Contact Information Section -->
        <div class="p-6 border-b border-slate-200 bg-slate-50">
            <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                <span class="bg-green-100 text-green-600 w-8 h-8 rounded-lg flex items-center justify-center">
                    <i class="fas fa-envelope"></i>
                </span>
                Contact Information
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="Email" class="block text-sm font-semibold text-slate-700 mb-2">
                        Email
                    </label>
                    <input type="email"
                        id="Email"
                        name="Email"
                        placeholder="your@email.com"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>

                <div>
                    <label for="Website" class="block text-sm font-semibold text-slate-700 mb-2">
                        Website
                    </label>
                    <input type="url"
                        id="Website"
                        name="Website"
                        placeholder="https://yourwebsite.com"
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>
            </div>
        </div>

        <!-- Description Section -->
        <div class="p-6">
            <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                <span class="bg-purple-100 text-purple-600 w-8 h-8 rounded-lg flex items-center justify-center">
                    <i class="fas fa-file-alt"></i>
                </span>
                Description
            </h3>

            <div>
                <label for="Summary" class="block text-sm font-semibold text-slate-700 mb-2">
                    App Summary
                </label>
                <textarea id="Summary"
                    name="Summary"
                    rows="4"
                    placeholder="Describe what your application does..."
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition resize-none"></textarea>
                <p class="text-xs text-slate-500 mt-1">Brief description of your application's purpose and features</p>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="p-6 bg-slate-50 border-t border-slate-200 flex items-center justify-between gap-4">
            <a href="?serve=appdev&action=list"
                class="px-6 py-2.5 border-2 border-slate-300 text-slate-700 rounded-lg font-semibold hover:bg-slate-100 transition">
                <i class="fas fa-times mr-2"></i> Cancel
            </a>

            <button type="submit"
                name="createBtn"
                class="px-8 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg font-semibold hover:shadow-lg transition-all flex items-center gap-2">
                <i class="fas fa-rocket"></i>
                <span>Create Application</span>
            </button>
        </div>

    </div>
</form>

<!-- Help Section -->
<div class="mt-8 bg-blue-50 border border-blue-200 rounded-xl p-6">
    <h4 class="font-bold text-blue-900 mb-2 flex items-center gap-2">
        <i class="fas fa-lightbulb"></i> Quick Tips
    </h4>
    <ul class="space-y-2 text-sm text-blue-800">
        <li class="flex items-start gap-2">
            <i class="fas fa-check text-blue-600 mt-0.5"></i>
            <span>Use a unique, descriptive nickname that's easy to remember</span>
        </li>
        <li class="flex items-start gap-2">
            <i class="fas fa-check text-blue-600 mt-0.5"></i>
            <span>Follow semantic versioning (MAJOR.MINOR.PATCH) for version numbers</span>
        </li>
        <li class="flex items-start gap-2">
            <i class="fas fa-check text-blue-600 mt-0.5"></i>
            <span>Provide a clear summary to help users understand your app's purpose</span>
        </li>
    </ul>
</div>