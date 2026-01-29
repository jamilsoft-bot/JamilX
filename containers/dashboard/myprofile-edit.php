<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
    <header class="border-b border-slate-100 pb-4">
        <h3 class="text-lg font-semibold text-slate-900">Updating my Information</h3>
        <p class="text-sm text-slate-500">Keep your profile details up to date.</p>
    </header>
    <div class="mt-6 grid gap-6 md:grid-cols-2">
        <div class="md:col-span-2">
            <label class="text-sm font-semibold text-slate-700">Bio</label>
            <textarea cols="5" rows="5" name="mybio" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"><?php echo  $Me->bio(); ?></textarea>
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-700">User Name</label>
            <input type="text" name="username" value="<?php echo $username;?>" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="Username">
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-700">Password</label>
            <input type="password" name="password" value="" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="Password">
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-700">Full Name</label>
            <input type="text" name="fullname" value="<?php echo $Me->fullname();?>" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="FullName">
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-700">Gender</label>
            <select name="gender" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                <option <?php if($Me->gender() == "Male"){echo "selected";} ?>>Male</option>
                <option <?php if($Me->gender() == "Female"){echo "selected";} ?>>Female</option>
            </select>
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-700">Date of Birth</label>
            <input type="date" name="dob" value="<?php echo $Me->dob();?>" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-700">Email Address</label>
            <input type="email" name="email" value="<?php echo $Me->email();?>" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="Email Address">
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-700">Phone Number</label>
            <input type="text" name="phone" value="<?php echo $Me->phone();?>" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="Phone Number">
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-700">Address</label>
            <input type="text" name="address" value="<?php echo $Me->address();?>" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="Address">
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-700">City</label>
            <input type="text" name="city" value="<?php echo $Me->city();?>" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="City or Hometown">
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-700">State</label>
            <input type="text" name="state" value="<?php echo $Me->state();?>" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="State">
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-700">Country</label>
            <input type="text" name="country" value="<?php echo $Me->country();?>" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" placeholder="Country" value="<?php ?>">
        </div>
    </div>
    <div class="mt-8 flex justify-end">
        <input type="submit" name="submit" class="inline-flex items-center rounded-xl bg-blue-600 px-6 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700" value="Submit">
    </div>
</div>
