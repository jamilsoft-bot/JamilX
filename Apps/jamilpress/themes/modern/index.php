<?php include "classes.php"?>
<?php include "functions.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $blog->getName();?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-900">
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
            <a href="" class="text-xl font-semibold text-slate-900">Jamilpress</a>
            <nav class="hidden items-center gap-6 text-sm font-medium text-slate-600 md:flex">
                <a href="" class="transition hover:text-slate-900">Home</a>
                <a href="" class="transition hover:text-slate-900">Posts</a>
                <a href="" class="transition hover:text-slate-900">About</a>
                <a href="" class="transition hover:text-slate-900">Contact</a>
            </nav>
            <div class="md:hidden text-sm text-slate-500">Menu</div>
        </div>
    </header>

    <section class="bg-white">
        <div class="mx-auto max-w-6xl px-6 py-10">
            <div class="flex flex-col gap-6 md:flex-row md:items-center">
                <a href="<?php global $BLOG_URL;echo $BLOG_URL;?>" class="inline-flex h-24 w-24 items-center justify-center rounded-2xl bg-slate-100">
                    <img class="h-20 w-20 rounded-xl object-cover" src="<?php
                        $logo = $blog->getImage();
                        if($logo == null){
                            echo "../Apps/jamilpress/assets/images/jslogobird.png";
                        }else{
                            echo "../data/$logo";
                        }
                        ?>" alt="<?php echo $blog->getName();?> logo">
                </a>
                <div class="space-y-3">
                    <p class="text-sm uppercase tracking-widest text-slate-400">Featured blog</p>
                    <h1 class="text-3xl font-semibold text-slate-900 md:text-4xl"><?php echo $blog->getName();?></h1>
                    <p class="max-w-2xl text-base text-slate-600 md:text-lg"><?php echo $blog->getSummary();?></p>
                    <p class="text-sm text-slate-500">Created by <span class="font-medium text-slate-700"><?php echo $blog->getAuthor();?></span></p>
                </div>
            </div>
        </div>
    </section>

    <main class="mx-auto max-w-6xl px-6 pb-16">
        <?php
        if(isset($_GET['view'])){
            include "view.php";
        }else{
            include "main.php";
        }
        ?>
    </main>

    <footer class="border-t border-slate-200 bg-white">
        <div class="mx-auto max-w-6xl px-6 py-6 text-center text-sm text-slate-500">
            &copy; JamilX 2021 - 2026
        </div>
    </footer>
</body>
</html>
