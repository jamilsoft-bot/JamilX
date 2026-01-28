<?php
// Function helpers for cleaner display
function displayField($label, $value)
{
    return '
    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 border-b border-gray-100 last:border-0 hover:bg-gray-100 transition duration-150">
        <dt class="text-sm font-medium text-gray-500">' . $label . '</dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">' . ($value ?: '—') . '</dd>
    </div>';
}
?>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- User Profile Card -->
    <div class="md:col-span-1">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <!-- Cover/Header color -->
            <div class="h-24 bg-blue-600"></div>

            <div class="flex justify-center -mt-12">
                <img src="data/<?php echo $users->avatar; ?>" alt="<?php echo $users->username; ?>" class="h-32 w-32 rounded-full border-4 border-white object-cover shadow-md bg-white">
            </div>

            <div class="text-center px-4 py-6">
                <h2 class="text-xl font-bold text-gray-900"><?php echo $users->name; ?></h2>
                <p class="text-sm text-gray-500">@<?php echo $users->username; ?></p>

                <div class="mt-4 flex justify-center space-x-3">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        <?php echo $users->role; ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- Quick Actions (Mobile/Sidebar) -->
        <div class="bg-white rounded-lg shadow mt-6 p-4">
            <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-4">Actions</h4>
            <div class="space-y-3">
                <a href="?action=update&id=<?php echo $users->id; // Assuming ID is available in $users obj or $row 
                                            ?>" class="flex items-center justify-center w-full px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 shadow-sm transition">
                    <i class="fas fa-edit mr-2"></i> Update Profile
                </a>
                <button onclick="alert('Coming soon!')" class="flex items-center justify-center w-full px-4 py-2 border border-transparent text-sm font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 transition">
                    <i class="fas fa-trash-alt mr-2"></i> Delete User
                </button>
                <a href="?action=users" class="flex items-center justify-center w-full px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition">
                    <i class="fas fa-arrow-left mr-2"></i> Back to List
                </a>
            </div>
        </div>
    </div>

    <!-- User Details Column -->
    <div class="md:col-span-2">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200 flex justify-between items-center bg-gray-50">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Profile Details</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Personal information and contact details.</p>
                </div>
            </div>
            <dl>
                <?php
                echo displayField('Full Name', $users->name);
                echo displayField('Username', $users->username);
                echo displayField('Email', $users->email);
                echo displayField('Phone', $users->phone);
                echo displayField('Date of Birth', $users->dob);
                echo displayField('Gender', $users->gender);
                echo displayField('Address', $users->address);
                echo displayField('State', $users->state);
                echo displayField('Country', $users->country);
                echo displayField('City', $users->city);
                echo displayField('Role', $users->role);
                echo displayField('Password', '********'); // Masked
                ?>
            </dl>
        </div>
    </div>
</div>