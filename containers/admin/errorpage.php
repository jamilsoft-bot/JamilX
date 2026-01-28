<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <script src="assets/tailwindcss.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>

<body class="bg-gray-50 h-screen flex flex-col justify-between">

    <main class="flex-grow flex items-center justify-center px-4">
        <div class="max-w-md w-full bg-white rounded-xl shadow-2xl overflow-hidden text-center transform transition-transform duration-500 hover:-translate-y-1">

            <div class="p-8 pb-0">
                <img src="assets/images/jslogobird.png" alt="Jamilsoft Logo" class="mx-auto h-24 w-24 object-contain animate-bounce">
                <h1 class="mt-4 text-3xl font-extrabold text-gray-900 tracking-tight">Jamilsoft</h1>
            </div>

            <div class="p-8">
                <div class="bg-blue-600 rounded-t-lg py-3 px-4 shadow-md">
                    <h2 class="text-xl font-bold text-white flex items-center justify-center gap-2">
                        <i class="fas fa-lock"></i> Incorrect Access
                    </h2>
                </div>

                <div class="border border-t-0 border-gray-200 rounded-b-lg p-6 bg-gray-50 text-gray-700">
                    <p class="text-lg leading-relaxed">
                        <?php echo isset($message) ? $message : "You do not have permission to access this resource."; ?>
                    </p>
                </div>

                <div class="mt-8">
                    <a id="btn" href="<?php echo isset($linkback) ? $linkback : 'javascript:history.back()'; ?>" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-full text-white bg-blue-600 hover:bg-blue-700 transition duration-150 ease-in-out shadow-lg hover:shadow-xl w-32">
                        Next <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>

        </div>
    </main>

    <footer class="py-6 text-center text-gray-400 text-sm">
        &copy; <?php echo date('Y'); ?> Jamilsoft. All Rights Reserved.
    </footer>

</body>

</html>