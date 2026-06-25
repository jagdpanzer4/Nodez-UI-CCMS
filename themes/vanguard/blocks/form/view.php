<?php
defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Block\Form\MiniSurvey;

$app = \Concrete\Core\Support\Facade\Application::getFacadeApplication();

$survey     = $controller;
$miniSurvey = new MiniSurvey($b);
$miniSurvey->frontEndMode = true;

$bID        = (int) $bID;
$qsID       = (int) ($survey->questionSetId);
$formAction = $view->action('submit_form') . '#formblock' . $bID;

$questionsRS = $miniSurvey->loadQuestions($qsID, $bID);
$questions   = [];
while ($questionRow = $questionsRS->fetch()) {
    $question          = $questionRow;
    $question['input'] = $miniSurvey->loadInputType($questionRow, false);

    if ($questionRow['inputType'] === 'text') {
        $question['type'] = 'textarea';
    } elseif ($questionRow['inputType'] === 'field') {
        $question['type'] = 'text';
    } else {
        $question['type'] = $questionRow['inputType'];
    }

    $question['labelFor'] = 'for="Question' . $questionRow['msqID'] . '"';

    if ($question['type'] === 'textarea') {
        $question['input'] = str_replace('style="width:95%"', '', $question['input']);
    }

    $questions[] = $question;
}

$success   = (\Request::request('surveySuccess') && \Request::request('qsid') == $qsID);
$thanksMsg = $survey->thankyouMsg;

$errorHeader = $formResponse ?? null;
$errors      = isset($errors) && is_array($errors) ? $errors : [];
if (isset($invalidIP) && $invalidIP) {
    $errors[] = $invalidIP;
}

$surveyBlockInfo = $miniSurvey->getMiniSurveyBlockInfoByQuestionId($qsID, $bID);
$captcha         = $surveyBlockInfo['displayCaptcha'] ? $app->make('helper/validation/captcha') : false;
?>

<div id="formblock<?= $bID ?>" class="vanguard-form-block">

    <?php if ($success) { ?>

    <div class="vanguard-card--glass p-4 text-primary" role="alert">
        <?= h($thanksMsg) ?>
    </div>

    <?php } else { ?>

    <?php if ($errors) { ?>
    <div class="vanguard-card--glass p-4 text-error" role="alert">
        <?php if ($errorHeader) { ?>
        <p><?= h($errorHeader) ?></p>
        <?php } ?>
        <?php foreach ($errors as $error) { ?>
        <p><?= h($error) ?></p>
        <?php } ?>
    </div>
    <?php } ?>

    <form
        id="miniSurveyView<?= $bID ?>"
        class="space-y-6"
        method="post"
        enctype="multipart/form-data"
        action="<?= h($formAction) ?>"
        novalidate
    >
        <?= Core::make('token')->output('form_block_submit_qs_' . $qsID) ?>

        <div class="space-y-6">
            <?php foreach ($questions as $question) {
                $hasError  = isset($errorDetails[$question['msqID']]);
                $inputType = $question['type'];
            ?>
            <div class="mb-6 field-<?= h($inputType) ?><?= $hasError ? ' text-error' : '' ?>">

                <label class="vanguard-label block mb-2" <?= $question['labelFor'] ?>>
                    <?= h($question['question']) ?>
                    <?php if ($question['required']) { ?>
                    <span class="text-primary" aria-hidden="true"> *</span>
                    <span class="sr-only"><?= h(t('Required')) ?></span>
                    <?php } ?>
                </label>

                <?php
                $inputHtml = $question['input'];

                if ($inputType === 'text' || $inputType === 'email' || $inputType === 'telephone' || $inputType === 'url' || $inputType === 'number') {
                    $inputHtml = preg_replace(
                        '/(<input\b)(\s)/i',
                        '$1 class="vanguard-input" $2',
                        $inputHtml,
                        1
                    );
                } elseif ($inputType === 'textarea') {
                    $inputHtml = preg_replace(
                        '/(<textarea\b)(\s)/i',
                        '$1 class="vanguard-input" $2',
                        $inputHtml,
                        1
                    );
                } elseif ($inputType === 'select' || $inputType === 'selectmultiple') {
                    $inputHtml = preg_replace(
                        '/(<select\b)(\s)/i',
                        '$1 class="vanguard-input" $2',
                        $inputHtml,
                        1
                    );
                } elseif ($inputType === 'checkbox') {
                    $inputHtml = preg_replace(
                        '/(<input\b([^>]*?type=["\']checkbox["\'][^>]*?))(\/?>)/i',
                        '$1 class="mr-2 h-4 w-4 accent-primary"$3',
                        $inputHtml
                    );
                } elseif ($inputType === 'radio') {
                    $inputHtml = preg_replace(
                        '/(<input\b([^>]*?type=["\']radio["\'][^>]*?))(\/?>)/i',
                        '$1 class="mr-2 h-4 w-4 accent-primary"$3',
                        $inputHtml
                    );
                }

                echo $inputHtml;
                ?>

                <?php if ($hasError) { ?>
                    <?php foreach ((array) ($errorDetails[$question['msqID']] ?? []) as $errMsg): ?>
                    <span class="block mt-2 text-sm text-error" role="alert"><?= h($errMsg) ?></span>
                    <?php endforeach; ?>
                <?php } ?>

            </div>
            <?php } ?>
        </div>

        <?php if ($captcha) { ?>
        <div class="mb-6">
            <?php
            $captchaLabel = $captcha->label();
            if (!empty($captchaLabel)) { ?>
            <label class="vanguard-label block mb-2"><?= h($captchaLabel) ?></label>
            <?php }

            ob_start();
            $captcha->showInput();
            $captchaInputHtml = ob_get_clean();
            $captchaInputHtml = preg_replace('/(<input\b)(\s)/i', '$1 class="vanguard-input" $2', $captchaInputHtml, 1);
            ?>
            <div class="mb-4"><?php $captcha->display(); ?></div>
            <div><?= $captchaInputHtml ?></div>
        </div>
        <?php } ?>

        <div class="pt-2">
            <button type="submit" name="Submit" class="vanguard-btn-cta">
                <?= h(t($survey->submitText)) ?>
            </button>
        </div>

        <input type="hidden" name="qsID" value="<?= $qsID ?>"/>
        <input type="hidden" name="pURI" value="<?= h($pURI ?? '') ?>"/>

    </form>

    <?php } ?>

</div>
