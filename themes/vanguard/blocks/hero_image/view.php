<?php defined('C5_EXECUTE') or die('Access Denied.'); ?>
<?php
$imageUrl = null;
$fileObj  = null;
if (!empty($image) && is_object($image) && method_exists($image, 'getURL')) {
    $imageUrl = !$image->isError() ? $image->getURL() : null;
    $fileObj  = method_exists($image, 'getFile') ? $image->getFile() : $image;
} elseif (!empty($f) && is_object($f) && method_exists($f, 'getURL')) {
    $imageUrl = $f->getURL();
    $fileObj  = method_exists($f, 'getFile') ? $f->getFile() : $f;
} elseif (!empty($fileID)) {
    $fileObj = \Concrete\Core\File\File::getByID($fileID);
    if ($fileObj && $fileObj->getFileID()) {
        $imageUrl = $fileObj->getURL();
    }
}

// Pobierz tagi z File Details w CCMS
$imageTags = null;
if ($fileObj && is_object($fileObj) && !$fileObj->isError()) {
    $tagsRaw = $fileObj->getAttribute('tags');
    if (!empty($tagsRaw)) {
        $imageTags = trim((string) $tagsRaw);
        if ($imageTags === '') {
            $imageTags = null;
        }
    }
}

$buttonMarkup = null;
if (isset($button) && is_object($button)) {
    if (method_exists($button, 'addClass')) {
        $button->addClass('vanguard-btn-cta');
    }
    if (!empty($buttonIcon) && !empty($iconTag) && method_exists($button, 'getValue') && $button->getValue()) {
        $button->setValue('<span aria-hidden="true">' . $iconTag . '</span>' . $button->getValue());
    }
    $buttonHref = (string) ($button->getAttribute('href') ?? '');
    if ($buttonHref !== '' && $buttonHref !== '#') {
        $buttonMarkup = $button;
    }
} elseif (!empty($buttonText) && !empty($buttonURL)) {
    $buttonMarkup = '<a href="' . h($buttonURL) . '" class="vanguard-btn-cta">' . h($buttonText) . '</a>';
}

$hasRichBody = !empty($body) && strip_tags((string) $body) !== (string) $body;
?>
<div class="relative z-10 w-full max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-12 gap-12 items-center">
    <div class="md:col-span-6 space-y-8">
        <?php if ($imageTags !== null): ?>
        <div class="vanguard-hero__badge">
            <span class="w-2 h-2 bg-tertiary rounded-full animate-pulse"></span>
            <span class="font-label text-xs tracking-widest text-primary uppercase">
                <?= h($imageTags) ?>
            </span>
        </div>
        <?php endif; ?>

        <?php if (!empty($title)): ?>
        <h1 class="font-headline text-6xl md:text-8xl font-bold tracking-tighter leading-none text-on-surface">
            <?= nl2br(h($title)) ?>
        </h1>
        <?php endif; ?>

        <?php if (!empty($body)): ?>
            <?php if ($hasRichBody): ?>
        <div class="text-on-surface-variant max-w-md text-lg leading-relaxed">
            <?= $body ?>
        </div>
            <?php else: ?>
        <p class="text-on-surface-variant max-w-md text-lg leading-relaxed">
            <?= h($body) ?>
        </p>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ($buttonMarkup): ?>
        <div class="flex flex-wrap gap-4 pt-4">
            <?= $buttonMarkup ?>
        </div>
        <?php endif; ?>
    </div>

    <div class="md:col-span-6 relative h-[500px] md:h-[700px] flex items-center justify-center">
        <?php if ($imageUrl): ?>
        <img src="<?= h($imageUrl) ?>"
             alt="<?= h($title ?? '') ?>"
             class="relative z-10 object-contain w-full h-full drop-shadow-[0_0_50px_rgba(182,208,136,0.20)]">
        <?php else: ?>
        <div class="w-full h-full flex items-center justify-center vanguard-card--glass rounded-xl">
            <span class="material-symbols-outlined text-6xl text-primary/30">image</span>
        </div>
        <?php endif; ?>

        <div class="absolute top-10 right-0 vanguard-stat space-y-2 z-20 min-w-[140px]">
            <div class="vanguard-stat__label">Structural_Integrity</div>
            <div class="font-headline text-2xl font-bold text-primary">99.8%</div>
            <div class="vanguard-progress">
                <div class="vanguard-progress__fill" style="width: 99.8%"></div>
            </div>
        </div>
    </div>
</div>
