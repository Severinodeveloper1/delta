---
name: Industrial Velocity
colors:
  surface: '#f9f9fc'
  surface-dim: '#dadadc'
  surface-bright: '#f9f9fc'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f3f3f6'
  surface-container: '#eeeef0'
  surface-container-high: '#e8e8ea'
  surface-container-highest: '#e2e2e5'
  on-surface: '#1a1c1e'
  on-surface-variant: '#434657'
  inverse-surface: '#2f3133'
  inverse-on-surface: '#f0f0f3'
  outline: '#747688'
  outline-variant: '#c4c5da'
  surface-tint: '#0046fa'
  primary: '#0035c5'
  on-primary: '#ffffff'
  primary-container: '#0047ff'
  on-primary-container: '#d4d9ff'
  inverse-primary: '#b9c3ff'
  secondary: '#a04100'
  on-secondary: '#ffffff'
  secondary-container: '#fe6b00'
  on-secondary-container: '#572000'
  tertiary: '#00505c'
  on-tertiary: '#ffffff'
  tertiary-container: '#006a7a'
  on-tertiary-container: '#87eaff'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#dde1ff'
  primary-fixed-dim: '#b9c3ff'
  on-primary-fixed: '#001257'
  on-primary-fixed-variant: '#0033c0'
  secondary-fixed: '#ffdbcc'
  secondary-fixed-dim: '#ffb693'
  on-secondary-fixed: '#351000'
  on-secondary-fixed-variant: '#7a3000'
  tertiary-fixed: '#a5eeff'
  tertiary-fixed-dim: '#00daf8'
  on-tertiary-fixed: '#001f25'
  on-tertiary-fixed-variant: '#004e5a'
  background: '#f9f9fc'
  on-background: '#1a1c1e'
  surface-variant: '#e2e2e5'
typography:
  display-lg:
    fontFamily: Lexend
    fontSize: 64px
    fontWeight: '700'
    lineHeight: '1.1'
    letterSpacing: -0.02em
  display-lg-mobile:
    fontFamily: Lexend
    fontSize: 40px
    fontWeight: '700'
    lineHeight: '1.2'
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Lexend
    fontSize: 32px
    fontWeight: '600'
    lineHeight: '1.25'
  headline-md:
    fontFamily: Lexend
    fontSize: 24px
    fontWeight: '600'
    lineHeight: '1.3'
  body-lg:
    fontFamily: Lexend
    fontSize: 18px
    fontWeight: '400'
    lineHeight: '1.6'
  body-md:
    fontFamily: Lexend
    fontSize: 16px
    fontWeight: '400'
    lineHeight: '1.6'
  label-md:
    fontFamily: JetBrains Mono
    fontSize: 14px
    fontWeight: '500'
    lineHeight: '1'
    letterSpacing: 0.05em
  caption:
    fontFamily: Lexend
    fontSize: 12px
    fontWeight: '500'
    lineHeight: '1.4'
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  base: 8px
  container-max: 1280px
  gutter: 24px
  margin-desktop: 64px
  margin-mobile: 20px
---

## Brand & Style
The design system for this brand is built on a "Modern Commercial Industrial" aesthetic. It balances the heavy-duty reliability required for printing equipment with the high-speed precision of modern manufacturing. The interface must evoke a sense of power, efficiency, and clarity.

The visual direction utilizes a **Corporate Modern** foundation infused with **High-Contrast** energy. It prioritizes clear information hierarchy and impactful visual statements to command attention in a B2B environment. The emotional response should be one of absolute confidence: the equipment is robust, the software is cutting-edge, and the service is professional.

## Colors
The palette is engineered for maximum functional impact. 
- **Primary (Electric Cobalt):** A dynamic blue that signals professional technology and trust. Use this for primary navigation, active states, and brand-heavy elements.
- **Secondary (Signal Orange):** Reserved exclusively for Call-to-Actions (CTAs) and critical alerts. It provides the "high-vis" contrast necessary for industrial software.
- **Tertiary (Cyber Cyan):** Used sparingly for data visualization, secondary accents, or progress indicators to maintain a modern, digital-first feel.
- **Neutral (Carbon):** A range of deep grays and off-whites that ground the vibrant accents. Pure black is avoided in favor of Carbon to maintain depth and readability.

High-contrast sections should alternate between "Carbon" backgrounds with white text and clean white backgrounds with "Carbon" text to break up long-form content.

## Typography
This design system utilizes **Lexend** as the primary typeface. Its geometric construction and hyper-legibility align with the industrial precision of the brand. For technical data, serial numbers, and status labels, **JetBrains Mono** is introduced to provide a "technical specification" feel.

Headlines should be set with tight letter-spacing to emphasize a compact, powerful look. Body text requires generous line-height to ensure readability when viewing equipment specifications or technical manuals. Labels should always be in uppercase when using the monospaced font to differentiate them from prose.

## Layout & Spacing
The layout follows a **Fixed Grid** model on desktop to maintain a structural, architectural feel, switching to a fluid model for mobile devices. 

- **Desktop:** 12-column grid, 1280px max-width, 24px gutters.
- **Tablet:** 8-column grid, 32px margins.
- **Mobile:** 4-column grid, 20px margins.

Spacing follows an 8px base unit. Component padding should be generous to maintain "visual breathing room" amidst high-contrast sections. Use vertical "mega-padding" (80px - 120px) to separate major content blocks, reinforcing the high-impact commercial feel.

## Elevation & Depth
This design system uses **Tonal Layers** and **Low-Contrast Outlines** rather than heavy shadows. In an industrial context, "flat and sturdy" is preferred over "soft and floating."

Depth is created through color blocking. Primary surfaces are white (#FFFFFF), while secondary containers use a very light gray (#F1F3F5). For interactive elements like cards, use a 1px solid border (#E9ECEF) that transitions to the Primary Blue on hover. Shadows, if used, must be "Short and Sharp"—minimal blur (4px) and low opacity (10%), acting as a subtle lift rather than a cloud-like effect.

## Shapes
Following the "rounded-lg" requirement, the design system utilizes a **Rounded** (Level 2) shape language. This softens the "cold" industrial aesthetic, making the technology feel accessible and modern.

Buttons and input fields use a consistent 0.5rem (8px) corner radius. Larger containers, such as product feature cards or modal windows, utilize the `rounded-xl` (1.5rem / 24px) setting to create a distinct framing effect for imagery and technical specs.

## Components
- **Buttons:** Primary buttons use the Signal Orange background with white bold text for maximum conversion. Secondary buttons use a thick 2px Primary Blue border.
- **Inputs:** Use high-contrast "Carbon" labels in JetBrains Mono. Fields should have a 1px border that thickens to 2px on focus.
- **Cards:** Utilize "Feature Cards" with large-scale imagery at the top and technical specs below. Use a subtle background fill on hover to indicate interactivity.
- **Status Chips:** Use a "Traffic Light" system (Cyan for active, Orange for warning, Blue for info) with low-opacity background tints and high-opacity text.
- **Industrial Lists:** For equipment specs, use a zebra-striped list format with Carbon-100 and White backgrounds, ensuring clear horizontal scanning.
- **Data Visualizations:** Graphs should prioritize Primary Blue and Tertiary Cyan to maintain the "commercial tech" aesthetic.