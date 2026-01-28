<?php
global $JX_db, $Url;

$data = [];
$type = $Url->get('type');
$data_id = $Url->get('b');
$data = null;
$sql = "SELECT * FROM `business` WHERE `code` = '$data_id'";
$result = $JX_db->query($sql);

$data = $result->fetch_assoc();

$bus = json_decode($data['data']);
$logo = $data['logo'];

// Helper for labels
function fieldLabel($label)
{
    return '<dt class="text-sm font-medium text-gray-500">' . $label . '</dt>';
}

// Helper for values
function fieldValue($value)
{
    return '<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">' . ($value ?: '—') . '</dd>';
}

?>

<div class="bg-white shadow overflow-hidden sm:rounded-lg mb-8">
    <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
        <div>
            <h3 class="text-lg leading-6 font-medium text-gray-900">Business Profile</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Business details and contact information.</p>
        </div>
        <img src="<?php echo ($logo == null) ? 'assets/images/user.png' : "data/$logo"; ?>"
            alt="Business Logo"
            class="h-16 w-16 rounded-full object-cover border border-gray-200">
    </div>

    <div class="border-t border-gray-200">
        <dl>
            <!-- Personal Information Section -->
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <?php echo fieldLabel('Business Name'); ?>
                <?php echo fieldValue($bus->name); ?>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <?php echo fieldLabel('Summary'); ?>
                <?php echo fieldValue($bus->summary); ?>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <?php echo fieldLabel('Registration Code'); ?>
                <?php echo fieldValue($data['code']); ?>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <?php echo fieldLabel('Industry'); ?>
                <?php echo fieldValue($bus->industry); ?>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <?php echo fieldLabel('Owner'); ?>
                <?php echo fieldValue($data['owner']); ?>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <?php echo fieldLabel('Website'); ?>
                <dd class="mt-1 text-sm text-blue-600 hover:text-blue-500 sm:col-span-2 sm:mt-0">
                    <a href="<?php echo $bus->website; ?>" target="_blank"><?php echo $bus->website; ?></a>
                </dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <?php echo fieldLabel('RC Number'); ?>
                <?php echo fieldValue($bus->rc); ?>
            </div>

            <!-- Contact Information Section -->
            <div class="px-4 py-5 sm:px-6 border-t border-gray-200 bg-gray-100">
                <h4 class="text-md font-bold text-gray-700">Contact Information</h4>
            </div>

            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <?php echo fieldLabel('Address'); ?>
                <?php echo fieldValue($bus->street . ', ' . $bus->city . ', ' . $bus->country); ?>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <?php echo fieldLabel('Email'); ?>
                <?php echo fieldValue($bus->email); ?>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <?php echo fieldLabel('Phone'); ?>
                <?php echo fieldValue($bus->phone); ?>
            </div>

            <!-- Social Media Section -->
            <div class="px-4 py-5 sm:px-6 border-t border-gray-200 bg-gray-100">
                <h4 class="text-md font-bold text-gray-700">Social Media</h4>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Channels</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0 flex space-x-4">
                    <?php if ($bus->facebook): ?>
                        <a href="<?php echo $bus->facebook; ?>" class="text-blue-600 hover:text-blue-800"><i class="fab fa-facebook fa-lg"></i></a>
                    <?php endif; ?>
                    <?php if ($bus->twitter): ?>
                        <a href="<?php echo $bus->twitter; ?>" class="text-blue-400 hover:text-blue-600"><i class="fab fa-twitter fa-lg"></i></a>
                    <?php endif; ?>
                    <?php if ($bus->youtube): ?>
                        <a href="<?php echo $bus->youtube; ?>" class="text-red-600 hover:text-red-800"><i class="fab fa-youtube fa-lg"></i></a>
                    <?php endif; ?>
                    <?php if ($bus->instagram): ?>
                        <a href="<?php echo $bus->instagram; ?>" class="text-pink-600 hover:text-pink-800"><i class="fab fa-instagram fa-lg"></i></a>
                    <?php endif; ?>
                </dd>
            </div>

        </dl>
    </div>

    <div class="bg-gray-50 px-4 py-4 sm:px-6 flex justify-end space-x-3">
        <button onclick="document.getElementById('editMetadataModal').classList.remove('hidden')" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Edit Profile
        </button>
        <button class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
            Delete Profile
        </button>
        <button class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            Share Profile
        </button>
    </div>
</div>

<!-- Edit Modal (Tailwind) -->
<div id="editMetadataModal" class="hidden fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="document.getElementById('editMetadataModal').classList.add('hidden')"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Edit Business Profile
                        </h3>
                        <div class="mt-4">
                            <form action="" enctype="multipart/form-data" method="post" class="space-y-4">
                                <?php include "containers/dashboard/update-bus.php"; ?>
                                <!-- Ensure update-bus.php doesn't contain legacy buttons or layout that breaks this -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="document.getElementById('editMetadataModal').classList.add('hidden')">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>