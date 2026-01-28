<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Configuration Error</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 flex items-center justify-center min-h-screen p-6 font-sans text-gray-800">

    <div class="bg-white max-w-lg w-full rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <div class="p-8 text-center">
            <!-- Icon -->
            <div class="inline-flex items-center justify-center w-16 h-16 mb-6 rounded-full bg-amber-50 text-amber-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.002z" />
                </svg>
            </div>

            <!-- Content -->
            <h1 class="text-2xl font-bold mb-2 text-gray-900">Session Config Missing</h1>
            <p class="text-gray-600 mb-6">
                The application could not find the <code class="bg-gray-100 px-1 py-0.5 rounded text-sm font-mono text-gray-800">session.php</code> file.
            </p>

            <div class="bg-gray-50 text-gray-600 text-sm p-4 rounded-lg text-left mb-6">
                This file is typically generated during the installation process. If you have not installed the application yet, please run the installer.
            </div>

            <p class="text-xs text-gray-400">Error Code: N002</p>
        </div>
    </div>

</body>

</html>