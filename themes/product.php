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
<body class="bg-surface text-on-surface font-body grid-bg min-h-screen">

<?php $view->inc('elements/header.php'); ?>

<main class="pt-24 pb-20 px-6 max-w-7xl mx-auto">

    <div class="mb-8 flex items-center gap-2">
        <a href="<?= BASE_URL ?>"
           class="flex items-center gap-2 vanguard-label hover:opacity-80 transition-opacity">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            BACK_TO_DASHBOARD
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

        <div class="lg:col-span-5 space-y-8">
            <?php (new Area('Specs Left'))->display($c); ?>
        </div>

        <div class="lg:col-span-7 flex flex-col gap-8">
            <?php (new Area('Visual Main'))->display($c); ?>
            <div class="flex flex-wrap gap-4">
                <?php (new Area('Actions'))->display($c); ?>
            </div>
        </div>

    </div>
</main>

<?php $view->inc('elements/footer.php'); ?>
<script src="<?= h($thUrl) ?>/js/vanguard.js"></script>
</body>
</html>
