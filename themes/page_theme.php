<?php
namespace Application\Theme\Vanguard;

use Concrete\Core\Page\Theme\Theme;

class PageTheme extends Theme
{
    protected $pThemeName        = 'Vanguard';
    protected $pThemeDescription = 'The Digital Vanguard — Tactical precision dark theme.';
    protected $pThemeVersion     = '1.0.0';

    public function getThemePageTypeClasses(): array
    {
        return [
            'home'       => t('Home'),
            'product'    => t('Product'),
            'full_width' => t('Full Width'),
            'single'     => t('Single Post'),
            'contact'    => t('Contact'),
        ];
    }

    public function getThemeEditorClasses(): array
    {
        return [
            ['title' => t('Headline'),       'attributes' => ['class' => 'font-headline']],
            ['title' => t('Label'),          'attributes' => ['class' => 'vanguard-label']],
            ['title' => t('Card'),           'attributes' => ['class' => 'vanguard-card']],
            ['title' => t('Glass Card'),     'attributes' => ['class' => 'vanguard-card--glass']],
            ['title' => t('Primary Button'), 'attributes' => ['class' => 'vanguard-btn-primary']],
            ['title' => t('CTA Button'),     'attributes' => ['class' => 'vanguard-btn-cta']],
            ['title' => t('Ghost Button'),   'attributes' => ['class' => 'vanguard-btn-ghost']],
            ['title' => t('Stat Block'),     'attributes' => ['class' => 'vanguard-stat']],
        ];
    }
}
