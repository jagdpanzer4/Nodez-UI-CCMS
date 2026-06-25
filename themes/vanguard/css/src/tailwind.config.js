/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  content: [
    '../../**/*.php',
    '../../**/*.html',
  ],
  safelist: [
    'vanguard-nav--scrolled',
  ],
  theme: {
    extend: {
      colors: {
        // Surfaces (dark base tones with olive undertone)
        'surface': '#121410',
        'surface-dim': '#121410',
        'surface-bright': '#383a35',
        'surface-container-lowest': '#0d0f0b',
        'surface-container-low': '#1a1c18',
        'surface-container': '#1e201c',
        'surface-container-high': '#292b26',
        'surface-container-highest': '#333531',
        'surface-variant': '#333531',
        'surface-tint': '#b6d088',
        // Primary — Olive
        'primary': '#b6d088',
        'primary-fixed': '#d2eca2',
        'primary-fixed-dim': '#b6d088',
        'primary-container': '#556b2f',
        'on-primary': '#233600',
        'on-primary-fixed': '#131f00',
        'on-primary-fixed-variant': '#394d14',
        'on-primary-container': '#d0eba1',
        'inverse-primary': '#50652a',
        // Secondary — Sand
        'secondary': '#d6c692',
        'secondary-fixed': '#f3e2ac',
        'secondary-fixed-dim': '#d6c692',
        'secondary-container': '#544820',
        'on-secondary': '#3a3009',
        'on-secondary-fixed': '#231b00',
        'on-secondary-fixed-variant': '#51461e',
        'on-secondary-container': '#c8b885',
        // Tertiary — Orange accent (Caution/Action)
        'tertiary': '#ffb77d',
        'tertiary-fixed': '#ffdcc3',
        'tertiary-fixed-dim': '#ffb77d',
        'tertiary-container': '#985100',
        'on-tertiary': '#4d2600',
        'on-tertiary-fixed': '#2f1500',
        'on-tertiary-fixed-variant': '#6e3900',
        'on-tertiary-container': '#ffd9be',
        // Text / On colors
        'on-surface': '#e3e3dc',
        'on-surface-variant': '#c5c8b8',
        'on-background': '#e3e3dc',
        'inverse-surface': '#e3e3dc',
        'inverse-on-surface': '#2f312d',
        // Outline
        'outline': '#8f9284',
        'outline-variant': '#45483c',
        // Error
        'error': '#ffb4ab',
        'error-container': '#93000a',
        'on-error': '#690005',
        'on-error-container': '#ffdad6',
        // Background
        'background': '#121410',
      },
      fontFamily: {
        'headline': ['Space Grotesk', 'sans-serif'],
        'body': ['Inter', 'sans-serif'],
        'label': ['Space Grotesk', 'sans-serif'],
      },
      borderRadius: {
        'DEFAULT': '0.125rem',
        'lg': '0.25rem',
        'xl': '0.5rem',
        'full': '0.75rem',
      },
      boxShadow: {
        'ambient': '0 32px 64px -15px rgba(18, 20, 16, 0.06)',
        'float': '0 8px 32px 0 rgba(18, 20, 16, 0.06)',
      },
    },
  },
  plugins: [],
}
