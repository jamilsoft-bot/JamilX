<?php
$profileAction = $action ?? 'view';
include __DIR__ . '/header.php';

$navLink = function ($label, $value) use ($profileAction) {
    $isActive = $profileAction === $value;
    $base = 'inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-semibold transition';
    $active = 'bg-blue-600 text-white shadow-sm';
    $inactive = 'bg-white text-slate-600 hover:bg-slate-100';
    $class = $base . ' ' . ($isActive ? $active : $inactive);
    $href = "profile?action=$value";

    return "<a class=\"$class\" href=\"$href\">$label</a>";
};
?>
<div class="min-h-screen">
    <header class="border-b border-slate-200 bg-white shadow-sm">
        <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-4 px-6 py-5">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-blue-500">Profile Center</p>
                <h1 class="text-2xl font-semibold text-slate-900">
                    <?php echo isset($getAction) ? $getAction->getTitle() : 'Profile'; ?>
                </h1>
                <?php if (isset($getAction) && method_exists($getAction, 'getText') && $getAction->getText() !== '') : ?>
                    <p class="mt-2 text-sm text-slate-500"><?php echo $getAction->getText(); ?></p>
                <?php endif; ?>
            </div>
            <div class="flex flex-wrap gap-2">
                <?php echo $navLink('Overview', 'view'); ?>
                <?php echo $navLink('Edit Profile', 'edit'); ?>
                <?php echo $navLink('Settings', 'settings'); ?>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-6 py-10">
        <?php if (isset($getAction)) : ?>
            <?php $getAction->getAction(); ?>
        <?php endif; ?>
    </main>
</div>

<?php include __DIR__ . '/footer.php'; ?>
