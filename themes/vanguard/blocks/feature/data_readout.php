<?php defined('C5_EXECUTE') or die('Access Denied.');

$resolvedTitleFormat = (isset($titleFormat) && is_string($titleFormat) && preg_match('/^h[1-6]$/', $titleFormat))
    ? $titleFormat
    : 'h2';

$iconSrc = null;
if (!empty($fID)) {
    $f = \File::getByID($fID);
    if (is_object($f) && !$f->isError()) {
        $version = $f->getVersion();
        if (is_object($version)) {
            $iconSrc = $version->getURL();
        }
    }
}
?>
<div class="vanguard-card--glass p-6">

    <?php if (!empty($icon) || $iconSrc || !empty($title)): ?>
    <div class="mb-6 flex items-center gap-3">
        <?php if (!empty($icon)): ?>
        <span class="material-symbols-outlined text-primary"><?= h($icon) ?></span>
        <?php elseif ($iconSrc): ?>
        <img src="<?= h($iconSrc) ?>" alt="" aria-hidden="true" class="h-6 w-6 object-contain">
        <?php endif; ?>
        <?php if (!empty($title)): ?>
        <<?= $resolvedTitleFormat ?> class="font-headline text-lg font-bold tracking-tight text-on-surface uppercase">
            <?= h($title) ?>
        </<?= $resolvedTitleFormat ?>>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <?php if (!empty($paragraph)): ?>
    <div class="vanguard-stat__value mb-4">
        <?= $paragraph ?>
    </div>

    <?php
    preg_match('/(\d+(?:\.\d+)?)\s*%/', strip_tags($paragraph), $matches);
    $percent = isset($matches[1]) ? (float) $matches[1] : null;
    ?>
    <?php if ($percent !== null && $percent >= 0 && $percent <= 100): ?>
    <div class="mt-2">
        <div class="mb-2 flex justify-between">
            <span class="vanguard-stat__label">Level</span>
            <span class="font-headline text-sm font-bold text-primary"><?= rtrim(rtrim(number_format($percent, 2, '.', ''), '0'), '.') ?>%</span>
        </div>
        <div class="vanguard-progress">
            <div class="vanguard-progress__fill" style="width: <?= $percent ?>%"></div>
        </div>
    </div>
    <?php endif; ?>

    <?php endif; ?>

    <?php if (!empty($linkURL) && !empty($linkText)): ?>
    <a href="<?= h($linkURL) ?>" class="vanguard-label mt-6 inline-flex items-center gap-2 transition-opacity hover:opacity-80">
        <?= h($linkText) ?> <span aria-hidden="true">→</span>
    </a>
    <?php endif; ?>

</div>
