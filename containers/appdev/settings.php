<div class="max-w-2xl">
    <h2 class="text-2xl font-bold text-slate-900 mb-6">App Development Settings</h2>

    <div class="space-y-6">
        <!-- General Settings -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h3 class="text-lg font-bold text-slate-900 mb-4">General Settings</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <label class="font-semibold text-slate-900">Auto-install Dependencies</label>
                        <p class="text-sm text-slate-500">Automatically install required packages</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-slate-200 peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    <div>
                        <label class="font-semibold text-slate-900">Enable Debug Mode</label>
                        <p class="text-sm text-slate-500">Show detailed error messages</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                </div>
            </div>
        </div>

        <!-- Development Tools -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Development Tools</h3>
            <div class="space-y-3">
                <button class="w-full bg-blue-50 hover:bg-blue-100 text-blue-700 px-4 py-3 rounded-lg font-semibold transition text-left flex items-center justify-between">
                    <span><i class="fas fa-terminal mr-2"></i> Open CLI</span>
                    <i class="fas fa-chevron-right"></i>
                </button>
                <button class="w-full bg-green-50 hover:bg-green-100 text-green-700 px-4 py-3 rounded-lg font-semibold transition text-left flex items-center justify-between">
                    <span><i class="fas fa-database mr-2"></i> Database Manager</span>
                    <i class="fas fa-chevron-right"></i>
                </button>
                <button class="w-full bg-purple-50 hover:bg-purple-100 text-purple-700 px-4 py-3 rounded-lg font-semibold transition text-left flex items-center justify-between">
                    <span><i class="fas fa-file-code mr-2"></i> Code Generator</span>
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>

        <!-- Save Button -->
        <div class="flex justify-end">
            <button class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:shadow-lg transition-all">
                <i class="fas fa-save mr-2"></i> Save Settings
            </button>
        </div>
    </div>
</div>