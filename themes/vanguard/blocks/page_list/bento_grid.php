<?php defined('C5_EXECUTE') or die('Access Denied.'); ?>
<?php if (!empty($pages)): ?>
<div class="grid grid-cols-1 gap-6 md:grid-cols-4">
    <?php foreach ($pages as $index => $page):
        $pageTitle = $page->getCollectionName();
        $pageDesc = $page->getCollectionDescription();
        $extLink = (string) ($page->getCollectionPointerExternalLink() ?? '');
        if ($extLink !== '') {
            $pageLink = $extLink;
            $pageTarget = $page->openCollectionPointerExternalLinkInNewWindow() ? '_blank' : '_self';
        } else {
            $pageLink = $page->getCollectionLink();
            $pageTarget = $page->getAttribute('nav_target') ?: '_self';
        }
        $pageTargetAttr = ($pageTarget === '_blank') ? ' target="_blank" rel="noopener"' : '';
        $isWide = ($index === 0);
        $isAccent = ($index === 2);
    ?>

    <?php if ($isAccent): ?>
        <div class="vanguard-card--accent relative flex h-[320px] flex-col justify-end overflow-hidden p-8<?= $isWide ? ' md:col-span-2' : '' ?>">
            <div class="absolute right-0 top-0 p-4 opacity-20">
                <span class="material-symbols-outlined text-8xl" style="font-variation-settings:'FILL' 1">grid_view</span>
            </div>
            <h3 class="mb-2 font-headline text-xl font-black leading-none text-on-primary-container uppercase">
                <?= h($pageTitle) ?>
            </h3>
            <?php if ($pageDesc): ?>
            <p class="text-xs text-on-primary-container/80"><?= h($pageDesc) ?></p>
            <?php endif; ?>
            <a href="<?= h($pageLink) ?>"<?= $pageTargetAttr ?> class="vanguard-btn-ghost mt-4 self-start px-4 py-2 text-sm">VIEW</a>
        </div>

    <?php elseif ($isWide): ?>
        <div class="vanguard-card group flex h-[320px] flex-col justify-between p-8 md:col-span-2">
            <div>
                <div class="mb-6 flex items-start justify-between">
                    <span class="material-symbols-outlined text-4xl text-primary">precision_manufacturing</span>
                    <span class="font-label text-[10px] text-on-surface-variant/50">
                        REF_<?= str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) ?>
                    </span>
                </div>
                <h3 class="mb-2 font-headline text-2xl font-bold uppercase"><?= h($pageTitle) ?></h3>
                <?php if ($pageDesc): ?>
                <p class="max-w-sm text-sm leading-relaxed text-on-surface-variant"><?= h($pageDesc) ?></p>
                <?php endif; ?>
            </div>
            <a href="<?= h($pageLink) ?>"<?= $pageTargetAttr ?> class="vanguard-btn-primary self-start px-4 py-2 text-sm">VIEW_SPECS</a>
        </div>

    <?php else: ?>
        <div class="vanguard-card--high group flex h-[320px] flex-col justify-between p-8">
            <div>
                <span class="material-symbols-outlined mb-6 block text-4xl text-tertiary">android_fingerprint</span>
                <h3 class="mb-2 font-headline text-xl font-bold uppercase"><?= h($pageTitle) ?></h3>
                <?php if ($pageDesc): ?>
                <p class="text-xs leading-relaxed text-on-surface-variant"><?= h($pageDesc) ?></p>
                <?php endif; ?>
            </div>
            <a href="<?= h($pageLink) ?>"<?= $pageTargetAttr ?> class="vanguard-label transition-opacity hover:opacity-80">
                LEARN_MORE →
            </a>
        </div>
    <?php endif; ?>

    <?php endforeach; ?>
</div>
<?php endif; ?>
