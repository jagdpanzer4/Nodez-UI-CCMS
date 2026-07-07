<?php defined('C5_EXECUTE') or die('Access Denied.'); ?>
<?php $site = \Concrete\Core\Support\Facade\Site::getSite(); ?>
<footer class="bg-surface w-full py-12 px-8 border-t border-outline-variant/20">
    <div class="grid grid-cols-2 md:grid-cols-4 w-full gap-8 max-w-7xl mx-auto">

        <!-- Col 1: Branding -->
        <div class="col-span-2 md:col-span-1 space-y-4">
            <div class="vanguard-nav__logo">
                <?= h($site->getSiteName()) ?>
            </div>
            <p class="font-body text-[10px] leading-tight uppercase tracking-normal text-outline">
                &copy;<?= date('Y') ?> <?= h($site->getSiteName()) ?> // ENCRYPTED_CONNECTION
            </p>
        </div>

        <!-- Col 2: Footer Nav Area 1 -->
        <div class="space-y-4">
            <div class="vanguard-label">Operation_Logs</div>
            <?php (new GlobalArea('Footer Nav 1'))->display(); ?>
        </div>

        <!-- Col 3: Footer Nav Area 2 -->
        <div class="space-y-4">
            <div class="vanguard-label">Digital_Terminal</div>
            <?php (new GlobalArea('Footer Nav 2'))->display(); ?>
        </div>

        <!-- Col 4: Security Badge -->
        <div class="flex items-end justify-end col-span-2 md:col-span-1">
            <div class="text-right">
                <div class="font-label text-[10px] text-primary/30 uppercase mb-2">Security_Protocol</div>
                <div class="bg-primary/10 border border-primary/20 p-2 font-headline text-[10px] text-primary rounded">
                    SECURE_KERNEL_LOCKED
                </div>
            </div>
        </div>

    </div>
</footer>
