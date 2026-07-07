<?php defined('C5_EXECUTE') or die('Access Denied.'); ?>
<?php $thUrl = $view->getThemeURL(); ?>
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
<main class="pt-24 pb-20 px-6 max-w-3xl mx-auto">
    <div class="mb-16">
        <?php (new Area('Contact Header'))->display($c); ?>
    </div>
    <div class="vanguard-card--glass p-8">
        <?php (new Area('Form'))->display($c); ?>
    </div>
</main>
<?php $view->inc('elements/footer.php'); ?>
</div>
<?php View::element('footer_required'); ?>
<script src="<?= h($thUrl) ?>/js/vanguard.js"></script>
</body>
</html>
