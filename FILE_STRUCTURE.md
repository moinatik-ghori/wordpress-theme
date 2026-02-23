# DevEngine Premium - Complete File Structure

```
devengine-premium/
├── style.css                          # Theme header + CSS custom properties
├── index.php                          # Fallback template
├── functions.php                      # Theme functions
├── theme.json                         # FSE configuration
├── readme.txt                         # Theme readme
├── screenshot.png                     # Theme screenshot (placeholder)
├── composer.json                      # PHP dependencies
├── package.json                       # Node dependencies
├── .phpcsrc.xml                       # PHPCS configuration
├── .stylelintrc.json                  # Stylelint configuration
├── .gitignore                         # Git ignore rules
│
├── src/
│   ├── scss/
│   │   ├── abstracts/
│   │   │   ├── _variables.scss        # SCSS variables mirroring CSS custom properties
│   │   │   ├── _mixins.scss           # Responsive, layout, and utility mixins
│   │   │   ├── _functions.scss        # rem() and clamp-size() helpers
│   │   │   └── _placeholders.scss     # Silent placeholder classes
│   │   ├── base/
│   │   │   ├── _reset.scss            # Modern CSS reset
│   │   │   ├── _typography.scss       # Fluid typography scale
│   │   │   └── _accessibility.scss    # Skip links, focus rings, screen reader utilities
│   │   ├── layout/
│   │   │   ├── _grid.scss             # CSS Grid utilities
│   │   │   ├── _header.scss           # Sticky header with backdrop blur
│   │   │   ├── _footer.scss           # Three-column footer layout
│   │   │   └── _sidebar.scss          # Sticky sidebar
│   │   ├── components/
│   │   │   ├── _button.scss           # BEM button variants
│   │   │   ├── _card.scss             # BEM card components
│   │   │   ├── _badge.scss            # Tech stack badges
│   │   │   ├── _navigation.scss       # BEM nav with underline animation
│   │   │   ├── _progress-bar.scss     # Reading progress indicator
│   │   │   ├── _cursor.scss           # Magnetic cursor (touch-disabled)
│   │   │   ├── _timeline.scss         # Experience timeline component
│   │   │   └── _code-block.scss       # Prism.js theme overrides
│   │   ├── themes/
│   │   │   ├── _dark.scss             # Dark theme overrides
│   │   │   └── _light.scss            # Light theme overrides
│   │   └── main.scss                  # Entry point (imports all partials)
│   ├── js/
│   │   ├── main.js                    # Main JavaScript entry
│   │   ├── cursor.js                  # Magnetic cursor logic
│   │   ├── progress.js                # Reading progress bar
│   │   └── navigation.js              # Mobile navigation toggle
│   └── blocks/
│       ├── github-repo-card/
│       │   ├── block.json             # Block registration
│       │   ├── edit.js                # Editor component
│       │   ├── save.js                # Save function
│       │   ├── render.php             # Server-side render
│       │   └── style.scss             # Block-specific styles
│       └── tech-stack-badge/
│           ├── block.json
│           ├── edit.js
│           ├── save.js
│           ├── render.php
│           └── style.scss
│
├── dist/                              # Auto-generated build output
│   ├── css/
│   │   └── main.css                   # Compiled CSS
│   └── js/
│       └── main.js                    # Bundled JavaScript
│
├── inc/
│   ├── class-github-api.php           # GitHub API integration
│   ├── block-patterns.php             # Custom block patterns
│   ├── customizer.php                 # Theme customizer settings
│   ├── custom-post-types.php          # CPT registrations
│   ├── breadcrumbs.php                # Breadcrumb navigation
│   ├── enqueue.php                    # Asset enqueuing
│   ├── theme-setup.php                # Theme support features
│   └── security.php                   # Security hardening
│
├── templates/
│   ├── index.html                     # Blog index template
│   ├── single.html                    # Single post template
│   ├── archive.html                   # Archive template
│   ├── page.html                      # Page template
│   ├── search.html                    # Search results template
│   └── 404.html                       # 404 error template
│
├── parts/
│   ├── header.html                    # Site header template part
│   ├── footer.html                    # Site footer template part
│   ├── sidebar.html                   # Sidebar template part
│   └── breadcrumbs.html               # Breadcrumb template part
│
├── patterns/
│   ├── hero-code-split.php            # Hero with code split pattern
│   ├── experience-timeline.php        # Experience timeline pattern
│   └── project-bento-grid.php         # Project bento grid pattern
│
├── blocks/
│   ├── github-repo-card/
│   │   ├── block.json
│   │   ├── edit.js
│   │   ├── save.js
│   │   ├── render.php
│   │   └── style.scss
│   └── tech-stack-badge/
│       ├── block.json
│       ├── edit.js
│       ├── save.js
│       ├── render.php
│       └── style.scss
│
├── assets/
│   ├── fonts/                         # Web font files
│   ├── images/                        # Theme images
│   └── icons/                         # SVG icons
│
└── languages/
    └── devengine.pot                  # Translation template
```

