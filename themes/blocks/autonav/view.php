<?php defined('C5_EXECUTE') or die('Access Denied.'); ?>
<?php
$items = $navItems ?? null;
if ((!is_array($items) || $items === []) && isset($controller) && is_object($controller) && method_exists($controller, 'getNavItems')) {
    $items = $controller->getNavItems();
}
$c = \Concrete\Core\Page\Page::getCurrentPage();
?>
<?php if (!empty($items)): ?>
<ul class="flex flex-col md:flex-row items-start md:items-center gap-2 md:gap-8 list-none m-0 p-0">
    <?php foreach ($items as $ni):
        $level = method_exists($ni, 'getLevel') ? (int) $ni->getLevel() : (int) ($ni->level ?? 0);
        if ($level > 1) {
            continue;
        }

        $url = method_exists($ni, 'getURL') ? $ni->getURL() : ($ni->url ?? '');
        $name = method_exists($ni, 'getName') ? $ni->getName() : ($ni->name ?? '');
        $target = method_exists($ni, 'getTarget') ? $ni->getTarget() : ($ni->target ?? '');
        $isCurrent = method_exists($ni, 'isCurrentPage')
            ? (bool) $ni->isCurrentPage()
            : (!empty($ni->isCurrent) || !empty($ni->inPath));
    ?>
    <li class="m-0 p-0">
        <a href="<?= h($url) ?>"
           <?php if (!empty($target)): ?>target="<?= h($target) ?>"<?php endif; ?>
           class="vanguard-nav__link<?= $isCurrent ? ' vanguard-nav__link--active' : '' ?>">
            <?= h($name) ?>
        </a>
    </li>
    <?php endforeach; ?>
</ul>
<?php elseif (is_object($c) && $c->isEditMode()): ?>
<div class="ccm-edit-mode-disabled-item"><?= t('Empty Auto-Nav Block.') ?></div>
<?php endif; ?>
