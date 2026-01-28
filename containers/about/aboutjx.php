<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About JamilX - PHP Framework</title>
    <link rel="shortcut icon" href="assets/images/kamallogo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="assets/tailwindcss.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-600 to-indigo-700 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <h1 class="text-3xl font-bold text-white text-center">
                <i class="fas fa-code mr-2"></i>
                Thank You For Choosing JamilX
            </h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 flex items-center justify-center px-4 py-16">
        <div class="max-w-2xl mx-auto text-center">
            <!-- Logo -->
            <div class="mb-8 animate-bounce-slow">
                <img src="assets/images/jslogobird.png" alt="Jamilsoft Logo" class="h-40 w-40 mx-auto drop-shadow-2xl">
            </div>

            <!-- Company Info -->
            <div class="bg-white rounded-3xl shadow-2xl p-12 border border-slate-200">
                <h2 class="text-4xl font-black text-slate-900 mb-3">Jamilsoft</h2>
                <p class="text-xl text-slate-600 mb-8 font-medium">PHP Framework for Everyone</p>

                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-8 mb-8">
                    <p class="text-slate-700 leading-relaxed">
                        JamilX is a modern, lightweight PHP framework designed to make development simple,
                        fast, and enjoyable. Built with best practices and a focus on developer experience.
                    </p>
                </div>

                <!-- CTA Button -->
                <a href="https://paystack.com/pay/jamilsoft"
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold px-8 py-4 rounded-xl shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-300">
                    <i class="fas fa-heart"></i>
                    <span>Support Development</span>
                    <i class="fas fa-arrow-right"></i>
                </a>

                <!-- Quick Links -->
                <div class="mt-8 flex justify-center gap-4">
                    <a href="jxdoc" class="text-blue-600 hover:text-blue-700 font-semibold text-sm">
                        Documentation <i class="fas fa-external-link-alt text-xs"></i>
                    </a>
                    <span class="text-slate-300">|</span>
                    <a href="contactjx" class="text-blue-600 hover:text-blue-700 font-semibold text-sm">
                        Contact Us <i class="fas fa-envelope text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-blue-600 to-indigo-700 shadow-lg mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <p class="text-center text-white font-medium">
                &copy; <span id="copyr"></span> Jamilsoft. All Rights Reserved.
            </p>
        </div>
    </footer>

    <script>
        const copyrElement = document.getElementById("copyr");
        const currentYear = new Date().getFullYear();
        copyrElement.innerHTML = currentYear > 2021 ? `2021-${currentYear}` : "2021";
    </script>
</body>

</html>