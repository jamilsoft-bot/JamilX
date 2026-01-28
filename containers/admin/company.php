<?php
// Assuming $info is available as in the original file
?>
<div class="bg-gray-50 min-h-screen py-8">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-lg shadow overflow-hidden">
      <div class="bg-blue-600 px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-white">Company Information</h3>
        <p class="mt-1 max-w-2xl text-sm text-blue-100">Update your organization's public profile and contact details.</p>
      </div>

      <form action="" method="post" class="space-y-6">
        <div class="px-4 py-5 sm:p-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">

          <!-- Column 1 -->
          <div class="space-y-6">
            <div>
              <label for="name" class="block text-sm font-medium text-blue-700">Company Name</label>
              <div class="mt-1">
                <input type="text" name="name" id="name" value="<?php echo $info->name; ?>" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Company Name">
              </div>
            </div>

            <div>
              <label for="summary" class="block text-sm font-medium text-blue-700">Company Description</label>
              <div class="mt-1">
                <input type="text" name="summary" id="summary" value="<?php echo $info->summary; ?>" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Brief description of your company">
              </div>
            </div>

            <div>
              <label for="industry" class="block text-sm font-medium text-blue-700">Industry</label>
              <div class="mt-1">
                <input type="text" name="industry" id="industry" value="<?php echo $info->industry; ?>" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="E.g. ICT, Agriculture">
              </div>
            </div>

            <div>
              <label for="country" class="block text-sm font-medium text-blue-700">Country</label>
              <div class="mt-1">
                <input type="text" name="country" id="country" value="<?php echo $info->country; ?>" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Headquarters Country">
              </div>
            </div>

            <div>
              <label for="city" class="block text-sm font-medium text-blue-700">City/State</label>
              <div class="mt-1">
                <input type="text" name="city" id="city" value="<?php echo $info->city; ?>" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="City or State">
              </div>
            </div>
          </div>

          <!-- Column 2 -->
          <div class="space-y-6">
            <div>
              <label for="street" class="block text-sm font-medium text-blue-700">Street Address</label>
              <div class="mt-1">
                <input type="text" name="street" id="street" value="<?php echo $info->street; ?>" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="123 Example St">
              </div>
            </div>

            <div>
              <label for="website" class="block text-sm font-medium text-blue-700">Website</label>
              <div class="mt-1">
                <input type="text" name="website" id="website" value="<?php echo $info->website; ?>" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="www.example.com">
              </div>
            </div>

            <div>
              <label for="email" class="block text-sm font-medium text-blue-700">Email Address</label>
              <div class="mt-1">
                <input type="email" name="email" id="email" value="<?php echo $info->email; ?>" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="info@example.com">
              </div>
            </div>

            <div>
              <label for="phone" class="block text-sm font-medium text-blue-700">Phone</label>
              <div class="mt-1">
                <input type="text" name="phone" id="phone" value="<?php echo $info->phone; ?>" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="International Format">
              </div>
            </div>

            <div>
              <label for="rc" class="block text-sm font-medium text-blue-700">Registration Code (Optional)</label>
              <div class="mt-1">
                <input type="text" name="rc" id="rc" value="<?php echo $info->rc; ?>" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="RC, BN, etc.">
              </div>
            </div>
          </div>

        </div>

        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
          <button type="submit" name="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Complete Setup
          </button>
        </div>
      </form>
    </div>
  </div>
</div>