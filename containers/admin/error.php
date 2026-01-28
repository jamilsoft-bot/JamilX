<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resource Not Found</title>
  <script src="assets/tailwindcss.js"></script>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center font-sans text-gray-900">

  <div class="max-w-4xl w-full bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row transform transition-all hover:scale-[1.01] duration-300">
    <!-- Image Section -->
    <div class="md:w-1/2 bg-blue-50 flex items-center justify-center p-8">
      <img src="assets/images/js-offline.png" alt="Offline / Not Found" class="max-w-full h-auto object-contain">
    </div>

    <!-- Content Section -->
    <div class="md:w-1/2 p-10 flex flex-col justify-center items-start space-y-6">
      <div class="border-b-4 border-blue-500 pb-2 mb-2 w-full">
        <h1 class="text-4xl font-extrabold text-gray-800 tracking-tight">Resource Not Found</h1>
      </div>

      <p class="text-lg text-gray-600 leading-relaxed">
        The resource you are looking for was not found on this server. It might have been moved, deleted, or you may have typed the URL incorrectly.
      </p>

      <a href="dashboard" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 md:py-4 md:text-lg shadow-md hover:shadow-lg transition-all duration-200">
        Go to Dashboard
      </a>
    </div>
  </div>

  <footer class="mt-8 text-center text-gray-400 text-sm">
    &copy; <?php echo date('Y'); ?> Powered by Jamilsoft
  </footer>

  <?php
  if (function_exists('get_main_scripts')) {
    get_main_scripts();
  }
  ?>
</body>

</html>