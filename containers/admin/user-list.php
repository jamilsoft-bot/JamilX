<?php global $JX_db; ?>
<!-- Ensure Tailwind is loaded if not already -->
<script src="https://cdn.tailwindcss.com"></script>

<div class="bg-gray-50 min-h-screen p-6">
  <div class="max-w-7xl mx-auto">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
      <div>
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">User Management</h2>
        <p class="mt-1 text-sm text-gray-500">View and manage registered users.</p>
      </div>
      <div class="mt-4 md:mt-0">
        <a href="?serve=users&action=create" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-md">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
          </svg>
          Add User
        </a>
      </div>
    </div>

    <!-- User Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
      <?php
      $sql = "SELECT * FROM `users` ORDER BY id DESC";
      $result = $JX_db->query($sql);

      if ($result) {
        foreach ($result as $r) {
          $id = $r['id'];
          $name = $r['name'];
          $username = $r['username'];
          $type = $r['role']; // e.g., admin, user
          $des = $r['bio'];
          $city = $r['city'];
          $logo = $r['avatar'];
          $country = $r['country'];
          $date_d = new DateTime($r['date_reg']);
          $date = $date_d->format("M d, Y");

          include "user-card.php";
        }
      } else {
        echo "<div class='col-span-full text-center text-gray-500 py-10'>No users found.</div>";
      }
      ?>
    </div>
  </div>
</div>