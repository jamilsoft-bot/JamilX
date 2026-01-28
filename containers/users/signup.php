<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create your JamilX Account</title>
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
    <div class="flex h-full">
        <!-- Left Side: Signup Form (Scrollable) -->
        <div class="w-full lg:w-3/5 flex flex-col px-6 sm:px-12 lg:px-16 overflow-y-auto z-10 scrollbar-hide">
            <div class="pt-8 pb-8">
                <img src="assets/images/lg.png" class="h-10 w-auto mb-8" alt="JamilX" />

                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Create your account</h1>
                    <p class="mt-2 text-slate-500">Join the thousands of developers building with JamilX today.</p>
                </div>

                <form action="passgate?action=reg" method="post" enctype="multipart/form-data" class="space-y-6 max-w-2xl">
                    <!-- Personal Details -->
                    <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                        <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                            <i class="fa-regular fa-id-card text-blue-500"></i> Account Identity
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Full Name</label>
                                <input type="text" name="name" class="w-full rounded-xl border-slate-200 bg-white p-2.5 text-sm shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200" placeholder="John Doe" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Username</label>
                                <input type="text" name="username" class="w-full rounded-xl border-slate-200 bg-white p-2.5 text-sm shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200" placeholder="johndoe" required>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-slate-700 mb-1">Email Address</label>
                                <input type="email" name="email" class="w-full rounded-xl border-slate-200 bg-white p-2.5 text-sm shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200" placeholder="john@example.com" required>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                                <div class="relative">
                                    <input type="password" name="password" id="password" class="w-full rounded-xl border-slate-200 bg-white p-2.5 pr-10 text-sm shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200" placeholder="Create a strong password" required>
                                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-blue-600" data-toggle-password="password">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </div>
                                <p class="mt-1 text-xs text-slate-400">Must be at least 8 characters.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Contact & Location -->
                    <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                        <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-location-dot text-blue-500"></i> Location & Contact
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Phone</label>
                                <input type="text" name="phone" class="w-full rounded-xl border-slate-200 bg-white p-2.5 text-sm shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200" placeholder="+1 (555) 000-0000">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Date of Birth</label>
                                <input type="date" name="dob" class="w-full rounded-xl border-slate-200 bg-white p-2.5 text-sm shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Gender</label>
                                <select name="gender" class="w-full rounded-xl border-slate-200 bg-white p-2.5 text-sm shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">User Type</label>
                                <select name="usertype" class="w-full rounded-xl border-slate-200 bg-white p-2.5 text-sm shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                    <option value="User">User</option>
                                    <option value="Customer" selected>Customer</option>
                                    <option value="Partner">Partner</option>
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-slate-700 mb-1">Address</label>
                                <input type="text" name="address" class="w-full rounded-xl border-slate-200 bg-white p-2.5 text-sm shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200" placeholder="Street Address">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">City</label>
                                <input type="text" name="city" class="w-full rounded-xl border-slate-200 bg-white p-2.5 text-sm shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200" placeholder="City">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">State</label>
                                <input type="text" name="state" class="w-full rounded-xl border-slate-200 bg-white p-2.5 text-sm shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200" placeholder="State/Province">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-slate-700 mb-1">Country</label>
                                <select name="country" class="w-full rounded-xl border-slate-200 bg-white p-2.5 text-sm shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                    <option value="Nigeria">Nigeria</option>
                                    <option value="United States">United States</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="Canada">Canada</option>
                                    <!-- Add more standard countries here or keep the massive list if critical -->
                                    <option value="Ghana">Ghana</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="Kenya">Kenya</option>
                                    <option value="India">India</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Bio -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Bio</label>
                        <textarea name="bio" rows="3" class="w-full rounded-xl border-slate-200 bg-white p-2.5 text-sm shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200" placeholder="Tell us a little about yourself..."></textarea>
                    </div>

                    <div class="flex items-center gap-4 pt-4">
                        <button type="submit" name="submit" class="flex-1 rounded-xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-transform transform hover:-translate-y-0.5">
                            Create Account
                        </button>
                    </div>
                </form>

                <p class="mt-8 mb-8 text-center text-sm text-slate-500">
                    Already have an account? <a href="login" class="font-semibold text-blue-600 hover:text-blue-500">Sign in</a>
                </p>
            </div>
        </div>

        <!-- Right Side: Image/Gradient -->
        <div class="hidden lg:block relative w-2/5 bg-slate-900">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-blue-900 to-blue-800 opacity-90"></div>
            <img class="absolute inset-0 h-full w-full object-cover mix-blend-overlay opacity-50" src="https://images.unsplash.com/photo-1497215728101-856f4ea42174?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Office">

            <div class="absolute inset-x-0 bottom-0 p-12 text-white z-20">
                <div class="mb-4">
                    <i class="fas fa-quote-left text-4xl text-blue-400 opacity-50"></i>
                </div>
                <h2 class="text-3xl font-bold leading-tight mb-4">"JamilX has completely transformed how we build and deploy applications. It's simply the best framework out there."</h2>
                <div class="flex items-center gap-4 mt-6">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Avatar" class="h-12 w-12 rounded-full border-2 border-blue-400">
                    <div>
                        <p class="font-semibold text-white">Alex Morgan</p>
                        <p class="text-blue-200 text-sm">Senior Developer at TechCrop</p>
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