<?php defined('C5_EXECUTE') or die('Access Denied.'); ?>
<?php
$thUrl = $view->getThemeURL();
?>
<!DOCTYPE html>
<html class="dark" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php View::element('header_required', [
        'pageTitle'       => $c->getCollectionName(),
        'pageDescription' => $c->getCollectionDescription(),
    ]); ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= h($thUrl) ?>/css/vanguard.css">
</head>
<body class="ccm-page-id-<?= $c->getCollectionID() ?>">
<div class="ccm-page">

<?php $view->inc('elements/header.php'); ?>

<main class="pt-16">

    <!-- ── Hero Section ──────────────────────────── -->
    <section class="vanguard-hero">
        <div class="vanguard-hero__bg"></div>
        <!-- Asymmetric decorative rings -->
        <div class="vanguard-hero__ring w-[120%] h-[120%] border border-primary/5 rotate-12"></div>
        <div class="vanguard-hero__ring w-[80%] h-[80%] border border-tertiary/10 -rotate-12"></div>
        <div class="relative z-10 w-full max-w-7xl mx-auto">
            <?php (new Area('Hero'))->display($c); ?>
        </div>
    </section>

    <!-- ── Bento Grid Section ────────────────────── -->
    <section class="vanguard-section bg-surface-container-low">
        <div class="vanguard-container">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-4">
                <?php (new Area('Bento Header'))->display($c); ?>
            </div>
            <?php (new Area('Bento Grid'))->display($c); ?>
        </div>
    </section>

    <!-- ── Main Content ───────────────────────────── -->
    <section class="vanguard-section">
        <div class="vanguard-container">
            <?php (new Area('Main'))->display($c); ?>
        </div>
    </section>

</main>

<?php $view->inc('elements/footer.php'); ?>
</div>
<?php View::element('footer_required'); ?>
<script src="<?= h($thUrl) ?>/js/vanguard.js"></script>
</body>
</html>
