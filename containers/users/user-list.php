<div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center gap-4">
            <img src="data/images/<?php echo $row['avatar'];?>" class="h-20 w-20 rounded-full border border-slate-200 object-cover" alt="User">
            <div>
                <p class="text-lg font-semibold text-slate-900">@<?php echo $row['username'];?></p>
                <p class="text-sm text-slate-500"><?php echo $row['name'];?></p>
                <span class="mt-2 inline-flex items-center rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-600"><?php echo $row['role'];?></span>
            </div>
        </div>
        <div class="flex items-center gap-2 text-sm">
            <a href="?serve=users&action=update&id=<?php echo $row['id'];?>" class="inline-flex items-center gap-2 rounded-lg border border-slate-200 px-3 py-2 text-slate-600 hover:border-blue-200 hover:text-blue-600"><i class="fa fa-edit"></i> Edit</a>
            <a href="?serve=users&action=read&id=<?php echo $row['id'];?>" class="inline-flex items-center gap-2 rounded-lg border border-slate-200 px-3 py-2 text-slate-600 hover:border-blue-200 hover:text-blue-600"><i class="fa fa-eye"></i> View</a>
            <a href="?serve=users&action=delete&id=<?php echo $row['id'];?>" class="inline-flex items-center gap-2 rounded-lg border border-rose-200 px-3 py-2 text-rose-600 hover:bg-rose-50"><i class="fa fa-archive"></i> Archive</a>
        </div>
    </div>
</div>
