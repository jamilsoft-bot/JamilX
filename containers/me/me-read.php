
        <div class="mx-auto max-w-6xl px-6 py-10">
            <div class="grid gap-8 lg:grid-cols-[320px_1fr]">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <img src="../data/images/<?php echo $users->avatar;?>" class="h-64 w-full rounded-2xl object-cover" id="prid" alt="Profile avatar">
                    <div class="mt-6 text-center">
                        <p class="inline-flex items-center justify-center rounded-full bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700"><?php echo $users->username;?></p>
                    </div>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
                    <header class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 pb-6">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.3em] text-blue-600">Profile overview</p>
                            <h3 class="mt-2 text-2xl font-semibold text-slate-900">User Profile Page</h3>
                        </div>
                        <span class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-slate-50 px-4 py-2 text-xs font-semibold text-slate-500">
                            Account details
                        </span>
                    </header>
                    <div class="mt-6 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                        <div>
                            <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Full Name</label>
                            <p class="mt-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700"><?php echo $users->name;?></p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Username</label>
                            <p class="mt-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700"><?php echo $users->username;?></p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Password</label>
                            <p class="mt-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700">*****</p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Email</label>
                            <p class="mt-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700"><?php echo $users->email;?></p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Phone Number</label>
                            <p class="mt-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700"><?php echo $users->phone;?></p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Date of Birth</label>
                            <p class="mt-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700"><?php echo $users->dob;?></p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Gender</label>
                            <p class="mt-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700"><?php echo $users->gender;?></p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Home Address</label>
                            <p class="mt-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700"><?php echo $users->address;?></p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">State</label>
                            <p class="mt-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700"><?php echo $users->state;?></p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Country</label>
                            <p class="mt-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700"><?php echo $users->country;?></p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">City/Hometown</label>
                            <p class="mt-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700"><?php echo $users->city;?></p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">User Role</label>
                            <p class="mt-2 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-700"><?php echo $users->role;?></p>
                        </div>
                    </div>
                    <div class="mt-8 grid gap-3 sm:grid-cols-3">
                        <a class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">Update</a>
                        <a class="inline-flex items-center justify-center rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700 transition hover:bg-emerald-100">Done</a>
                        <a class="inline-flex items-center justify-center rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-700 transition hover:bg-rose-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        
        
          
