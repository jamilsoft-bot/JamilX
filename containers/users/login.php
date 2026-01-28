<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in to JamilX</title>
    <script src="assets/tailwindcss.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="h-screen bg-white overflow-hidden">
    <?php
    $resume = isset($_GET['resume']) ? $_GET['resume'] : 'saller';
    $has_error = isset($_GET['msg']);
    $error_message = $has_error ? 'Invalid credentials. Please try again.' : '';
    ?>
    <div class="flex h-full">
        <!-- Left Side: Login Form -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 sm:px-12 lg:px-20 xl:px-24 bg-white z-10 relative">
            <div class="absolute top-8 left-8">
                <img src="assets/images/lg.png" class="h-10 w-auto" alt="JamilX" />
            </div>

            <div class="mx-auto w-full max-w-sm">
                <div class="mb-10">
                    <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Welcome back</h1>
                    <p class="mt-2 text-slate-500">Please enter your details to sign in.</p>
                </div>

                <?php if ($has_error) { ?>
                    <div class="mb-6 rounded-lg bg-red-50 p-4 border-l-4 border-red-500">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-500"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700 font-medium"><?php echo $error_message; ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <form action="passgate?action=login" method="post" class="space-y-6">
                    <input type="hidden" name="resume" value="<?php global $Url;
                                                                echo $resume ?>">

                    <div>
                        <label for="userid" class="block text-sm font-medium text-slate-700 mb-1">Username or Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-regular fa-envelope"></i>
                            </div>
                            <input type="text" name="username" id="userid"
                                class="pl-10 block w-full rounded-xl border-slate-200 bg-slate-50 p-3 text-slate-900 shadow-sm focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 transition-all duration-200 sm:text-sm"
                                placeholder="Enter your username" required>
                        </div>
                    </div>

                    <div>
                        <label for="passwordid" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                            <input type="password" name="password" id="passwordid"
                                class="pl-10 pr-10 block w-full rounded-xl border-slate-200 bg-slate-50 p-3 text-slate-900 shadow-sm focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 transition-all duration-200 sm:text-sm"
                                placeholder="••••••••" required>
                            <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-blue-600 transition-colors" data-toggle-password="passwordid">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                            <label for="remember" class="ml-2 block text-sm text-slate-600">Remember for 30 days</label>
                        </div>
                        <div class="text-sm">
                            <a href="#" class="font-medium text-blue-600 hover:text-blue-500">Forgot password?</a>
                        </div>
                    </div>

                    <div>
                        <button type="submit" name="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-0.5">
                            Sign in
                        </button>
                    </div>

                    <!-- <div class="relative mt-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-slate-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-slate-500">Or continue with</span>
                        </div>
                    </div>
                    
                    <div class="mt-6 grid grid-cols-2 gap-3">
                         Dummy Social Buttons 
                         <button type="button" class="w-full inline-flex justify-center py-2.5 px-4 border border-slate-200 rounded-xl shadow-sm bg-white text-sm font-medium text-slate-500 hover:bg-slate-50 transition-colors">
                            <i class="fab fa-google text-red-500 text-lg"></i>
                        </button>
                         <button type="button" class="w-full inline-flex justify-center py-2.5 px-4 border border-slate-200 rounded-xl shadow-sm bg-white text-sm font-medium text-slate-500 hover:bg-slate-50 transition-colors">
                            <i class="fab fa-github text-slate-900 text-lg"></i>
                        </button>
                    </div> -->
                </form>

                <p class="mt-8 text-center text-sm text-slate-500">
                    Don't have an account? <a href="signup" class="font-semibold text-blue-600 hover:text-blue-500">Sign up for free</a>
                </p>
            </div>

            <div class="absolute bottom-6 left-0 right-0 text-center">
                <p class="text-xs text-slate-400">&copy; <?php echo date('Y'); ?> Jamilsoft. All rights reserved.</p>
            </div>
        </div>

        <!-- Right Side: Image/Gradient -->
        <div class="hidden lg:block relative w-1/2 bg-blue-600">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-indigo-900 opacity-90 mixing-blend-multiply"></div>
            <!-- Optional: Background Image -->
            <img class="absolute inset-0 h-full w-full object-cover mix-blend-overlay opacity-60" src="https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1567&q=80" alt="Background">

            <div class="absolute inset-0 flex flex-col justify-center items-center text-white px-12 text-center z-20">
                <div class="mb-6 bg-white/10 backdrop-blur-md rounded-2xl p-4 inline-block">
                    <i class="fas fa-layer-group text-4xl"></i>
                </div>
                <h2 class="text-4xl font-extrabold tracking-tight mb-4">Build faster with JamilX</h2>
                <p class="text-blue-100 text-lg max-w-lg leading-relaxed">The complete platform for building, deploying, and managing your modern web applications with ease and style.</p>

                <!-- Testimonial or feature pills -->
                <div class="mt-10 flex gap-4">
                    <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 border border-white/10">
                        <i class="fas fa-check-circle text-green-400"></i>
                        <span class="text-sm font-medium">Secure</span>
                    </div>
                    <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 border border-white/10">
                        <i class="fas fa-bolt text-yellow-400"></i>
                        <span class="text-sm font-medium">Fast</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('[data-toggle-password]').forEach(button => {
            button.addEventListener('click', () => {
                const targetId = button.getAttribute('data-toggle-password');
                const input = document.getElementById(targetId);
                if (input) {
                    const isPassword = input.type === 'password';
                    input.type = isPassword ? 'text' : 'password';
                    const icon = button.querySelector('i');
                    if (icon) {
                        icon.classList.toggle('fa-eye');
                        icon.classList.toggle('fa-eye-slash');
                    }
                }
            });
        });
    </script>
</body>

</html>