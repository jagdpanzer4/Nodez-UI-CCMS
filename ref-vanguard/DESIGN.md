# Design System Strategy: Tactical Precision & Refined Glass

## 1. Overview & Creative North Star: "The Digital Vanguard"
This design system is built to bridge the gap between rugged, physical 3D-printed hardware and high-end tactical software. Our Creative North Star is **"The Digital Vanguard."** We are moving away from the "clunky" military HUDs of the past toward a sophisticated, editorial-tech aesthetic.

To break the "standard template" look, we utilize **intentional asymmetry**. Primary data points should feel heavy and grounded, while secondary controls float in glass containers. We avoid rigid grids in favor of a "modular cockpit" feel—where elements overlap slightly and depth is created through tonal stacking rather than lines. The goal is a UI that feels like a high-precision instrument: intentional, durable, and elite.

---

## 2. Colors: Tonal Depth & Tactical Accents
The palette is rooted in the earth-tones of field equipment but elevated through Material-inspired layering.

*   **Primary (Olive):** `#b6d088` (Lightened) and `#556b2f` (Container). Use for core tactical elements.
*   **Secondary (Sand):** `#d6c692`. This provides the "refined" contrast to the olive, used for secondary actions and hardware-related status.
*   **Tertiary (Orange):** `#ffb77d`. Our "Caution/Action" accent. Use sparingly to draw the eye to critical telemetry or primary CTAs.

### The "No-Line" Rule
Traditional 1px borders are strictly prohibited for sectioning. Separation must be achieved through:
1.  **Background Shifts:** Place a `surface_container_low` element against a `surface` background.
2.  **Tonal Transitions:** Use the difference between `surface_container` and `surface_container_highest` to define boundaries.

### Glass & Gradient Rule
To achieve the "High-Tech Tactical" feel, floating menus must use **Glassmorphism**. 
*   **Formula:** `surface_variant` at 60% opacity + `backdrop-filter: blur(12px)`.
*   **Signature Textures:** Apply a subtle linear gradient to Primary Buttons (from `primary` to `primary_container`) to give them a "machined" 3D depth.

---

## 3. Typography: Technical Authority
We pair the utilitarian nature of a technical sans with the elegance of modern editorial scales.

*   **Display & Headlines (Space Grotesk):** This is our "Machined" face. It’s wide, technical, and authoritative. Use `display-lg` for hero metrics and `headline-sm` for section headers.
*   **Body & Titles (Inter):** This provides maximum readability against complex backgrounds. Use `body-md` for all tactical readouts.
*   **Labels (Space Grotesk):** All-caps labels at `label-sm` should be used for data categories, mimicking etched serial numbers on 3D-printed parts.

---

## 4. Elevation & Depth: The Stacking Principle
In this system, depth is "built," not "painted." We replace drop shadows with **Tonal Layering**.

*   **The Layering Principle:** Treat the UI as a physical stack. 
    *   *Base:* `surface`
    *   *Section:* `surface_container_low`
    *   *Component/Card:* `surface_container_highest`
*   **The Ghost Border:** If a component requires a boundary for accessibility, use a `1px` stroke of `outline_variant` at **15% opacity**. It should be felt, not seen.
*   **Ambient Shadows:** For "Floating Vanguard" elements (Modals/Overlays), use a shadow color tinted with `#121410` (Surface Color), with a blur radius of `32px` and an opacity of `6%`. This creates a natural atmospheric lift rather than a digital "drop."

---

## 5. Components

### Buttons (Tactical Trigger)
*   **Primary:** Linear gradient (`primary` to `primary_container`). `0.25rem` (sm) corner radius. On hover, increase the `surface_tint` brightness by 5%.
*   **Secondary:** Ghost style. No background, `outline_variant` ghost border (20% opacity).
*   **Tertiary (Accent):** Solid `tertiary` (Orange) for critical "Print" or "Execute" commands.

### Tactical Chips
*   Used for status (e.g., "Printing," "Standby").
*   **Style:** `surface_container_highest` background, no border. Use a small `3x3px` square icon in the accent color next to the text to indicate status.

### Input Fields
*   **Style:** Bottom-heavy. No top or side borders. A `2px` stroke on the bottom using `outline`.
*   **Focus State:** The bottom stroke transforms to `primary` (Olive), and the background gains a 5% `primary_container` tint.

### Lists & Cards (The "Zero-Divider" Rule)
*   **Forbid dividers.** To separate list items, use a `spacing-4` vertical gap or alternate background colors between `surface_container_low` and `surface_container`.
*   **Cards:** Use `xl` (0.75rem) roundedness to contrast with the "hard" tactical typography.

### Data Readouts (Custom Component)
*   A specialized component for 3D print telemetry. Use `label-sm` for the title and `headline-md` for the value. Wrap in a glassmorphic container for a "HUD" overlay feel.

---

## 6. Do’s and Don’ts

### Do:
*   **Use Asymmetry:** Place a large metric on the left and a cluster of small controls on the right.
*   **Embrace "Breathing Room":** Use `spacing-16` or `spacing-20` for major section padding to maintain a premium feel.
*   **Micro-interactions:** When a button is pressed, give it a subtle `0.98` scale-down effect to mimic a physical tactical switch.

### Don’t:
*   **Don't use pure black:** Always use `surface` (`#121410`) to keep the "Olive" undertone alive.
*   **Don't use high-contrast borders:** A 100% opaque border is a failure of tonal hierarchy.
*   **Don't over-animate:** Animations should be fast and linear (e.g., 150ms "Snap"), suggesting mechanical precision rather than "playful" easing.