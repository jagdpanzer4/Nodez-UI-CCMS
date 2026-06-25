# Vanguard CCMS Theme Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Zbudować kompletny theme "The Digital Vanguard" dla Concrete CMS 9.x z block template overrides dla wszystkich domyślnych bloków, 5 typami stron i skompilowanym Tailwind CSS.

**Architecture:** Theme-only (brak custom bloków PHP) w `application/themes/vanguard/`. Cały design osiągany przez PHP page layouts z named Areas + template overrides domyślnych bloków CCMS. Tailwind CLI kompiluje tokeny z DESIGN.md do `css/vanguard.css`.

**Tech Stack:** PHP 8.x, Concrete CMS 9.x, Tailwind CSS 3.x CLI, Space Grotesk + Inter (Google Fonts), Material Symbols Outlined

---

## Mapa plików

| Plik | Odpowiedzialność |
|---|---|
| `description.xml` | Rejestracja theme'u w CCMS |
| `PageTheme.php` | Rejestracja page types i assetów |
| `css/src/tailwind.config.js` | Pełny token set z DESIGN.md |
| `css/src/main.css` | @layer base/components/utilities |
| `css/vanguard.css` | Skompilowany output (nie edytuj ręcznie) |
| `js/vanguard.js` | Mobile nav, scroll behavior, micro-interactions |
| `elements/header.php` | TopNavBar glassmorphic fixed |
| `elements/footer.php` | Footer 4-kolumnowy |
| `page_themes/home.php` | Landing: Hero + Bento Grid + Main areas |
| `page_themes/product.php` | Specs: 12-col z Specs Left / Visual Main / Actions |
| `page_themes/full_width.php` | Full width z jednym Main area |
| `page_themes/single.php` | Artykuł: content area z max-width |
| `page_themes/contact.php` | Contact Header + Form areas |
| `blocks/autonav/view.php` | Tactical nav links |
| `blocks/hero_image/view.php` | Hero z radial gradient + HUD overlay |
| `blocks/page_list/bento_grid.php` | 4-col bento grid kart |
| `blocks/feature/data_readout.php` | Glassmorphic stat card |
| `blocks/content/view.php` | Typografia Vanguard |
| `blocks/image/tactical.php` | Image z glass caption + primary glow |
| `blocks/form/view.php` | Bottom-border inputs + tactical CTA |

---

## Task 1: Scaffold struktury katalogów i package.json

**Files:**
- Create: `application/themes/vanguard/` (katalog + subdirectory tree)
- Create: `application/themes/vanguard/css/src/package.json`

- [ ] **Step 1: Utwórz drzewo katalogów**

```bash
cd /path/to/concrete-cms-root
mkdir -p application/themes/vanguard/{page_themes,elements,blocks/{autonav,hero_image,page_list,feature,content,image,form},css/src,js}
```

- [ ] **Step 2: Utwórz package.json**

`application/themes/vanguard/css/src/package.json`:
```json
{
  "name": "vanguard-theme",
  "version": "1.0.0",
  "scripts": {
    "dev": "tailwindcss -c tailwind.config.js -i main.css -o ../vanguard.css --watch",
    "build": "tailwindcss -c tailwind.config.js -i main.css -o ../vanguard.css --minify"
  },
  "devDependencies": {
    "tailwindcss": "^3.4.0"
  }
}
```

- [ ] **Step 3: Zainstaluj Tailwind CLI**

```bash
cd application/themes/vanguard/css/src
npm install
```

Oczekiwane: `node_modules/` created, `package-lock.json` created.

- [ ] **Step 4: Commit**

```bash
git add application/themes/vanguard/
git commit -m "chore: scaffold vanguard theme directory structure"
```

---

## Task 2: description.xml + PageTheme.php

**Files:**
- Create: `application/themes/vanguard/description.xml`
- Create: `application/themes/vanguard/PageTheme.php`
- Create: `application/themes/vanguard/thumbnail.png` *(placeholder — zastąp zrzutem ekranu)*

- [ ] **Step 1: Utwórz description.xml**

`application/themes/vanguard/description.xml`:
```xml
<?xml version="1.0"?>
<theme>
    <name>Vanguard</name>
    <description>The Digital Vanguard — Tactical precision dark theme for Concrete CMS 9.x</description>
    <version>1.0.0</version>
    <supportsPageTypes>true</supportsPageTypes>
</theme>
```

- [ ] **Step 2: Utwórz PageTheme.php**

`application/themes/vanguard/PageTheme.php`:
```php
<?php
namespace Application\Theme\Vanguard;

use Concrete\Core\Page\Theme\Theme;

class PageTheme extends Theme
{
    public function getThemePageTypes(): array
    {
        return [
            'home'       => 'Home',
            'product'    => 'Product',
            'full_width' => 'Full Width',
            'single'     => 'Single Post',
            'contact'    => 'Contact',
        ];
    }
}
```

- [ ] **Step 3: Utwórz placeholder thumbnail**

```bash
# Utwórz puste PNG 355x266 (minimalny wymagany rozmiar CCMS)
convert -size 355x266 xc:'#121410' \
  -fill '#b6d088' -font Helvetica -pointsize 24 \
  -gravity center -annotate 0 'VANGUARD' \
  application/themes/vanguard/thumbnail.png
# Jeśli brak ImageMagick: skopiuj dowolny PNG 355x266 jako placeholder
```

- [ ] **Step 4: Commit**

```bash
git add application/themes/vanguard/description.xml application/themes/vanguard/PageTheme.php application/themes/vanguard/thumbnail.png
git commit -m "feat: add vanguard theme registration files"
```

---

## Task 3: tailwind.config.js — pełny zestaw tokenów

**Files:**
- Create: `application/themes/vanguard/css/src/tailwind.config.js`

- [ ] **Step 1: Utwórz tailwind.config.js z pełnymi tokenami z DESIGN.md**

`application/themes/vanguard/css/src/tailwind.config.js`:
```js
/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: [
    '../../**/*.php',
    '../../**/*.html',
  ],
  theme: {
    extend: {
      colors: {
        // Surfaces
        'surface':                    '#121410',
        'surface-dim':                '#121410',
        'surface-bright':             '#383a35',
        'surface-container-lowest':   '#0d0f0b',
        'surface-container-low':      '#1a1c18',
        'surface-container':          '#1e201c',
        'surface-container-high':     '#292b26',
        'surface-container-highest':  '#333531',
        'surface-variant':            '#333531',
        'surface-tint':               '#b6d088',
        // Primary (Olive)
        'primary':                    '#b6d088',
        'primary-fixed':              '#d2eca2',
        'primary-fixed-dim':          '#b6d088',
        'primary-container':          '#556b2f',
        'on-primary':                 '#233600',
        'on-primary-fixed':           '#131f00',
        'on-primary-fixed-variant':   '#394d14',
        'on-primary-container':       '#d0eba1',
        'inverse-primary':            '#50652a',
        // Secondary (Sand)
        'secondary':                  '#d6c692',
        'secondary-fixed':            '#f3e2ac',
        'secondary-fixed-dim':        '#d6c692',
        'secondary-container':        '#544820',
        'on-secondary':               '#3a3009',
        'on-secondary-fixed':         '#231b00',
        'on-secondary-fixed-variant': '#51461e',
        'on-secondary-container':     '#c8b885',
        // Tertiary (Orange accent)
        'tertiary':                   '#ffb77d',
        'tertiary-fixed':             '#ffdcc3',
        'tertiary-fixed-dim':         '#ffb77d',
        'tertiary-container':         '#985100',
        'on-tertiary':                '#4d2600',
        'on-tertiary-fixed':          '#2f1500',
        'on-tertiary-fixed-variant':  '#6e3900',
        'on-tertiary-container':      '#ffd9be',
        // Text
        'on-surface':                 '#e3e3dc',
        'on-surface-variant':         '#c5c8b8',
        'on-background':              '#e3e3dc',
        'inverse-surface':            '#e3e3dc',
        'inverse-on-surface':         '#2f312d',
        // Outline
        'outline':                    '#8f9284',
        'outline-variant':            '#45483c',
        // Error
        'error':                      '#ffb4ab',
        'error-container':            '#93000a',
        'on-error':                   '#690005',
        'on-error-container':         '#ffdad6',
        // Background
        'background':                 '#121410',
      },
      fontFamily: {
        'headline': ['Space Grotesk', 'sans-serif'],
        'body':     ['Inter', 'sans-serif'],
        'label':    ['Space Grotesk', 'sans-serif'],
      },
      borderRadius: {
        'DEFAULT': '0.125rem',
        'lg':      '0.25rem',
        'xl':      '0.5rem',
        'full':    '0.75rem',
      },
      boxShadow: {
        'ambient': '0 32px 64px -15px rgba(18, 20, 16, 0.06)',
        'float':   '0 8px 32px 0 rgba(18, 20, 16, 0.06)',
      },
    },
  },
  plugins: [],
}
```

- [ ] **Step 2: Weryfikacja konfiguracji**

```bash
cd application/themes/vanguard/css/src
npx tailwindcss --dry-run -c tailwind.config.js -i /dev/null 2>&1 | head -20
```

Oczekiwane: brak błędów konfiguracji.

- [ ] **Step 3: Commit**

```bash
git add application/themes/vanguard/css/src/tailwind.config.js
git commit -m "feat: add tailwind config with full Vanguard design token set"
```

---

## Task 4: src/main.css — @layer base, components, utilities

**Files:**
- Create: `application/themes/vanguard/css/src/main.css`

- [ ] **Step 1: Utwórz main.css**

`application/themes/vanguard/css/src/main.css`:
```css
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {
  html {
    @apply dark;
  }

  body {
    @apply bg-surface text-on-surface font-body;
    selection-color: #4d2600;
  }

  ::selection {
    background-color: #ffb77d;
    color: #4d2600;
  }

  h1, h2, h3, h4, h5, h6 {
    @apply font-headline;
  }

  /* Scrollbar */
  ::-webkit-scrollbar { width: 4px; }
  ::-webkit-scrollbar-track { background: #121410; }
  ::-webkit-scrollbar-thumb { background: #45483c; border-radius: 2px; }

  /* CCMS edit mode guard — zapobiega kolizji z paskiem edycji */
  .ccm-toolbar-visible body { padding-top: 48px !important; }
}

@layer components {

  /* ── Navigation ──────────────────────────────────── */
  .vanguard-nav {
    @apply fixed top-0 w-full z-50 flex justify-between items-center px-8 h-16;
    background: rgba(41, 43, 38, 0.60);
    backdrop-filter: blur(24px);
    -webkit-backdrop-filter: blur(24px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.10);
    box-shadow: 0 32px 64px -15px rgba(18, 20, 16, 0.06);
  }

  .vanguard-nav__link {
    @apply font-label tracking-tighter uppercase text-sm text-on-surface-variant
           hover:text-on-surface transition-colors duration-150;
  }

  .vanguard-nav__link--active {
    @apply text-primary;
    border-bottom: 2px solid #b6d088;
    padding-bottom: 4px;
  }

  .vanguard-nav__logo {
    @apply font-headline font-bold tracking-widest text-xl text-primary;
  }

  /* ── Hero ────────────────────────────────────────── */
  .vanguard-hero {
    @apply relative min-h-[921px] flex items-center overflow-hidden px-8 md:px-24;
  }

  .vanguard-hero__bg {
    @apply absolute inset-0 z-0;
    background: radial-gradient(circle at 70% 50%, rgba(85, 107, 47, 0.15) 0%, rgba(18, 20, 16, 1) 70%);
  }

  .vanguard-hero__ring {
    @apply absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-full pointer-events-none;
  }

  .vanguard-hero__badge {
    @apply inline-flex items-center gap-2 px-3 py-1 rounded-lg;
    background: rgba(85, 107, 47, 0.30);
    border: 1px solid rgba(182, 208, 136, 0.20);
  }

  /* ── Cards ───────────────────────────────────────── */
  .vanguard-card {
    @apply bg-surface-container rounded-xl border transition-all duration-150;
    border-color: rgba(69, 72, 60, 0.10);
  }

  .vanguard-card:hover {
    border-color: rgba(182, 208, 136, 0.30);
  }

  .vanguard-card--high {
    @apply bg-surface-container-highest rounded-xl border transition-all duration-150;
    border-color: rgba(69, 72, 60, 0.10);
  }

  .vanguard-card--high:hover {
    border-color: rgba(255, 183, 125, 0.30);
  }

  .vanguard-card--accent {
    @apply bg-primary-container rounded-xl relative overflow-hidden;
  }

  .vanguard-card--glass {
    @apply rounded-xl border;
    background: rgba(51, 53, 49, 0.60);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-color: rgba(69, 72, 60, 0.15);
  }

  /* ── Buttons ─────────────────────────────────────── */
  .vanguard-btn-primary {
    @apply px-8 py-3 rounded-lg font-headline font-bold text-on-primary
           flex items-center gap-3 transition-all duration-150 cursor-pointer;
    background: linear-gradient(to right, #b6d088, #556b2f);
  }

  .vanguard-btn-primary:active {
    transform: scale(0.98);
  }

  .vanguard-btn-cta {
    @apply px-8 py-4 rounded-lg font-headline font-bold uppercase tracking-widest
           text-on-tertiary transition-all duration-150 cursor-pointer relative overflow-hidden;
    background: linear-gradient(to right, #ffb77d, #985100);
  }

  .vanguard-btn-cta:active {
    transform: scale(0.98);
  }

  .vanguard-btn-ghost {
    @apply px-8 py-4 rounded-lg font-headline font-bold uppercase tracking-widest
           text-on-surface hover:bg-white/5 transition-all duration-150 cursor-pointer;
    border: 1px solid rgba(69, 72, 60, 0.30);
  }

  /* ── Form Inputs ─────────────────────────────────── */
  .vanguard-input {
    @apply w-full bg-transparent px-0 py-3 text-on-surface font-body text-sm
           transition-all duration-150;
    border: none;
    border-bottom: 2px solid #8f9284;
    outline: none;
    border-radius: 0;
  }

  .vanguard-input:focus {
    border-bottom-color: #b6d088;
    background: rgba(85, 107, 47, 0.05);
  }

  .vanguard-input::placeholder {
    color: #8f9284;
  }

  /* ── Data / Stats ────────────────────────────────── */
  .vanguard-stat {
    @apply p-6 rounded-xl;
    background: rgba(51, 53, 49, 0.60);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(69, 72, 60, 0.15);
  }

  .vanguard-stat__label {
    @apply font-label text-[10px] uppercase tracking-widest text-on-surface-variant mb-1;
  }

  .vanguard-stat__value {
    @apply font-headline text-2xl font-bold text-on-surface;
  }

  /* ── Chips ───────────────────────────────────────── */
  .vanguard-chip {
    @apply inline-flex items-center gap-2 px-3 py-1 font-label text-xs text-on-surface-variant;
    background: #333531;
    border-radius: 0.125rem;
  }

  .vanguard-chip::before {
    content: '';
    display: inline-block;
    width: 3px;
    height: 3px;
    background: #ffb77d;
    flex-shrink: 0;
  }

  /* ── Labels ──────────────────────────────────────── */
  .vanguard-label {
    @apply font-label text-xs uppercase tracking-widest text-tertiary;
  }

  /* ── Progress Bar ────────────────────────────────── */
  .vanguard-progress {
    @apply h-1 w-full rounded-full overflow-hidden;
    background: #333531;
  }

  .vanguard-progress__fill {
    @apply h-full rounded-full;
    background: #b6d088;
    transition: width 0.6s ease;
  }

  /* ── Section Layout ──────────────────────────────── */
  .vanguard-section {
    @apply py-24 px-8 md:px-24;
  }

  .vanguard-container {
    @apply max-w-7xl mx-auto;
  }

  /* ── CCMS Edit Mode ──────────────────────────────── */
  .ccm-edit-mode .vanguard-card--glass,
  .ccm-edit-mode .vanguard-card {
    min-height: 80px;
  }
}

@layer utilities {
  .glass-panel {
    background: rgba(51, 53, 49, 0.60);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
  }

  .grid-bg {
    background-image: radial-gradient(circle at 1px 1px, rgba(182, 208, 136, 0.05) 1px, transparent 0);
    background-size: 24px 24px;
  }

  .text-glow {
    text-shadow: 0 0 15px rgba(255, 183, 125, 0.30);
  }
}
```

- [ ] **Step 2: Zbuduj CSS i sprawdź output**

```bash
cd application/themes/vanguard/css/src
npm run dev &
# Poczekaj 3s na kompilację
sleep 3
ls -lh ../vanguard.css
```

Oczekiwane: plik `vanguard.css` istnieje, rozmiar > 0.

- [ ] **Step 3: Zatrzymaj watcher i zbuduj produkcyjnie**

```bash
kill %1  # zatrzymaj npm run dev
npm run build
ls -lh ../vanguard.css
```

Oczekiwane: plik istnieje. Przy pustych PHP (tylko `content: ['../../**/*.php']` bez klas) CSS będzie minimalny — urośnie po dodaniu klas w kolejnych taskach.

- [ ] **Step 4: Commit**

```bash
git add application/themes/vanguard/css/
git commit -m "feat: add Tailwind config and CSS component system for Vanguard theme"
```

---

## Task 5: elements/header.php — TopNavBar glassmorphic

**Files:**
- Create: `application/themes/vanguard/elements/header.php`

- [ ] **Step 1: Utwórz header.php**

`application/themes/vanguard/elements/header.php`:
```php
<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<?php
$c = Page::getCurrentPage();
$al = AssetList::getInstance();
?>
<header>
    <nav class="vanguard-nav" id="vanguard-nav">
        <!-- Logo -->
        <a href="<?= DIR_REL ?>/" class="vanguard-nav__logo">
            <?= Config::get('concrete.site', 'VANGUARD_OS') ?>
        </a>

        <!-- Desktop Links — renderowane przez blok autonav w Area NavBar -->
        <div class="hidden md:flex items-center gap-8 h-full" id="nav-desktop">
            <?php
            $navArea = new GlobalArea('Nav Bar');
            $navArea->display();
            ?>
        </div>

        <!-- Icon Buttons -->
        <div class="flex items-center gap-4">
            <button class="text-on-surface-variant hover:text-on-surface active:scale-95 transition-all duration-150"
                    aria-label="Ustawienia">
                <span class="material-symbols-outlined">settings</span>
            </button>
            <button class="text-on-surface-variant hover:text-on-surface active:scale-95 transition-all duration-150"
                    aria-label="Powiadomienia">
                <span class="material-symbols-outlined">notifications</span>
            </button>
            <!-- Mobile hamburger -->
            <button class="md:hidden text-on-surface-variant hover:text-on-surface transition-colors duration-150"
                    id="nav-hamburger" aria-label="Menu" aria-expanded="false">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="fixed top-16 left-0 w-full z-40 glass-panel border-b border-white/10 py-4 px-8
                hidden flex-col gap-4 md:hidden" id="nav-mobile">
        <?php
        $navMobile = new GlobalArea('Nav Bar Mobile');
        $navMobile->display();
        ?>
    </div>
</header>
```

> **CCMS setup:** W panelu admin → Pages → Global Areas → utwórz obszar "Nav Bar" i "Nav Bar Mobile", dodaj blok `autonav` (używając template override `vanguard-nav-links` — patrz Task 9).

- [ ] **Step 2: Weryfikacja składni PHP**

```bash
php -l application/themes/vanguard/elements/header.php
```

Oczekiwane: `No syntax errors detected`.

- [ ] **Step 3: Commit**

```bash
git add application/themes/vanguard/elements/header.php
git commit -m "feat: add Vanguard theme header element with glassmorphic nav"
```

---

## Task 6: elements/footer.php — Footer 4-kolumnowy

**Files:**
- Create: `application/themes/vanguard/elements/footer.php`

- [ ] **Step 1: Utwórz footer.php**

`application/themes/vanguard/elements/footer.php`:
```php
<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<?php $site = Core::make('site')->getSite(); ?>
<footer class="bg-surface w-full py-12 px-8 border-t border-outline-variant/20">
    <div class="grid grid-cols-2 md:grid-cols-4 w-full gap-8 max-w-7xl mx-auto">

        <!-- Branding -->
        <div class="col-span-2 md:col-span-1 space-y-4">
            <div class="vanguard-nav__logo">
                <?= h($site->getSiteName()) ?>
            </div>
            <p class="font-body text-[10px] leading-tight uppercase tracking-normal text-outline">
                &copy;<?= date('Y') ?> <?= h($site->getSiteName()) ?> // ENCRYPTED_CONNECTION
            </p>
        </div>

        <!-- Col 2 — Footer Nav Area 1 -->
        <div class="space-y-4">
            <div class="vanguard-label">Operation_Logs</div>
            <?php
            $footerArea1 = new GlobalArea('Footer Nav 1');
            $footerArea1->display();
            ?>
        </div>

        <!-- Col 3 — Footer Nav Area 2 -->
        <div class="space-y-4">
            <div class="vanguard-label">Digital_Terminal</div>
            <?php
            $footerArea2 = new GlobalArea('Footer Nav 2');
            $footerArea2->display();
            ?>
        </div>

        <!-- Col 4 — Security Badge -->
        <div class="flex items-end justify-end col-span-2 md:col-span-1">
            <div class="text-right">
                <div class="font-label text-[10px] text-primary/30 uppercase mb-2">Security_Protocol</div>
                <div class="bg-primary/10 border border-primary/20 p-2 font-headline text-[10px] text-primary rounded">
                    SECURE_KERNEL_LOCKED
                </div>
            </div>
        </div>

    </div>
</footer>
<?php View::element('footer_required'); ?>
```

- [ ] **Step 2: Weryfikacja składni**

```bash
php -l application/themes/vanguard/elements/footer.php
```

Oczekiwane: `No syntax errors detected`.

- [ ] **Step 3: Commit**

```bash
git add application/themes/vanguard/elements/footer.php
git commit -m "feat: add Vanguard theme footer element with 4-column layout"
```

---

## Task 7: page_themes/home.php — Landing z Hero + Bento + Main

**Files:**
- Create: `application/themes/vanguard/page_themes/home.php`

- [ ] **Step 1: Utwórz home.php**

`application/themes/vanguard/page_themes/home.php`:
```php
<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<!DOCTYPE html>
<html class="dark" lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php View::element('header_required'); ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $view->getThemeURL() ?>/css/vanguard.css">
</head>
<body class="bg-surface text-on-surface font-body selection:bg-tertiary selection:text-on-tertiary">

<?php $this->inc('elements/header.php'); ?>

<main class="pt-16">

    <!-- ── Hero Section ──────────────────────────── -->
    <section class="vanguard-hero">
        <div class="vanguard-hero__bg"></div>
        <!-- Dekoracyjne kółka asymetryczne -->
        <div class="vanguard-hero__ring w-[120%] h-[120%] border border-primary/5 rotate-12"></div>
        <div class="vanguard-hero__ring w-[80%] h-[80%] border border-tertiary/10 -rotate-12"></div>
        <div class="relative z-10 w-full max-w-7xl mx-auto">
            <?php
            $a = new Area('Hero');
            $a->display($c);
            ?>
        </div>
    </section>

    <!-- ── Bento Grid Section ────────────────────── -->
    <section class="vanguard-section bg-surface-container-low">
        <div class="vanguard-container">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-4">
                <div class="space-y-4">
                    <?php
                    $a = new Area('Bento Header');
                    $a->display($c);
                    ?>
                </div>
            </div>
            <?php
            $a = new Area('Bento Grid');
            $a->display($c);
            ?>
        </div>
    </section>

    <!-- ── Main Content ───────────────────────────── -->
    <section class="vanguard-section">
        <div class="vanguard-container">
            <?php
            $a = new Area('Main');
            $a->display($c);
            ?>
        </div>
    </section>

</main>

<?php $this->inc('elements/footer.php'); ?>
<script src="<?= $view->getThemeURL() ?>/js/vanguard.js"></script>
</body>
</html>
```

- [ ] **Step 2: Weryfikacja składni**

```bash
php -l application/themes/vanguard/page_themes/home.php
```

Oczekiwane: `No syntax errors detected`.

- [ ] **Step 3: Commit**

```bash
git add application/themes/vanguard/page_themes/home.php
git commit -m "feat: add home page theme with Hero + Bento Grid + Main areas"
```

---

## Task 8: page_themes/product.php — 12-col Specs layout

**Files:**
- Create: `application/themes/vanguard/page_themes/product.php`

- [ ] **Step 1: Utwórz product.php**

`application/themes/vanguard/page_themes/product.php`:
```php
<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<!DOCTYPE html>
<html class="dark" lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php View::element('header_required'); ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $view->getThemeURL() ?>/css/vanguard.css">
</head>
<body class="bg-surface text-on-surface font-body grid-bg min-h-screen">

<?php $this->inc('elements/header.php'); ?>

<main class="pt-24 pb-20 px-6 max-w-7xl mx-auto">

    <!-- Breadcrumb -->
    <div class="mb-8 flex items-center gap-2">
        <a href="javascript:history.back()"
           class="flex items-center gap-2 vanguard-label hover:opacity-80 transition-opacity">
            <span class="material-symbols-outlined text-sm">arrow_back</span>
            BACK_TO_DASHBOARD
        </a>
    </div>

    <!-- 12-col grid: 5 lewy + 7 prawy -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

        <!-- Lewa kolumna — Dane techniczne (5/12) -->
        <div class="lg:col-span-5 space-y-8">
            <?php
            $a = new Area('Specs Left');
            $a->display($c);
            ?>
        </div>

        <!-- Prawa kolumna — Visual + Akcje (7/12) -->
        <div class="lg:col-span-7 flex flex-col gap-8">
            <?php
            $a = new Area('Visual Main');
            $a->display($c);
            ?>

            <!-- Przyciski akcji -->
            <div class="flex flex-wrap gap-4">
                <?php
                $a = new Area('Actions');
                $a->display($c);
                ?>
            </div>
        </div>

    </div>
</main>

<?php $this->inc('elements/footer.php'); ?>
<script src="<?= $view->getThemeURL() ?>/js/vanguard.js"></script>
</body>
</html>
```

- [ ] **Step 2: Weryfikacja składni**

```bash
php -l application/themes/vanguard/page_themes/product.php
```

Oczekiwane: `No syntax errors detected`.

- [ ] **Step 3: Commit**

```bash
git add application/themes/vanguard/page_themes/product.php
git commit -m "feat: add product page theme with 12-col specs layout"
```

---

## Task 9: page_themes/full_width.php + single.php + contact.php

**Files:**
- Create: `application/themes/vanguard/page_themes/full_width.php`
- Create: `application/themes/vanguard/page_themes/single.php`
- Create: `application/themes/vanguard/page_themes/contact.php`

- [ ] **Step 1: Utwórz full_width.php**

`application/themes/vanguard/page_themes/full_width.php`:
```php
<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<!DOCTYPE html>
<html class="dark" lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php View::element('header_required'); ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $view->getThemeURL() ?>/css/vanguard.css">
</head>
<body class="bg-surface text-on-surface font-body">
<?php $this->inc('elements/header.php'); ?>
<main class="pt-16 vanguard-section">
    <div class="vanguard-container">
        <?php $a = new Area('Main'); $a->display($c); ?>
    </div>
</main>
<?php $this->inc('elements/footer.php'); ?>
<script src="<?= $view->getThemeURL() ?>/js/vanguard.js"></script>
</body>
</html>
```

- [ ] **Step 2: Utwórz single.php**

`application/themes/vanguard/page_themes/single.php`:
```php
<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<!DOCTYPE html>
<html class="dark" lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php View::element('header_required'); ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $view->getThemeURL() ?>/css/vanguard.css">
</head>
<body class="bg-surface text-on-surface font-body">
<?php $this->inc('elements/header.php'); ?>
<main class="pt-24 pb-20 px-6">
    <article class="max-w-3xl mx-auto">
        <?php $a = new Area('Main'); $a->display($c); ?>
    </article>
</main>
<?php $this->inc('elements/footer.php'); ?>
<script src="<?= $view->getThemeURL() ?>/js/vanguard.js"></script>
</body>
</html>
```

- [ ] **Step 3: Utwórz contact.php**

`application/themes/vanguard/page_themes/contact.php`:
```php
<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<!DOCTYPE html>
<html class="dark" lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php View::element('header_required'); ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= $view->getThemeURL() ?>/css/vanguard.css">
</head>
<body class="bg-surface text-on-surface font-body">
<?php $this->inc('elements/header.php'); ?>
<main class="pt-24 pb-20 px-6 max-w-3xl mx-auto">
    <div class="mb-16">
        <?php $a = new Area('Contact Header'); $a->display($c); ?>
    </div>
    <div class="vanguard-card--glass p-8">
        <?php $a = new Area('Form'); $a->display($c); ?>
    </div>
</main>
<?php $this->inc('elements/footer.php'); ?>
<script src="<?= $view->getThemeURL() ?>/js/vanguard.js"></script>
</body>
</html>
```

- [ ] **Step 4: Weryfikacja składni wszystkich plików**

```bash
for f in application/themes/vanguard/page_themes/*.php; do
  php -l "$f" && echo "OK: $f"
done
```

Oczekiwane: `No syntax errors detected` dla każdego pliku.

- [ ] **Step 5: Commit**

```bash
git add application/themes/vanguard/page_themes/
git commit -m "feat: add full_width, single, contact page themes"
```

---

## Task 10: blocks/autonav/view.php — Tactical nav links

**Files:**
- Create: `application/themes/vanguard/blocks/autonav/view.php`

- [ ] **Step 1: Zbadaj jakie zmienne udostępnia autonav**

W CCMS 9.x blok `autonav` udostępnia `$navItems` (tablica obiektów nawigacyjnych). Każdy obiekt ma:
- `$ni->getURL()` — URL strony
- `$ni->getName()` — nazwa strony
- `$ni->isCurrentPage()` — czy aktywna
- `$ni->getLevel()` — poziom zagłębienia

Sprawdź aktualne API:
```bash
find /path/to/concrete-cms/concrete/blocks/autonav/ -name "*.php" | head -5
cat /path/to/concrete-cms/concrete/blocks/autonav/view.php | head -40
```

- [ ] **Step 2: Utwórz view.php dla autonav**

`application/themes/vanguard/blocks/autonav/view.php`:
```php
<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<?php if (isset($navItems) && count($navItems)): ?>
<ul class="flex flex-col md:flex-row items-start md:items-center gap-2 md:gap-8 list-none m-0 p-0">
    <?php foreach ($navItems as $ni): ?>
        <?php if ($ni->getLevel() > 1) continue; // Renderuj tylko top-level ?>
        <li class="m-0 p-0">
            <a href="<?= $ni->getURL() ?>"
               class="vanguard-nav__link<?= $ni->isCurrentPage() ? ' vanguard-nav__link--active' : '' ?>">
                <?= h($ni->getName()) ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
```

- [ ] **Step 3: Weryfikacja składni**

```bash
php -l application/themes/vanguard/blocks/autonav/view.php
```

Oczekiwane: `No syntax errors detected`.

- [ ] **Step 4: Commit**

```bash
git add application/themes/vanguard/blocks/autonav/view.php
git commit -m "feat: add autonav block template with tactical nav styling"
```

---

## Task 11: blocks/hero_image/view.php — Hero z HUD overlay

**Files:**
- Create: `application/themes/vanguard/blocks/hero_image/view.php`

- [ ] **Step 1: Zbadaj zmienne bloku hero_image**

```bash
find /path/to/concrete-cms/concrete/blocks/hero_image/ -name "*.php"
cat /path/to/concrete-cms/concrete/blocks/hero_image/controller.php | grep 'public \$'
```

Typowe zmienne bloku `hero_image` (Atomik):
- `$title` — nagłówek hero
- `$body` — opis
- `$buttonText` / `$buttonURL` — przycisk CTA
- `$fileID` — ID pliku graficznego
- `$f` — obiekt File (jeśli obraz załadowany)

- [ ] **Step 2: Utwórz view.php dla hero_image**

`application/themes/vanguard/blocks/hero_image/view.php`:
```php
<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<?php
$image = null;
if (!empty($fileID)) {
    $f = File::getByID($fileID);
    if ($f && $f->getFileID()) {
        $image = $f->getURL();
    }
}
?>
<div class="relative z-10 w-full max-w-7xl mx-auto
            grid grid-cols-1 md:grid-cols-12 gap-12 items-center">

    <!-- Tekst (6 kolumn) -->
    <div class="md:col-span-6 space-y-8">
        <!-- Badge statusu -->
        <div class="vanguard-hero__badge">
            <span class="w-2 h-2 bg-tertiary rounded-full animate-pulse"></span>
            <span class="font-label text-xs tracking-widest text-primary uppercase">
                System Active // v1.0
            </span>
        </div>

        <!-- Nagłówek -->
        <?php if (!empty($title)): ?>
        <h1 class="font-headline text-6xl md:text-8xl font-bold tracking-tighter leading-none text-on-surface">
            <?= nl2br(h($title)) ?>
        </h1>
        <?php endif; ?>

        <!-- Opis -->
        <?php if (!empty($body)): ?>
        <p class="text-on-surface-variant max-w-md text-lg leading-relaxed">
            <?= h($body) ?>
        </p>
        <?php endif; ?>

        <!-- Przyciski CTA -->
        <?php if (!empty($buttonText) && !empty($buttonURL)): ?>
        <div class="flex flex-wrap gap-4 pt-4">
            <a href="<?= h($buttonURL) ?>" class="vanguard-btn-cta">
                <?= h($buttonText) ?>
            </a>
            <?php if (!empty($buttonText2) && !empty($buttonURL2)): ?>
            <a href="<?= h($buttonURL2) ?>" class="vanguard-btn-ghost">
                <?= h($buttonText2) ?>
            </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>

    <!-- Obraz (6 kolumn) -->
    <div class="md:col-span-6 relative h-[500px] md:h-[700px] flex items-center justify-center">
        <?php if ($image): ?>
        <img src="<?= h($image) ?>"
             alt="<?= h($title ?? '') ?>"
             class="relative z-10 object-contain w-full h-full
                    drop-shadow-[0_0_50px_rgba(182,208,136,0.20)]">
        <?php else: ?>
        <!-- Placeholder jeśli brak obrazu -->
        <div class="w-full h-full flex items-center justify-center vanguard-card--glass rounded-xl">
            <span class="material-symbols-outlined text-6xl text-primary/30">image</span>
        </div>
        <?php endif; ?>

        <!-- HUD Overlay — stat card -->
        <div class="absolute top-10 right-0 vanguard-stat space-y-2 z-20 min-w-[140px]">
            <div class="vanguard-stat__label">Structural_Integrity</div>
            <div class="font-headline text-2xl font-bold text-primary">99.8%</div>
            <div class="vanguard-progress">
                <div class="vanguard-progress__fill" style="width: 99.8%"></div>
            </div>
        </div>
    </div>

</div>
```

> **Uwaga:** Jeśli zmienne `$buttonText2`/`$buttonURL2` nie istnieją w kontrolerze bloku, usuń ten blok `if`. Sprawdź controller.php bloku.

- [ ] **Step 3: Weryfikacja składni**

```bash
php -l application/themes/vanguard/blocks/hero_image/view.php
```

Oczekiwane: `No syntax errors detected`.

- [ ] **Step 4: Commit**

```bash
git add application/themes/vanguard/blocks/hero_image/view.php
git commit -m "feat: add hero_image block template with radial bg and HUD overlay"
```

---

## Task 12: blocks/page_list/bento_grid.php — Bento Grid

**Files:**
- Create: `application/themes/vanguard/blocks/page_list/bento_grid.php`

- [ ] **Step 1: Zbadaj zmienne bloku page_list**

```bash
cat /path/to/concrete-cms/concrete/blocks/page_list/view.php | head -30
```

Zmienne `page_list`:
- `$pages` — tablica obiektów `\Concrete\Core\Page\Page`
- Każda strona: `$page->getCollectionName()`, `$page->getCollectionDescription()`, `$page->getCollectionLink()`, `$page->getCollectionDatePublic()`

- [ ] **Step 2: Utwórz bento_grid.php**

`application/themes/vanguard/blocks/page_list/bento_grid.php`:
```php
<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<?php if (!empty($pages)): ?>
<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <?php foreach ($pages as $index => $page):
        $pageTitle = $page->getCollectionName();
        $pageDesc  = $page->getCollectionDescription();
        $pageLink  = $page->getCollectionLink();
        $isWide    = ($index === 0); // Pierwszy element zajmuje 2 kolumny
        $isAccent  = ($index === 2); // Trzeci element — karta akcentowana
    ?>

    <?php if ($isAccent): ?>
        <div class="vanguard-card--accent p-8 flex flex-col justify-end
                    h-[320px] relative overflow-hidden
                    <?= $isWide ? 'md:col-span-2' : '' ?>">
            <div class="absolute top-0 right-0 p-4 opacity-20">
                <span class="material-symbols-outlined text-8xl"
                      style="font-variation-settings:'FILL' 1">grid_view</span>
            </div>
            <h3 class="font-headline text-xl font-black text-on-primary-container
                       leading-none uppercase mb-2">
                <?= h($pageTitle) ?>
            </h3>
            <?php if ($pageDesc): ?>
            <p class="text-on-primary-container/80 text-xs">
                <?= h($pageDesc) ?>
            </p>
            <?php endif; ?>
            <a href="<?= h($pageLink) ?>"
               class="mt-4 vanguard-btn-ghost text-sm px-4 py-2 self-start">
               VIEW
            </a>
        </div>

    <?php elseif ($isWide): ?>
        <div class="md:col-span-2 group vanguard-card p-8 flex flex-col
                    justify-between h-[320px]">
            <div>
                <div class="flex justify-between items-start mb-6">
                    <span class="material-symbols-outlined text-primary text-4xl">
                        precision_manufacturing
                    </span>
                    <span class="font-label text-[10px] text-on-surface-variant/50">
                        REF_<?= str_pad($index + 1, 2, '0', STR_PAD_LEFT) ?>
                    </span>
                </div>
                <h3 class="font-headline text-2xl font-bold mb-2 uppercase">
                    <?= h($pageTitle) ?>
                </h3>
                <?php if ($pageDesc): ?>
                <p class="text-on-surface-variant text-sm leading-relaxed max-w-sm">
                    <?= h($pageDesc) ?>
                </p>
                <?php endif; ?>
            </div>
            <a href="<?= h($pageLink) ?>"
               class="vanguard-btn-primary text-sm px-4 py-2 self-start">
                VIEW_SPECS
            </a>
        </div>

    <?php else: ?>
        <div class="group vanguard-card--high p-8 flex flex-col
                    justify-between h-[320px]">
            <div>
                <span class="material-symbols-outlined text-tertiary text-4xl mb-6 block">
                    android_fingerprint
                </span>
                <h3 class="font-headline text-xl font-bold mb-2 uppercase">
                    <?= h($pageTitle) ?>
                </h3>
                <?php if ($pageDesc): ?>
                <p class="text-on-surface-variant text-xs leading-relaxed">
                    <?= h($pageDesc) ?>
                </p>
                <?php endif; ?>
            </div>
            <a href="<?= h($pageLink) ?>"
               class="font-label text-xs text-primary uppercase tracking-widest
                      hover:opacity-80 transition-opacity">
                LEARN_MORE →
            </a>
        </div>
    <?php endif; ?>

    <?php endforeach; ?>
</div>
<?php endif; ?>
```

- [ ] **Step 3: Weryfikacja składni**

```bash
php -l application/themes/vanguard/blocks/page_list/bento_grid.php
```

Oczekiwane: `No syntax errors detected`.

- [ ] **Step 4: Commit**

```bash
git add application/themes/vanguard/blocks/page_list/bento_grid.php
git commit -m "feat: add page_list bento_grid block template"
```

---

## Task 13: blocks/feature/data_readout.php — Glassmorphic stat card

**Files:**
- Create: `application/themes/vanguard/blocks/feature/data_readout.php`

- [ ] **Step 1: Zbadaj zmienne bloku feature**

```bash
cat /path/to/concrete-cms/concrete/blocks/feature/controller.php | grep 'public \$'
```

Typowe zmienne bloku `feature`:
- `$title` — tytuł
- `$paragraph` — wartość / opis
- `$icon` — ikona (Material Icons handle)
- `$titleFormat` — format HTML nagłówka

- [ ] **Step 2: Utwórz data_readout.php**

`application/themes/vanguard/blocks/feature/data_readout.php`:
```php
<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<div class="vanguard-card--glass p-6">
    <!-- Nagłówek sekcji -->
    <?php if (!empty($icon) || !empty($title)): ?>
    <div class="flex items-center gap-3 mb-6">
        <?php if (!empty($icon)): ?>
        <span class="material-symbols-outlined text-primary"><?= h($icon) ?></span>
        <?php endif; ?>
        <?php if (!empty($title)): ?>
        <h2 class="font-headline text-lg font-bold tracking-tight uppercase text-on-surface">
            <?= h($title) ?>
        </h2>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <!-- Wartość główna -->
    <?php if (!empty($paragraph)): ?>
    <div class="space-y-4">
        <div class="vanguard-stat__value">
            <?= $paragraph ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Opcjonalny progress bar — aktywny gdy paragraph zawiera liczbę % -->
    <?php
    preg_match('/(\d+(?:\.\d+)?)\s*%/', strip_tags($paragraph ?? ''), $matches);
    $percent = isset($matches[1]) ? floatval($matches[1]) : null;
    ?>
    <?php if ($percent !== null && $percent <= 100): ?>
    <div class="mt-4">
        <div class="flex justify-between mb-2">
            <span class="font-label text-xs text-on-surface-variant uppercase">Level</span>
            <span class="font-headline font-bold text-primary"><?= $percent ?>%</span>
        </div>
        <div class="vanguard-progress">
            <div class="vanguard-progress__fill" style="width: <?= $percent ?>%"></div>
        </div>
    </div>
    <?php endif; ?>
</div>
```

- [ ] **Step 3: Weryfikacja składni**

```bash
php -l application/themes/vanguard/blocks/feature/data_readout.php
```

Oczekiwane: `No syntax errors detected`.

- [ ] **Step 4: Commit**

```bash
git add application/themes/vanguard/blocks/feature/data_readout.php
git commit -m "feat: add feature block data_readout template with glassmorphic card"
```

---

## Task 14: blocks/content/view.php — Typografia Vanguard

**Files:**
- Create: `application/themes/vanguard/blocks/content/view.php`

- [ ] **Step 1: Zbadaj domyślny content view**

```bash
cat /path/to/concrete-cms/concrete/blocks/content/view.php
```

Blok `content` udostępnia zmienną `$content` — surowy HTML z edytora WYSIWYG.

- [ ] **Step 2: Utwórz view.php dla content**

`application/themes/vanguard/blocks/content/view.php`:
```php
<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<div class="vanguard-content prose-vanguard">
    <?= $content ?>
</div>
```

Dopisz do `css/src/main.css` w sekcji `@layer components`:
```css
/* Dodaj w @layer components po istniejących klasach */
.vanguard-content h1,
.vanguard-content h2,
.vanguard-content h3,
.vanguard-content h4 {
  @apply font-headline tracking-tighter text-on-surface;
}

.vanguard-content h1 { @apply text-5xl font-bold mb-6; }
.vanguard-content h2 { @apply text-4xl font-bold uppercase mb-4 mt-12; }
.vanguard-content h3 { @apply text-2xl font-bold mb-3 mt-8; }
.vanguard-content h4 { @apply vanguard-label mb-2 mt-6; }

.vanguard-content p {
  @apply font-body text-on-surface-variant leading-relaxed mb-4;
}

.vanguard-content a {
  @apply text-primary hover:text-primary-fixed underline transition-colors duration-150;
}

.vanguard-content ul,
.vanguard-content ol {
  @apply font-body text-on-surface-variant leading-relaxed mb-4 pl-6;
}

.vanguard-content li { @apply mb-2; }

.vanguard-content blockquote {
  @apply border-l-2 border-primary/40 pl-6 italic text-on-surface-variant my-8;
}

.vanguard-content strong { @apply text-on-surface font-bold; }

.vanguard-content img {
  @apply rounded-xl w-full my-8;
  box-shadow: 0 0 50px rgba(182, 208, 136, 0.10);
}
```

- [ ] **Step 3: Przebuduj CSS**

```bash
cd application/themes/vanguard/css/src
npm run build
```

Oczekiwane: `vanguard.css` zaktualizowany.

- [ ] **Step 4: Commit**

```bash
git add application/themes/vanguard/blocks/content/view.php application/themes/vanguard/css/src/main.css application/themes/vanguard/css/vanguard.css
git commit -m "feat: add content block template with Vanguard typography system"
```

---

## Task 15: blocks/image/tactical.php — Glass caption + primary glow

**Files:**
- Create: `application/themes/vanguard/blocks/image/tactical.php`

- [ ] **Step 1: Zbadaj zmienne bloku image**

```bash
cat /path/to/concrete-cms/concrete/blocks/image/controller.php | grep 'public \$'
```

Zmienne bloku `image`:
- `$f` — obiekt File
- `$altText` — alt text
- `$title` — tytuł (opcjonalnie caption)
- `$linkURL` — URL link (opcjonalnie)

- [ ] **Step 2: Utwórz tactical.php**

`application/themes/vanguard/blocks/image/tactical.php`:
```php
<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<?php if (isset($f) && is_object($f)): ?>
<figure class="relative rounded-xl overflow-hidden group">

    <!-- Obraz z primary glow -->
    <?php
    $imgUrl = $f->getURL();
    $imgAlt = !empty($altText) ? $altText : ($f->getTitle() ?? '');
    ?>
    <img src="<?= h($imgUrl) ?>"
         alt="<?= h($imgAlt) ?>"
         class="w-full h-auto object-cover
                transition-transform duration-300 group-hover:scale-[1.02]
                drop-shadow-[0_0_30px_rgba(182,208,136,0.15)]">

    <!-- Glassmorphic caption overlay -->
    <?php if (!empty($title)): ?>
    <figcaption class="absolute bottom-0 left-0 right-0 p-4 glass-panel
                       border-t border-white/10">
        <span class="font-label text-xs text-on-surface-variant uppercase tracking-widest">
            <?= h($title) ?>
        </span>
    </figcaption>
    <?php endif; ?>

    <!-- Dekoracyjna ramka HUD -->
    <div class="absolute inset-0 border-[16px] border-transparent pointer-events-none">
        <div class="w-full h-full border border-primary/10"></div>
    </div>

</figure>
<?php endif; ?>
```

- [ ] **Step 3: Weryfikacja składni**

```bash
php -l application/themes/vanguard/blocks/image/tactical.php
```

Oczekiwane: `No syntax errors detected`.

- [ ] **Step 4: Commit**

```bash
git add application/themes/vanguard/blocks/image/tactical.php
git commit -m "feat: add image block tactical template with glass caption and glow"
```

---

## Task 16: blocks/form/view.php — Bottom-border inputs + tactical CTA

**Files:**
- Create: `application/themes/vanguard/blocks/form/view.php`

- [ ] **Step 1: Skopiuj domyślny view.php bloku form jako punkt startowy**

```bash
cp /path/to/concrete-cms/concrete/blocks/form/view.php \
   application/themes/vanguard/blocks/form/view.php
```

- [ ] **Step 2: Zastąp klasy CSS w skopiowanym view.php**

Znajdź i zastąp klasy form w `application/themes/vanguard/blocks/form/view.php`:

Znajdź wzorce CSS Bootstrap/default i zastąp:
- `class="form-control"` → `class="vanguard-input"`
- `class="form-group"` → `class="mb-6"`
- `class="control-label"` lub `class="form-label"` → `class="vanguard-label block mb-2"`
- `class="btn btn-primary"` lub przycisk submit → `class="vanguard-btn-cta"`
- `class="btn btn-default"` lub reset → `class="vanguard-btn-ghost"`

Wykonaj zamiany w pliku:
```bash
sed -i 's/class="form-control"/class="vanguard-input"/g' \
    application/themes/vanguard/blocks/form/view.php
sed -i 's/class="form-group"/class="mb-6"/g' \
    application/themes/vanguard/blocks/form/view.php
sed -i 's/class="form-label\|control-label"/class="vanguard-label block mb-2"/g' \
    application/themes/vanguard/blocks/form/view.php
```

> **Ważne:** Po wykonaniu sed, otwórz plik i ręcznie sprawdź czy przycisk submit ma klasę `vanguard-btn-cta`. Plik formularza jest złożony — sprawdź wizualnie w przeglądarce po instalacji theme'u.

- [ ] **Step 3: Weryfikacja składni**

```bash
php -l application/themes/vanguard/blocks/form/view.php
```

Oczekiwane: `No syntax errors detected`.

- [ ] **Step 4: Commit**

```bash
git add application/themes/vanguard/blocks/form/view.php
git commit -m "feat: add form block template with Vanguard input and CTA styling"
```

---

## Task 17: js/vanguard.js — Mobile nav + micro-interactions

**Files:**
- Create: `application/themes/vanguard/js/vanguard.js`

- [ ] **Step 1: Utwórz vanguard.js**

`application/themes/vanguard/js/vanguard.js`:
```js
(function () {
  'use strict';

  // ── Mobile nav toggle ───────────────────────────
  const hamburger = document.getElementById('nav-hamburger');
  const mobileMenu = document.getElementById('nav-mobile');

  if (hamburger && mobileMenu) {
    hamburger.addEventListener('click', function () {
      const isOpen = mobileMenu.classList.contains('flex');
      mobileMenu.classList.toggle('hidden', isOpen);
      mobileMenu.classList.toggle('flex', !isOpen);
      hamburger.setAttribute('aria-expanded', String(!isOpen));
    });
  }

  // ── Nav scroll behavior ─────────────────────────
  const nav = document.getElementById('vanguard-nav');

  if (nav) {
    function updateNavShadow() {
      if (window.scrollY > 10) {
        nav.style.boxShadow = '0 8px 32px 0 rgba(18, 20, 16, 0.20)';
      } else {
        nav.style.boxShadow = '0 32px 64px -15px rgba(18, 20, 16, 0.06)';
      }
    }
    window.addEventListener('scroll', updateNavShadow, { passive: true });
    updateNavShadow();
  }

  // ── Active nav link detection ───────────────────
  const currentPath = window.location.pathname;
  document.querySelectorAll('.vanguard-nav__link').forEach(function (link) {
    const href = link.getAttribute('href');
    if (href && href !== '/' && currentPath.startsWith(href)) {
      link.classList.add('vanguard-nav__link--active');
    } else if (href === '/' && currentPath === '/') {
      link.classList.add('vanguard-nav__link--active');
    }
  });

  // ── Close mobile menu on outside click ─────────
  document.addEventListener('click', function (e) {
    if (mobileMenu && hamburger) {
      if (!mobileMenu.contains(e.target) && !hamburger.contains(e.target)) {
        mobileMenu.classList.add('hidden');
        mobileMenu.classList.remove('flex');
        hamburger.setAttribute('aria-expanded', 'false');
      }
    }
  });

})();
```

- [ ] **Step 2: Weryfikacja składni JS**

```bash
node --check application/themes/vanguard/js/vanguard.js
```

Oczekiwane: brak outputu (brak błędów).

- [ ] **Step 3: Commit**

```bash
git add application/themes/vanguard/js/vanguard.js
git commit -m "feat: add vanguard.js with mobile nav, scroll behavior, active links"
```

---

## Task 18: Finalny build CSS + instalacja w CCMS

**Files:**
- Modify: `application/themes/vanguard/css/vanguard.css` (rebuild)

- [ ] **Step 1: Finalny build produkcyjny**

Tailwind CLI skanuje PHP pliki i uwzględnia tylko użyte klasy:
```bash
cd application/themes/vanguard/css/src
npm run build
```

Oczekiwane: `vanguard.css` ~30-80KB (minified). Jeśli < 5KB, sprawdź czy `content` w `tailwind.config.js` poprawnie wskazuje na PHP pliki.

- [ ] **Step 2: Zainstaluj theme w CCMS**

1. Panel administracyjny → **Pages & Themes → Themes**
2. Kliknij **Install** przy motywie "Vanguard"
3. Kliknij **Activate** (lub ustaw dla konkretnej strony)

Oczekiwane: theme widoczny w liście z nazwą "Vanguard".

- [ ] **Step 3: Ustaw typy stron**

1. Panel → **Pages & Themes → Page Types**
2. Upewnij się że typy: Home, Product, Full Width, Single Post, Contact są dostępne
3. Edytuj stronę główną → Attributes → Page Template → wybierz "Home"

- [ ] **Step 4: Utwórz Global Areas**

Panel → **Stacks & Global Areas** → utwórz:
- `Nav Bar` — dodaj blok `autonav`
- `Footer Nav 1` — dodaj linki (blok `content` z listą `<ul>`)
- `Footer Nav 2` — j.w.

- [ ] **Step 5: Weryfikacja wizualna**

Sprawdź w przeglądarce:
- [ ] Nav ma efekt glassmorphism (blur na tle)
- [ ] Tło strony `#121410` (nie białe, nie czarne)
- [ ] Fonty Space Grotesk i Inter załadowane
- [ ] Brak 1px granic jako separatorów sekcji
- [ ] Przyciski mają gradient i efekt `scale-[0.98]` przy kliknięciu
- [ ] Panel edycji CCMS nie koliduje z nawigacją

- [ ] **Step 6: Commit finalny**

```bash
git add application/themes/vanguard/css/vanguard.css
git commit -m "feat: production build of Vanguard CSS — theme ready for CCMS installation"
```

---

## Checklist coverage vs spec

| Wymaganie ze spec | Task |
|---|---|
| description.xml + PageTheme.php | Task 2 |
| tailwind.config.js — pełne tokeny | Task 3 |
| Klasy .vanguard-* | Task 4 |
| header.php glassmorphic nav | Task 5 |
| footer.php 4-col | Task 6 |
| home.php Hero + Bento + Main areas | Task 7 |
| product.php 12-col | Task 8 |
| full_width / single / contact | Task 9 |
| autonav template | Task 10 |
| hero_image template z HUD | Task 11 |
| page_list bento_grid | Task 12 |
| feature data_readout | Task 13 |
| content typografia | Task 14 |
| image tactical + glass caption | Task 15 |
| form bottom-border inputs | Task 16 |
| vanguard.js micro-interactions | Task 17 |
| CCMS instalacja + Global Areas | Task 18 |
