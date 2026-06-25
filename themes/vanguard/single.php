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
<body class="bg-surface text-on-surface font-body">
<?php $view->inc('elements/header.php'); ?>
<main class="pt-24 pb-20 px-6">
    <article class="max-w-3xl mx-auto">
        <?php (new Area('Main'))->display($c); ?>
    </article>
</main>
<?php $view->inc('elements/footer.php'); ?>
<script src="<?= h($thUrl) ?>/js/vanguard.js"></script>
</body>
</html>
