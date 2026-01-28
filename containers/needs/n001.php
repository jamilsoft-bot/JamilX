<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuration Error</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 flex items-center justify-center min-h-screen p-6 font-sans text-gray-800">

    <div class="bg-white max-w-lg w-full rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <div class="p-8 text-center">
            <!-- Icon -->
            <div class="inline-flex items-center justify-center w-16 h-16 mb-6 rounded-full bg-red-50 text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                </svg>
            </div>

            <!-- Content -->
            <h1 class="text-2xl font-bold mb-2 text-gray-900">Configuration Missing</h1>
            <p class="text-gray-600 mb-6">
                The application could not find the <code class="bg-gray-100 px-1 py-0.5 rounded text-sm font-mono text-gray-800">.env</code> configuration file.
            </p>

            <div class="bg-blue-50 text-blue-800 text-sm p-4 rounded-lg text-left mb-6">
                <p class="font-semibold mb-1">To resolve this:</p>
                <ul class="list-disc list-inside space-y-1">
                    <li>Locate the <code class="font-mono text-xs">.env.example</code> file in your root directory.</li>
                    <li>Rename it to <code class="font-mono text-xs">.env</code>.</li>
                    <li>Update the settings inside to match your environment.</li>
                </ul>
            </div>

            <p class="text-xs text-gray-400">Error Code: N001</p>
        </div>
    </div>

</body>

</html>