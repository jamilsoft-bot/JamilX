<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to JamilX Framework</title>
    <link rel="shortcut icon" href="assets/images/kamallogo.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/lib/font/css/all.min.css" />
    <script src="assets/tailwindcss.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 min-h-screen flex items-center justify-center">
    <div class="relative max-w-4xl mx-auto px-6 py-12 text-center">
        <!-- Logo -->
        <div class="mb-8 animate-fade-in">
            <img src="assets/images/hanifa.png" alt="JamilX" class="mx-auto h-32 w-auto drop-shadow-2xl">
        </div>

        <!-- Main Heading -->
        <h1 class="text-5xl md:text-6xl font-black text-slate-900 mb-4 leading-tight">
            Welcome to
            <span class="bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                JamilX Framework
            </span>
        </h1>

        <p class="text-xl text-slate-600 mb-12 max-w-2xl mx-auto">
            A modern PHP framework built for everyone. Simple, powerful, and elegant.
        </p>

        <!-- Navigation Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-3xl mx-auto">
            <a href="aboutjx" class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 p-8 border-2 border-transparent hover:border-blue-500 hover:-translate-y-1">
                <div class="bg-blue-100 text-blue-600 w-16 h-16 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                    <i class="fas fa-info-circle text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">About Us</h3>
                <p class="text-sm text-slate-500">Learn more about the framework</p>
            </a>

            <a href="contactjx" class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 p-8 border-2 border-transparent hover:border-green-500 hover:-translate-y-1">
                <div class="bg-green-100 text-green-600 w-16 h-16 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:bg-green-600 group-hover:text-white transition-colors">
                    <i class="fas fa-envelope text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Contact Us</h3>
                <p class="text-sm text-slate-500">Get in touch with the team</p>
            </a>

            <a href="jxdoc" class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 p-8 border-2 border-transparent hover:border-purple-500 hover:-translate-y-1">
                <div class="bg-purple-100 text-purple-600 w-16 h-16 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                    <i class="fas fa-book text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Documentation</h3>
                <p class="text-sm text-slate-500">Read the complete guide</p>
            </a>
        </div>
    </div>
</body>

</html>