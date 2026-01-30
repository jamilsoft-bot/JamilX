<div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 py-12 px-4 sm:px-6 lg:px-8 flex items-center justify-center">
    <!-- Main Card -->
    <div class="max-w-4xl w-full bg-white rounded-2xl shadow-2xl overflow-hidden transform transition-all hover:shadow-3xl flex flex-col md:flex-row">

        <!-- Left Side: Visual/Context -->
        <div class="bg-gradient-to-br from-indigo-600 to-purple-700 w-full md:w-2/5 p-8 flex flex-col justify-between text-white relative overflow-hidden">
            <!-- Decorative Circles -->
            <div class="absolute top-0 left-0 w-64 h-64 bg-white opacity-5 rounded-full -translate-x-12 -translate-y-12"></div>
            <div class="absolute bottom-0 right-0 w-48 h-48 bg-white opacity-5 rounded-full translate-x-12 translate-y-12"></div>

            <div>
                <h2 class="text-3xl font-extrabold tracking-tight mb-2">Create New App</h2>
                <p class="text-indigo-100 opacity-90">Bring your next great idea to life. Fill in the details to bootstrap your JamilX application container.</p>
            </div>

            <div class="mt-8 space-y-4">
                <div class="flex items-center space-x-3 text-indigo-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Automatic directory structure</span>
                </div>
                <div class="flex items-center space-x-3 text-indigo-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Config file generation</span>
                </div>
                <div class="flex items-center space-x-3 text-indigo-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Ready for development</span>
                </div>
            </div>

            <div class="mt-8 text-xs text-indigo-200 opacity-75">
                Powered by JamilX Framework
            </div>
        </div>

        <!-- Right Side: Form -->
        <div class="w-full md:w-3/5 p-8 md:p-12">
            <form action="" method="POST" class="space-y-6">
                <!-- Header for Mobile -->
                <div class="md:hidden mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">New Application</h2>
                </div>

                <!-- Nickname & Version -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label for="Nick" class="text-sm font-semibold text-gray-600 tracking-wide">App Nickname</label>
                        <input type="text" name="Nick" id="Nick" placeholder="e.g. blog" required
                            class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 transition-all duration-200 outline-none text-gray-700 placeholder-gray-400">
                        <p class="text-xs text-gray-400">Short, unique identifier (no spaces).</p>
                    </div>

                    <div class="space-y-1">
                        <label for="Version" class="text-sm font-semibold text-gray-600 tracking-wide">Version</label>
                        <input type="text" name="Version" id="Version" placeholder="1.0.0" value="1.0.0" required
                            class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 transition-all duration-200 outline-none text-gray-700">
                    </div>
                </div>

                <!-- Full Name -->
                <div class="space-y-1">
                    <label for="Name" class="text-sm font-semibold text-gray-600 tracking-wide">Full Name</label>
                    <input type="text" name="Name" id="Name" placeholder="e.g. My Awesome Blog" required
                        class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 transition-all duration-200 outline-none text-gray-700">
                </div>

                <!-- Summary -->
                <div class="space-y-1">
                    <label for="Summary" class="text-sm font-semibold text-gray-600 tracking-wide">Summary</label>
                    <textarea name="Summary" id="Summary" rows="3" placeholder="Brief description of your app..."
                        class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 transition-all duration-200 outline-none text-gray-700 resize-none"></textarea>
                </div>

                <!-- Author & Email -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label for="author" class="text-sm font-semibold text-gray-600 tracking-wide">Author</label>
                        <input type="text" name="author" id="author" placeholder="Your Name"
                            class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 transition-all duration-200 outline-none text-gray-700">
                    </div>

                    <div class="space-y-1">
                        <label for="Email" class="text-sm font-semibold text-gray-600 tracking-wide">Email</label>
                        <input type="email" name="Email" id="Email" placeholder="you@example.com"
                            class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 transition-all duration-200 outline-none text-gray-700">
                    </div>
                </div>

                <!-- Website -->
                <div class="space-y-1">
                    <label for="Website" class="text-sm font-semibold text-gray-600 tracking-wide">Website</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3.5 text-gray-400 text-sm">https://</span>
                        <input type="text" name="Website" id="Website" placeholder="example.com"
                            class="w-full pl-16 pr-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 transition-all duration-200 outline-none text-gray-700">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" name="createBtn" value="1"
                        class="w-full flex items-center justify-center px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span>Create Application</span>
                        <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>