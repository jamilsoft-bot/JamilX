<?php
// $Formr = "";
$draft = "?serve=users&action=create";
?>

<form action="<?php echo $Formr; ?>" method="post" enctype="multipart/form-data" class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Profile Picture Column -->
        <div class="md:col-span-1">
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <?php $av = isset($users->avatar) ? "data/" . $users->avatar : 'assets/images/user.png'; ?>
                <div class="mb-4">
                    <img src="<?php echo $av; ?>" class="mx-auto h-40 w-40 rounded-full object-cover border-4 border-slate-100 shadow-sm" id="prid" alt="Profile Pic">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Profile Avatar</label>
                    <input type="file" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" name="avatar" id='avatar' required>
                </div>
            </div>
        </div>

        <!-- Registration Form Column -->
        <div class="md:col-span-2">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="bg-blue-600 px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-white">User Registration</h3>
                    <p class="mt-1 max-w-2xl text-sm text-blue-100">Create a new user profile.</p>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="col-span-1 md:col-span-2">
                            <input type="hidden" name="uid" value="<?php echo $id; ?>">
                            <label for="name" class="block text-sm font-medium text-slate-700">Full Name</label>
                            <input type="text" name="name" value="<?php echo $users->name; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" id="name" placeholder="Full Name" required>
                        </div>

                        <div>
                            <label for="username" class="block text-sm font-medium text-slate-700">Username</label>
                            <input type="text" name="username" value="<?php echo $users->username; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" id="username" placeholder="Username" required>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                            <input type="password" name="password" value="<?php echo $users->password; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" id="password" placeholder="Password" required>
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                            <input type="email" name="email" value="<?php echo $users->email; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" id="email" placeholder="Email Address" required>
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-slate-700">Phone Number</label>
                            <input type="text" name="phone" value="<?php echo $users->phone; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" id="phone" placeholder="Phone Number">
                        </div>

                        <div>
                            <label for="dob" class="block text-sm font-medium text-slate-700">Date of Birth</label>
                            <input type="date" name="dob" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" value="<?php echo $users->dob; ?>" id="dob">
                        </div>

                        <div>
                            <label for="gender" class="block text-sm font-medium text-slate-700">Gender</label>
                            <select name="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" id="gender">
                                <option value="Male" <?php echo ($users->gender == 'Male') ? 'selected' : ''; ?>>Male</option>
                                <option value="Female" <?php echo ($users->gender == 'Female') ? 'selected' : ''; ?>>Female</option>
                            </select>
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label for="address" class="block text-sm font-medium text-slate-700">Home Address</label>
                            <input type="text" name="address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" value="<?php echo $users->address; ?>" id="address" placeholder="Home Address">
                        </div>

                        <div>
                            <label for="state" class="block text-sm font-medium text-slate-700">State</label>
                            <input type="text" name="state" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" value="<?php echo $users->state; ?>" id="state" placeholder="State">
                        </div>

                        <div>
                            <label for="cn" class="block text-sm font-medium text-slate-700">Country</label>
                            <?php $selected_Country = $users->country; ?>
                            <select name="country" id="cn" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></select>
                        </div>

                        <div>
                            <label for="city" class="block text-sm font-medium text-slate-700">City/Hometown</label>
                            <input type="text" name="city" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" value="<?php echo $users->city; ?>" placeholder="City">
                        </div>

                        <div>
                            <label for="rl" class="block text-sm font-medium text-slate-700">User Role</label>
                            <?php $selected_role = $users->role; ?>
                            <?php
                            global $Me;
                            if ($Me->role() == "Admin") {
                                echo "<select name='role' id='rl' class='mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm'>";
                            } else {
                                echo "<select name='role' class='mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm'>";
                                echo "<option> User</option>";
                                echo "<option> Partner</option>";
                                echo "<option> Customer</option>";
                            }
                            echo "</select>";
                            ?>
                        </div>

                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 flex gap-4">
                        <input type="submit" name="submit" class="cursor-pointer inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" value="Submit">
                        <input type="reset" name="reset" class="cursor-pointer inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" value="Clear">
                        <input type="button" name="cancel" class="cursor-pointer inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" value="Cancel" onclick="history.back()">
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>

<script src="assets/js/countries.js"></script>
<script>
    loadCountries("cn", "<?php echo $selected_Country; ?>")
    loadRoles("rl", "<?php echo $selected_role; ?>")
</script>