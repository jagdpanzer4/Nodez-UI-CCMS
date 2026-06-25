---
name: Luminescent Tech
colors:
  surface: '#111318'
  surface-dim: '#111318'
  surface-bright: '#37393e'
  surface-container-lowest: '#0c0e12'
  surface-container-low: '#1a1c20'
  surface-container: '#1e2024'
  surface-container-high: '#282a2e'
  surface-container-highest: '#333539'
  on-surface: '#e2e2e8'
  on-surface-variant: '#b9cacb'
  inverse-surface: '#e2e2e8'
  inverse-on-surface: '#2f3035'
  outline: '#849495'
  outline-variant: '#3b494b'
  surface-tint: '#00dbe9'
  primary: '#dbfcff'
  on-primary: '#00363a'
  primary-container: '#00f0ff'
  on-primary-container: '#006970'
  inverse-primary: '#006970'
  secondary: '#d1bcff'
  on-secondary: '#3c0090'
  secondary-container: '#7000ff'
  on-secondary-container: '#ddcdff'
  tertiary: '#f7f5ff'
  on-tertiary: '#00169c'
  tertiary-container: '#d4d7ff'
  on-tertiary-container: '#2741ff'
  error: '#ffb4ab'
  on-error: '#690005'
  error-container: '#93000a'
  on-error-container: '#ffdad6'
  primary-fixed: '#7df4ff'
  primary-fixed-dim: '#00dbe9'
  on-primary-fixed: '#002022'
  on-primary-fixed-variant: '#004f54'
  secondary-fixed: '#e9ddff'
  secondary-fixed-dim: '#d1bcff'
  on-secondary-fixed: '#23005b'
  on-secondary-fixed-variant: '#5700c9'
  tertiary-fixed: '#dfe0ff'
  tertiary-fixed-dim: '#bcc2ff'
  on-tertiary-fixed: '#000a63'
  on-tertiary-fixed-variant: '#0023d9'
  background: '#111318'
  on-background: '#e2e2e8'
  surface-variant: '#333539'
typography:
  headline-xl:
    fontFamily: Sora
    fontSize: 48px
    fontWeight: '700'
    lineHeight: 56px
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Sora
    fontSize: 32px
    fontWeight: '600'
    lineHeight: 40px
    letterSpacing: -0.01em
  headline-md:
    fontFamily: Sora
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
  body-lg:
    fontFamily: Geist
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-md:
    fontFamily: Geist
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  label-md:
    fontFamily: Geist
    fontSize: 14px
    fontWeight: '500'
    lineHeight: 20px
    letterSpacing: 0.02em
  label-sm:
    fontFamily: Geist
    fontSize: 12px
    fontWeight: '600'
    lineHeight: 16px
    letterSpacing: 0.05em
  headline-lg-mobile:
    fontFamily: Sora
    fontSize: 28px
    fontWeight: '600'
    lineHeight: 36px
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  base: 8px
  xs: 4px
  sm: 12px
  md: 24px
  lg: 48px
  xl: 80px
  gutter: 24px
  margin-mobile: 16px
  margin-desktop: 64px
---

## Brand & Style

The design system is anchored in a high-fidelity, futuristic aesthetic that prioritizes clarity, depth, and energy. It is designed for high-performance interfaces where data density and visual impact must coexist. 

The style is a refined evolution of **Glassmorphism**, utilizing multi-layered translucency and background saturation to create a sense of physical space within a digital environment. By combining this with **High-Contrast** elements and a dark-first color theory, the interface achieves a "cyber-luminescent" quality. Every interaction should feel like operating a sophisticated piece of optical hardware—precise, responsive, and light-emitting.

## Colors

The palette is centered around a vibrant, high-energy Cyan primary, serving as the "light source" for the entire interface. This color is reserved for primary actions, active states, and critical information highlights. 

To maintain depth, the background uses a Deep Navy-Black neutral. Surface containers utilize varying levels of opacity rather than solid hex codes to achieve the glass effect. Secondary accents of deep violet and cobalt are used sparingly to provide tonal variety in complex data visualizations without distracting from the primary cyan calls to action.

## Typography

Typography in this design system balances geometric character with technical precision. **Sora** is utilized for headlines to provide a bold, futuristic presence with its wide apertures and unique geometric shapes. 

For functional text and body copy, **Geist** provides a highly legible, monospaced-adjacent feel that reinforces the technical nature of the product. Information hierarchy is strictly enforced through weight variance and subtle letter-spacing adjustments on labels to ensure readability against translucent, blurred backgrounds.

## Layout & Spacing

The design system employs a **Fluid Grid** model with a 12-column structure for desktop and a 4-column structure for mobile. The spacing rhythm is based on an 8px baseline, ensuring all elements align to a predictable vertical and horizontal cadence.

Layouts should prioritize generous inner padding within "glass" containers (usually 24px or 32px) to allow the background blurs to feel atmospheric rather than cramped. Elements should be grouped into logical functional blocks with significant "void" space between major sections to prevent visual fatigue in dark mode.

## Elevation & Depth

Depth is the defining characteristic of this design system. Instead of traditional drop shadows, depth is communicated through:

1.  **Backdrop Blurs:** Surface containers use a 20px to 40px Gaussian blur on the background layer, with a 10% to 15% white or cyan tint.
2.  **Inner Glows:** Elements at higher elevations feature a 1px semi-transparent white top-and-left border to simulate a light source catching the edge of the glass.
3.  **Luminescent Shadows:** Primary buttons do not use black shadows; instead, they use a soft, diffused cyan outer glow (`box-shadow: 0 0 20px rgba(0, 240, 255, 0.3)`) to suggest they are emitting light.

## Shapes

The shape language is "Soft-Tech." While the grid is rigid and professional, the UI elements utilize a **Rounded (0.5rem)** base to make the glass panels feel premium and modern. 

- **Cards/Panels:** Use `rounded-lg` (1rem) to create a soft container for complex data.
- **Buttons/Inputs:** Use the base `rounded` (0.5rem) for a crisp, functional feel.
- **Tags/Status Indicators:** Use `rounded-xl` or pill-shapes to distinguish them from interactive buttons.

## Components

### Buttons
Primary buttons are solid Cyan with black text for maximum contrast. They feature a subtle outer glow. Secondary buttons use a "ghost" style: a 1px Cyan border with a 5% Cyan fill that intensifies on hover.

### Cards
Cards are the primary expression of glassmorphism. They must have a `backdrop-filter: blur(24px)`, a 1px stroke (white at 10% opacity), and a background color of `rgba(255, 255, 255, 0.03)`.

### Input Fields
Inputs are dark and recessed. They use a 1px border that turns bright Cyan upon focus, accompanied by a subtle inner glow to indicate activity.

### Chips & Badges
Chips use the secondary violet or tertiary blue colors at 20% opacity with solid-colored text to provide categorization without competing with the primary action buttons.

### Interactive States
All active or selected states must use the primary Cyan. Whether it is a checkbox, a radio button, or a navigation link, the transition to Cyan should be accompanied by a slight increase in the element's "glow" (shadow-spread) to simulate the component "powering on."