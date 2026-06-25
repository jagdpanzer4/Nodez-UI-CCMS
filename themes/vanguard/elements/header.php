<?php defined('C5_EXECUTE') or die('Access Denied.'); ?>
<?php
$c = Page::getCurrentPage();
$site = \Concrete\Core\Support\Facade\Site::getSite();
$isEditMode = $c && $c->isEditMode();
$hamburgerExpanded = $isEditMode ? 'true' : 'false';
$mobileNavClasses = $isEditMode
    ? 'vanguard-nav__mobile fixed top-16 left-0 w-full z-40 glass-panel border-b border-white/10 py-4 px-8 flex flex-col gap-4'
    : 'vanguard-nav__mobile fixed top-16 left-0 w-full z-40 glass-panel border-b border-white/10 py-4 px-8 hidden flex-col gap-4 md:hidden';
?>
<header>
    <nav class="vanguard-nav" id="vanguard-nav">

        <!-- Logo -->
        <a href="<?= DIR_REL ?>/" class="vanguard-nav__logo">
            <?= h($site->getSiteName()) ?>
        </a>

        <!-- Desktop nav — autonav block in GlobalArea "Nav Bar" -->
        <div class="hidden md:flex items-center gap-8 h-full" id="nav-desktop">
            <?php (new GlobalArea('Nav Bar'))->display(); ?>
        </div>

        <!-- Icon buttons + mobile hamburger -->
        <div class="flex items-center gap-4">
            <button class="text-on-surface-variant hover:text-on-surface active:scale-95 transition-all duration-150"
                    aria-label="Settings">
                <span class="material-symbols-outlined">settings</span>
            </button>
            <button class="text-on-surface-variant hover:text-on-surface active:scale-95 transition-all duration-150"
                    aria-label="Notifications">
                <span class="material-symbols-outlined">notifications</span>
            </button>
            <!-- Mobile hamburger — toggles #nav-mobile via vanguard.js -->
            <button class="md:hidden text-on-surface-variant hover:text-on-surface transition-colors duration-150"
                    id="nav-hamburger"
                    aria-label="Menu"
                    aria-expanded="<?= $hamburgerExpanded ?>">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>

    </nav>

    <!-- Mobile dropdown menu -->
    <div class="<?= h($mobileNavClasses) ?>"
         id="nav-mobile">
        <?php (new GlobalArea('Nav Bar Mobile'))->display(); ?>
    </div>
</header>
