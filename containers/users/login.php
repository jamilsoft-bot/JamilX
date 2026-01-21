<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JamilX Login Page</title>
    <link href='assets/style.css' rel='stylesheet'>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-slate-50 text-slate-900">
<?php

$resume = isset($_GET['resume']) ? $_GET['resume'] : 'saller';
$has_error = isset($_GET['msg']);
$error_message = $has_error ? 'Username and password do not match.' : '';

?>
<form action="passgate?action=login" method="post" enctype="multipart/form-data">
    <div class="min-h-screen flex items-center justify-center px-4 py-10">
        <div class="w-full max-w-md">
            <div class="flex flex-col items-center gap-4">
                <img src="assets/images/lg.png" class="h-16 w-auto" alt="JamilX" />
                <div class="w-full rounded-2xl bg-white shadow-xl border border-slate-200 p-8">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-2xl font-semibold text-slate-900">Welcome back</h3>
                            <p class="text-sm text-slate-500">Sign in to continue to JamilX.</p>
                        </div>
                        <span class="h-12 w-12 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center">
                            <i class="fa-solid fa-user"></i>
                        </span>
                    </div>

                    <?php if ($has_error) { ?>
                        <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700" role="alert">
                            <?php echo $error_message; ?>
                        </div>
                    <?php } ?>

                    <div class="space-y-4">
                        <div>
                            <label for="userid" class="block text-sm font-medium text-slate-700">Username</label>
                            <div class="relative mt-1">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                                    <i class="fa-solid fa-user"></i>
                                </span>
                                <input type="text" class="w-full rounded-lg border border-slate-300 bg-white px-10 py-2.5 text-sm text-slate-900 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200" name="username" id="userid" placeholder="Enter your username" required <?php echo $has_error ? 'aria-invalid="true"' : ''; ?>>
                            </div>
                        </div>
                        <input type="hidden" name="resume" value="<?php global $Url; echo $resume?>">
                        <div>
                            <label for="passwordid" class="block text-sm font-medium text-slate-700">Password</label>
                            <div class="relative mt-1">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                                    <i class="fa-solid fa-lock"></i>
                                </span>
                                <input type="password" class="w-full rounded-lg border border-slate-300 bg-white px-10 py-2.5 text-sm text-slate-900 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200" name="password" id="passwordid" placeholder="Enter your password" required <?php echo $has_error ? 'aria-invalid="true"' : ''; ?>>
                                <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-blue-600" data-toggle-password="passwordid" aria-label="Show password">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <label class="inline-flex items-center gap-2 text-slate-600">
                                <input type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                                Remember me
                            </label>
                            <a href="signup" class="text-blue-600 hover:text-blue-700 font-medium">New here? Create account</a>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center gap-3">
                        <button class="w-full rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" type="submit" name="submit" id="submitid">
                            Sign in
                        </button>
                    </div>

                    <p class="mt-6 text-center text-sm text-slate-500">
                        Need an account? <a href="signup" class="font-medium text-blue-600 hover:text-blue-700">Create one</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    document.querySelectorAll('[data-toggle-password]').forEach(function (button) {
        button.addEventListener('click', function () {
            var targetId = button.getAttribute('data-toggle-password');
            var input = document.getElementById(targetId);
            if (!input) {
                return;
            }
            var isPassword = input.getAttribute('type') === 'password';
            input.setAttribute('type', isPassword ? 'text' : 'password');
            var icon = button.querySelector('i');
            if (icon) {
                icon.classList.toggle('fa-eye', !isPassword);
                icon.classList.toggle('fa-eye-slash', isPassword);
            }
        });
    });
</script>
</body>
</html>
