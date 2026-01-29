<?php
$actions = isset($_GET['action']) ? $_GET['action'] : "dashboardmain";
// Ensure the class exists before instantiating to prevent fatal errors
if (class_exists($actions)) {
    $getAction = new $actions();
} else {
    // Fallback or error handling if needed, though for now we assume the Controller handles routing
    // You might want to default to 'Dashboard' if class not found, but it depends on the framework
}
// UI Kit might be used, keeping it
include __DIR__ . '/../partials/ui-kit.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($getAction) ? $getAction->getTitle() : 'JamilX Dashboard'; ?></title>
    <link rel="shortcut icon" href="assets/images/jslogobird.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/lib/font/css/all.min.css" />
    <script src="assets/tailwindcss.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900">