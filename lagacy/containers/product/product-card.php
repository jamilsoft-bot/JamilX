<div class="group rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
    <div class="overflow-hidden rounded-t-3xl">
        <img src="data/<?php echo $image;?>" class="h-56 w-full object-cover transition duration-300 group-hover:scale-105" alt="<?php echo $name;?>">
    </div>
    <div class="space-y-3 p-6 text-center">
        <p class="text-lg font-semibold text-slate-900"><?php echo $name;?></p>
        <div class="flex justify-center gap-1 text-amber-400">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="far fa-star"></i>
            <i class="far fa-star"></i>
        </div>
        <h4 class="text-lg font-semibold text-slate-800">N<?php echo $sale;?> <span class="text-sm font-medium text-slate-400 line-through">N<?php echo $price;?></span></h4>
    </div>
    <footer class="px-6 pb-6">
        <a class="inline-flex w-full items-center justify-center rounded-2xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">Order now</a>
    </footer>
</div>
