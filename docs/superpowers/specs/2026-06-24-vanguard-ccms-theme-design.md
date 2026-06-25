# Vanguard CCMS Theme — Design Spec
**Data:** 2026-06-24  
**Wersja CCMS:** Concrete CMS 9.x  
**Środowisko:** VPS (pełny SSH, Composer, Node.js)

---

## 1. Cel i zakres

Stworzenie profesjonalnego theme'u dla Concrete CMS 9.x opartego na design systemie **"The Digital Vanguard"** (ref: `ref-vanguard/DESIGN.md`, `code.html`, `code2.html`).

**Dwa cele:**
- Dedykowany brand Vanguard Tactical (olive/sand/orange palette, glassmorphism, tactical aesthetic)
- Architektura wielokrotnego użytku: tokeny kolorów i komponenty CSS konfigurowalne per-projekt

**Typy stron (page_themes):**
- `home.php` — Landing / Hero + Bento Grid
- `product.php` — Specs / 12-kolumnowy layout techniczny
- `full_width.php` — Ogólna strona z areas bloków
- `single.php` — Artykuł / long-form content
- `contact.php` — Formularz kontaktowy

---

## 2. Architektura: Theme-Only z Block Template Overrides

Wybrany wariant **A**: jeden pakiet `themes/vanguard/`, zero dodatkowych custom bloków PHP. Cały design osiągany przez:
1. PHP layouts (page_themes) z named Areas
2. Block template overrides w `themes/vanguard/blocks/`
3. Skompilowany Tailwind CSS + semantyczne klasy komponentów

### Struktura plików

```
themes/vanguard/
├── description.xml              ← rejestracja theme'u
├── thumbnail.png
├── page_themes/
│   ├── home.php                 ← Hero + Bento Grid areas
│   ├── product.php              ← 12-col Specs layout
│   ├── full_width.php           ← ogólna strona
│   ├── single.php               ← artykuł
│   └── contact.php              ← formularz
├── elements/
│   ├── header.php               ← TopNavBar (glass, fixed, z-50)
│   └── footer.php               ← Footer 4-col
├── blocks/
│   ├── autonav/view.php         ← tactical nav links
│   ├── hero_image/view.php      ← radial gradient, HUD overlays
│   ├── page_list/
│   │   └── bento_grid.php       ← 4-col bento cards
│   ├── feature/
│   │   └── data_readout.php     ← stat card glassmorphic
│   ├── content/view.php         ← typografia Vanguard
│   ├── image/tactical.php       ← glass caption, primary glow
│   └── form/view.php            ← bottom-border inputs
├── css/
│   ├── vanguard.css             ← skompilowany output
│   └── src/
│       ├── main.css             ← @layer base/components/utilities
│       └── tailwind.config.js   ← tokeny z DESIGN.md
└── js/
    └── vanguard.js              ← micro-interactions, mobile nav
```

---

## 3. CSS Architecture

### Strategia: Tailwind CLI + CSS Components (Hybryda C)

Tailwind CLI kompiluje `src/main.css` → `vanguard.css`. Klasy semantyczne zdefiniowane w `@layer components` pozwalają na czytelne template overrides bez powtarzania długich łańcuchów Tailwind.

### Tokeny (tailwind.config.js) — z DESIGN.md

```js
colors: {
  // Surfaces
  "surface":                    "#121410",
  "surface-dim":                "#121410",
  "surface-bright":             "#383a35",
  "surface-container-lowest":   "#0d0f0b",
  "surface-container-low":      "#1a1c18",
  "surface-container":          "#1e201c",
  "surface-container-high":     "#292b26",
  "surface-container-highest":  "#333531",
  "surface-variant":            "#333531",
  "surface-tint":               "#b6d088",
  // Primary (Olive)
  "primary":                    "#b6d088",
  "primary-fixed":              "#d2eca2",
  "primary-fixed-dim":          "#b6d088",
  "primary-container":          "#556b2f",
  "on-primary":                 "#233600",
  "on-primary-fixed":           "#131f00",
  "on-primary-fixed-variant":   "#394d14",
  "on-primary-container":       "#d0eba1",
  "inverse-primary":            "#50652a",
  // Secondary (Sand)
  "secondary":                  "#d6c692",
  "secondary-fixed":            "#f3e2ac",
  "secondary-fixed-dim":        "#d6c692",
  "secondary-container":        "#544820",
  "on-secondary":               "#3a3009",
  "on-secondary-fixed":         "#231b00",
  "on-secondary-fixed-variant": "#51461e",
  "on-secondary-container":     "#c8b885",
  // Tertiary (Orange accent)
  "tertiary":                   "#ffb77d",
  "tertiary-fixed":             "#ffdcc3",
  "tertiary-fixed-dim":         "#ffb77d",
  "tertiary-container":         "#985100",
  "on-tertiary":                "#4d2600",
  "on-tertiary-fixed":          "#2f1500",
  "on-tertiary-fixed-variant":  "#6e3900",
  "on-tertiary-container":      "#ffd9be",
  // Text / On colors
  "on-surface":                 "#e3e3dc",
  "on-surface-variant":         "#c5c8b8",
  "on-background":              "#e3e3dc",
  "inverse-surface":            "#e3e3dc",
  "inverse-on-surface":         "#2f312d",
  // Outlines
  "outline":                    "#8f9284",
  "outline-variant":            "#45483c",
  // Error
  "error":                      "#ffb4ab",
  "error-container":            "#93000a",
  "on-error":                   "#690005",
  "on-error-container":         "#ffdad6",
  // Background
  "background":                 "#121410",
},
fontFamily: {
  "headline": ["Space Grotesk"],
  "body":     ["Inter"],
  "label":    ["Space Grotesk"],
},
borderRadius: {
  "DEFAULT": "0.125rem",
  "lg":      "0.25rem",
  "xl":      "0.5rem",
  "full":    "0.75rem",
}
```

### Klasy semantyczne (@layer components)

| Klasa | Zastosowanie |
|---|---|
| `.vanguard-nav` | TopNavBar: glass-panel, fixed, z-50, border-b white/10 |
| `.vanguard-hero` | Hero section: min-h-[921px], radial gradient bg |
| `.vanguard-card` | Karta: bg-surface-container, rounded-xl, hover:border-primary/30 |
| `.vanguard-card--glass` | Karta glassmorphic: rgba(51,53,49,0.6) + blur(12px) |
| `.vanguard-btn-primary` | CTA olive: gradient primary→primary-container, text-on-primary, active:scale-[0.98] |
| `.vanguard-btn-cta` | CTA orange: gradient tertiary→tertiary-container, text-on-tertiary, active:scale-[0.98] |
| `.vanguard-btn-ghost` | Ghost: border outline-variant/30, hover:bg-white/5 |
| `.vanguard-input` | Input: brak górnych/bocznych ramek, 2px bottom stroke |
| `.vanguard-chip` | Status chip: surface-container-highest, ikona 3×3px |
| `.vanguard-stat` | Data readout: label-sm + headline-md, glass wrap |
| `.vanguard-label` | Etykieta: font-label uppercase tracking-widest text-xs text-tertiary |

### Zasady z DESIGN.md (hard rules w CSS)

- **No-Line Rule:** brak `border` do separacji — tylko tonal shift tła
- **Ghost Border:** jeśli wymagany: `1px solid outline-variant` at `15% opacity`
- **Glass Formula:** `surface_variant` 60% opacity + `backdrop-filter: blur(12px)`
- **Button depth:** linear gradient primary → primary-container
- **No pure black:** zawsze `#121410` (surface) zamiast `#000`
- **Animations:** max 150ms, `linear` easing ("Snap") — `transition-all duration-150`

---

## 4. Named Areas per Page Type

### home.php
| Area | Przeznaczenie | Domyślne bloki |
|---|---|---|
| `Hero` | Pełnoekranowy hero | hero_image |
| `Bento Grid` | Siatka kart produktowych | page_list (bento_grid template) |
| `Main` | Treść ogólna | content, image, feature |

### product.php (12-col grid)
| Area | Kolumny | Przeznaczenie |
|---|---|---|
| `Specs Left` | 5/12 | feature blocks (Performance, Dimensions) |
| `Visual Main` | 7/12 | image (3D render), content, feature |
| `Actions` | full | content z przyciskami CTA |

### contact.php
| Area | Przeznaczenie |
|---|---|
| `Contact Header` | content: headline + opis |
| `Form` | form block |

### full_width.php / single.php
- Jeden Area `Main` (max-w-7xl mx-auto, spacing-16 padding)

---

## 5. Block Template Overrides — szczegóły

### hero_image/view.php
- Tło: `radial-gradient(circle at 70% 50%, rgba(85,107,47,0.15), rgba(18,20,16,1) 70%)`
- Grid: `md:grid-cols-12`, tekst na 6 kolumnach, obraz na 6
- Badge: `bg-primary-container/30 border border-primary/20 rounded-lg` z pulsującą kropką
- HUD overlay: `.vanguard-card--glass` pozycjonowany absolutnie nad obrazem
- Asymetryczne kółka dekoracyjne: `border border-primary/5 rounded-full rotate-12`

### autonav/view.php
- Linki: `font-label uppercase tracking-widest text-sm text-on-surface-variant hover:text-on-surface`
- Aktywny link: `text-primary border-b-2 border-primary`
- Przejście: `transition-colors duration-150`

### hero_image/view.php
- Tło: `radial-gradient(circle at 70% 50%, rgba(85,107,47,0.15), rgba(18,20,16,1) 70%)`
- Grid: `md:grid-cols-12`, tekst na 6 kolumnach, obraz na 6
- Badge: `bg-primary-container/30 border border-primary/20 rounded-lg` z pulsującą kropką
- HUD overlay: `.vanguard-card--glass` pozycjonowany absolutnie nad obrazem
- Asymetryczne kółka dekoracyjne: `border border-primary/5 rounded-full rotate-12`

### page_list/bento_grid.php
- Kontener: `grid grid-cols-1 md:grid-cols-4 gap-6`
- Karty alternują między `.vanguard-card` (surface-container) a `.vanguard-card` (surface-container-highest)
- Karta wyróżniona (span 2): `md:col-span-2`
- Karta akcentowana: `bg-primary-container` bez ramki

### feature/data_readout.php
- Wrapper: `.vanguard-card--glass border border-outline-variant/15`
- Tytuł: `.vanguard-label`
- Wartość: `font-headline text-2xl font-bold`
- Opcjonalny progress bar: `h-1 bg-surface-container-highest rounded-full overflow-hidden`

### form/view.php
- `label`: `.vanguard-label`
- `input`, `textarea`, `select`: `.vanguard-input`
- Submit: `.vanguard-btn-primary`

---

## 6. JavaScript (vanguard.js)

Minimalistyczny skrypt bez frameworka:
- **Mobile nav toggle:** hamburger → slide-in menu
- **Active nav detection:** `window.location.pathname` → dodaje klasę `active` do linku
- **Micro-interactions:** `active:scale-[0.98]` już w CSS; JS opcjonalnie dla hover glow
- **Scroll behavior:** `position: fixed` nav z shadow po przewinięciu > 10px

---

## 7. Wymagania zewnętrzne

- **Google Fonts:** Space Grotesk, Inter (załadowane w header.php)
- **Material Symbols Outlined:** ikony (załadowane w header.php)
- **Node.js + Tailwind CLI:** do kompilacji CSS (dev/build, nie runtime)
- **CCMS 9.x:** bloki: autonav, hero_image, page_list, feature, content, image, form

---

## 8. Reguły designu (summary z DESIGN.md)

- **Typografia:** Space Grotesk dla nagłówków i etykiet, Inter dla treści
- **Asymetria:** duże metryki po lewej, kontrole po prawej
- **Breathing room:** `spacing-16` / `spacing-20` dla paddingu sekcji
- **Tonal stacking:** Base → Section → Component (surface → surface-container-low → surface-container-highest)
- **Zakaz:** czysty czarny, obramowania 100% opacity, animacje > 150ms
