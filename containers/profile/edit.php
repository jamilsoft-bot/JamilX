<?php
$displayName = $user['name'] ?? '';
$username = $user['username'] ?? '';
$email = $user['email'] ?? '';
$phone = $user['phone'] ?? '';
$bio = $user['bio'] ?? '';
$address = $user['address'] ?? '';
$city = $user['city'] ?? '';
$state = $user['state'] ?? '';
$country = $user['country'] ?? '';
$dob = $user['dob'] ?? '';
$gender = $user['gender'] ?? '';
?>

<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-900">Edit Profile</h3>
            <p class="text-sm text-gray-500">Keep your personal details up to date.</p>
        </div>

        <?php if (!empty($message)) : ?>
            <div class="px-6 py-3 bg-blue-50 text-blue-700 text-sm">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form method="post" class="px-6 py-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <label class="block text-sm font-medium text-gray-700">Full Name
                    <input class="mt-2 w-full rounded-md border border-gray-200 px-3 py-2" name="name" value="<?php echo $displayName; ?>">
                </label>
                <label class="block text-sm font-medium text-gray-700">Username
                    <input class="mt-2 w-full rounded-md border border-gray-200 px-3 py-2" name="username" value="<?php echo $username; ?>">
                </label>
                <label class="block text-sm font-medium text-gray-700">Email
                    <input type="email" class="mt-2 w-full rounded-md border border-gray-200 px-3 py-2" name="email" value="<?php echo $email; ?>">
                </label>
                <label class="block text-sm font-medium text-gray-700">Phone
                    <input class="mt-2 w-full rounded-md border border-gray-200 px-3 py-2" name="phone" value="<?php echo $phone; ?>">
                </label>
                <label class="block text-sm font-medium text-gray-700">City
                    <input class="mt-2 w-full rounded-md border border-gray-200 px-3 py-2" name="city" value="<?php echo $city; ?>">
                </label>
                <label class="block text-sm font-medium text-gray-700">State
                    <input class="mt-2 w-full rounded-md border border-gray-200 px-3 py-2" name="state" value="<?php echo $state; ?>">
                </label>
                <label class="block text-sm font-medium text-gray-700">Country
                    <input class="mt-2 w-full rounded-md border border-gray-200 px-3 py-2" name="country" value="<?php echo $country; ?>">
                </label>
                <label class="block text-sm font-medium text-gray-700">Date of Birth
                    <input type="date" class="mt-2 w-full rounded-md border border-gray-200 px-3 py-2" name="dob" value="<?php echo $dob; ?>">
                </label>
                <label class="block text-sm font-medium text-gray-700">Gender
                    <input class="mt-2 w-full rounded-md border border-gray-200 px-3 py-2" name="gender" value="<?php echo $gender; ?>">
                </label>
                <label class="block text-sm font-medium text-gray-700">Address
                    <input class="mt-2 w-full rounded-md border border-gray-200 px-3 py-2" name="address" value="<?php echo $address; ?>">
                </label>
            </div>

            <label class="block text-sm font-medium text-gray-700">Bio
                <textarea class="mt-2 w-full rounded-md border border-gray-200 px-3 py-2" name="bio" rows="4"><?php echo $bio; ?></textarea>
            </label>

            <label class="block text-sm font-medium text-gray-700">New Password
                <input type="password" class="mt-2 w-full rounded-md border border-gray-200 px-3 py-2" name="password" placeholder="Leave blank to keep current password">
            </label>

            <div class="flex items-center justify-between">
                <a class="text-sm font-semibold text-gray-600 hover:text-gray-800" href="?action=overview">Back to overview</a>
                <button class="px-6 py-2 rounded-md bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700" type="submit">Save changes</button>
            </div>
        </form>
    </div>
</div>
