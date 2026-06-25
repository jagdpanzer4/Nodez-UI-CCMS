---
name: Luminous Tech
colors:
  surface: '#131412'
  surface-dim: '#131412'
  surface-bright: '#393937'
  surface-container-lowest: '#0d0e0c'
  surface-container-low: '#1b1c1a'
  surface-container: '#1f201e'
  surface-container-high: '#292a28'
  surface-container-highest: '#343532'
  on-surface: '#e4e2de'
  on-surface-variant: '#c4c9ac'
  inverse-surface: '#e4e2de'
  inverse-on-surface: '#30312e'
  outline: '#8e9379'
  outline-variant: '#444933'
  surface-tint: '#abd600'
  primary: '#ffffff'
  on-primary: '#283500'
  primary-container: '#c3f400'
  on-primary-container: '#556d00'
  inverse-primary: '#506600'
  secondary: '#c6c7c0'
  on-secondary: '#2f312d'
  secondary-container: '#484a45'
  on-secondary-container: '#b8b9b2'
  tertiary: '#ffffff'
  on-tertiary: '#2e322a'
  tertiary-container: '#e1e4d8'
  on-tertiary-container: '#62665c'
  error: '#ffb4ab'
  on-error: '#690005'
  error-container: '#93000a'
  on-error-container: '#ffdad6'
  primary-fixed: '#c3f400'
  primary-fixed-dim: '#abd600'
  on-primary-fixed: '#161e00'
  on-primary-fixed-variant: '#3c4d00'
  secondary-fixed: '#e3e3dc'
  secondary-fixed-dim: '#c6c7c0'
  on-secondary-fixed: '#1a1c18'
  on-secondary-fixed-variant: '#464743'
  tertiary-fixed: '#e1e4d8'
  tertiary-fixed-dim: '#c4c8bc'
  on-tertiary-fixed: '#191d16'
  on-tertiary-fixed-variant: '#44483f'
  background: '#131412'
  on-background: '#e4e2de'
  surface-variant: '#343532'
typography:
  display-lg:
    fontFamily: Raleway
    fontSize: 64px
    fontWeight: '200'
    lineHeight: '1.1'
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Raleway
    fontSize: 40px
    fontWeight: '300'
    lineHeight: '1.2'
    letterSpacing: -0.01em
  headline-lg-mobile:
    fontFamily: Raleway
    fontSize: 32px
    fontWeight: '300'
    lineHeight: '1.2'
  headline-md:
    fontFamily: Raleway
    fontSize: 24px
    fontWeight: '400'
    lineHeight: '1.3'
  body-lg:
    fontFamily: Geist
    fontSize: 18px
    fontWeight: '300'
    lineHeight: '1.6'
  body-md:
    fontFamily: Geist
    fontSize: 16px
    fontWeight: '400'
    lineHeight: '1.6'
  label-md:
    fontFamily: JetBrains Mono
    fontSize: 14px
    fontWeight: '500'
    lineHeight: '1.0'
    letterSpacing: 0.05em
  label-sm:
    fontFamily: JetBrains Mono
    fontSize: 12px
    fontWeight: '500'
    lineHeight: '1.0'
rounded:
  sm: 0.125rem
  DEFAULT: 0.25rem
  md: 0.375rem
  lg: 0.5rem
  xl: 0.75rem
  full: 9999px
spacing:
  base: 8px
  xs: 4px
  sm: 12px
  md: 24px
  lg: 48px
  xl: 80px
  gutter: 24px
  margin: 32px
  max-width: 1280px
---

## Brand & Style

This design system is built for high-performance technology platforms and CMS-driven interfaces that require a distinct, "always-on" digital presence. The brand personality is aggressive yet sophisticated, blending the raw energy of high-contrast neon with the refined precision of modern minimalism. 

The aesthetic is a hybrid of **Glassmorphism** and **High-Contrast Modernism**. It leverages deep, light-absorbing foundations to make translucent surfaces and vibrant accents feel as though they are emitting light. The UI should evoke a sense of technical mastery, speed, and premium craftsmanship. It is designed to stand out in a market of safe, corporate "SaaS-blue" interfaces by leaning into a futuristic, developer-adjacent aesthetic.

## Colors

The palette is optimized for a dark-mode-first experience. 

*   **Primary (Volt):** `#CCFF00`. A high-visibility, neon-style green used for critical actions, active states, and focus indicators.
*   **Secondary (Muted Moss):** `#1A1C18`. Used for surface areas where glassmorphism isn't appropriate, providing a subtle green-tinted depth.
*   **Tertiary (Deep Olive):** `#2F332B`. Used for borders and secondary text elements.
*   **Neutral (Void):** `#0D0E0C`. The base background color, providing maximum contrast for the neon accents.

Gradients should be used sparingly, primarily as subtle "inner glows" on glass surfaces or as blurred background orbs behind content cards to create depth.

## Typography

The typography strategy prioritizes a tech-forward, editorial look. 

**Raleway** is used for headlines, specifically utilizing its thinner weights (200-400) to create an elegant, spacious feel that balances the intensity of the neon colors.

**Geist** provides a clean, neutral, and highly legible body font that feels "engineered," fitting the CMS/SaaS context perfectly.

**JetBrains Mono** is reserved for labels, metadata, and technical readouts. This monospaced touch reinforces the technical nature of the design system and ensures that numerical data is perfectly aligned.

## Layout & Spacing

This design system utilizes a **12-column fluid grid** for desktop and a **4-column grid** for mobile. The layout philosophy is rooted in "Air and Alignment."

*   **Vertical Rhythm:** Built on an 8px base unit. All component heights and margins should be multiples of 8.
*   **Margins:** Generous side margins (32px on desktop, 16px on mobile) ensure the high-contrast elements have room to breathe.
*   **The "Glass Container":** Content is grouped into translucent modules. Layouts should favor stacking these modules with consistent `md` (24px) spacing between them.
*   **Alignment:** Strong left-alignment for all text. The monospaced labels should align strictly to the grid to create a sense of structural integrity.

## Elevation & Depth

Depth is achieved through layering and optical effects rather than traditional shadows.

1.  **Level 0 (Base):** The #0D0E0C background. No depth.
2.  **Level 1 (Surface):** Glassmorphic containers. Background blur set to `20px` to `40px` with a semi-transparent fill (`#ffffff05`). 
3.  **Level 2 (Active):** High-contrast borders. A 1px border using `#CCFF00` at 20% opacity. 
4.  **Interactive Glow:** On hover, elements should emit a subtle radial gradient glow of the primary color (#CCFF00) behind the element with a large blur radius (60px+) at very low opacity (5-10%).

Avoid drop shadows. Use **inner glows** and **backdrop filters** to define object boundaries.

## Shapes

The shape language is "Technical-Soft." By using `Soft (0.25rem)` roundedness, we avoid the aggressive nature of 90-degree corners while maintaining a professional, structured appearance.

*   **Components:** Buttons and input fields use the base `rounded` (0.25rem).
*   **Containers:** Cards and modals use `rounded-lg` (0.5rem) to differentiate them from smaller interface elements.
*   **Indicators:** Small decorative elements (chips, status dots) can use `rounded-xl` (0.75rem) to appear more organic against the rigid grid.

## Components

### Buttons
*   **Primary:** Solid `#CCFF00` background with `#0D0E0C` text. No border. Bold and high-impact.
*   **Ghost:** Transparent background with a 1px `#CCFF00` border at 40% opacity. Text in `#CCFF00`.
*   **Glass:** Translucent grey background with backdrop blur. Used for secondary actions.

### Input Fields
*   **Style:** Dark background (`#1A1C18`) with a subtle bottom-border only, or a very thin 1px all-around border in `#2F332B`.
*   **Focus State:** The border transitions to solid `#CCFF00` with a 2px outer glow.

### Cards & CMS Modules
*   **Glass Card:** Use the glassmorphism elevation rules. Headlines inside cards should use `Raleway Light`. 
*   **Inner Padding:** Use `md` (24px) padding consistently for all card containers.

### Chips & Tags
*   **Technical Tags:** Use `JetBrains Mono` at `label-sm`. Background should be a dark green tint (`#CCFF00` at 10% opacity) with a solid 1px border.

### Status Indicators
*   **Active/Live:** Pulsing dot of `#CCFF00` with a blurred glow effect.
*   **Inactive:** Muted Deep Olive (`#2F332B`).