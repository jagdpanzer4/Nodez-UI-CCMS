<?php defined('C5_EXECUTE') or die('Access Denied.'); ?>
<?php
$imgUrl = null;
$imgAlt = '';

if (!isset($f) && !empty($fID)) {
    $f = \File::getByID($fID);
}

if (isset($f) && is_object($f) && (!method_exists($f, 'isError') || !$f->isError())) {
    if (method_exists($f, 'getVersion')) {
        $img = $f->getVersion();
        if (is_object($img) && method_exists($img, 'getURL')) {
            $imgUrl = $img->getURL();
        }
    }
    if (!$imgUrl && method_exists($f, 'getURL')) {
        $imgUrl = $f->getURL();
    }
    $imgAlt = $alt ?? ($altText ?? '');
    if ($imgAlt === '' && method_exists($f, 'getTitle')) {
        $imgAlt = $f->getTitle() ?? '';
    }
}

$linkAttrs = !empty($openLinkInNewWindow) ? ' target="_blank" rel="noopener noreferrer"' : '';
?>
<?php if ($imgUrl): ?>
<figure class="relative rounded-xl overflow-hidden group">
    <?php if (!empty($linkURL)): ?>
    <a href="<?= h($linkURL) ?>"<?= $linkAttrs ?>>
    <?php endif; ?>
    <img src="<?= h($imgUrl) ?>"
         alt="<?= h($imgAlt) ?>"
         class="w-full h-auto object-cover transition-transform duration-150
                group-hover:scale-[1.02]
                drop-shadow-[0_0_30px_rgba(182,208,136,0.15)]">
    <?php if (!empty($linkURL)): ?>
    </a>
    <?php endif; ?>

    <?php if (!empty($title)): ?>
    <figcaption class="absolute bottom-0 left-0 right-0 p-4 glass-panel border-t border-white/10">
        <span class="vanguard-label"><?= h($title) ?></span>
    </figcaption>
    <?php endif; ?>

    <div class="absolute inset-0 border-[16px] border-transparent pointer-events-none">
        <div class="w-full h-full border border-primary/10"></div>
    </div>
</figure>
<?php endif; ?>
