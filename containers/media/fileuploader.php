<section class="bg-slate-50 py-10">
    <div class="mx-auto max-w-4xl px-6">
        <header class="rounded-3xl bg-gradient-to-r from-blue-600 via-sky-500 to-cyan-400 p-8 text-white shadow-lg">
            <h2 class="text-2xl font-semibold">Image Uploader</h2>
            <p class="mt-2 text-sm text-blue-100">Upload new media assets and keep details consistent.</p>
        </header>
        <div class="mt-8 rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
            <div class="space-y-5">
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Select image</label>
                    <input type="file" class="mt-2 w-full rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-500" name="nfile" required>
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Image Alt text</label>
                    <input type="text" class="mt-2 w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" name="text" required>
                </div>
                <div class="flex justify-end">
                    <input type="submit" name="upload" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700" value="Upload">
                </div>
            </div>
        </div>
    </div>
</section>
