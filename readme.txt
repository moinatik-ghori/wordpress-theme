=== DevEngine Premium ===
Contributors: devengine
Tags: blog, portfolio, custom-colors, custom-logo, custom-menu, editor-style, featured-images, full-site-editing, block-patterns, rtl-language-support, sticky-post, theme-options, threaded-comments, translation-ready, wide-blocks, accessibility-ready
Requires at least: 6.5
Tested up to: 6.5
Requires PHP: 8.1
Stable tag: 1.0.0
License: GNU General Public License v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

== Description ==

DevEngine Premium is a modern, performance-first WordPress theme engineered specifically for software engineers and developers seeking to build a powerful personal branding website. Built on WordPress 6.5 Full Site Editing architecture, the theme combines cutting-edge design with developer-focused features that showcase technical expertise and project portfolios.

The theme features a sophisticated dark mode implementation with system preference detection, seamless GitHub API integration for displaying repositories directly in the editor, and a comprehensive design system built on fluid typography and modern CSS Grid layouts. Performance is prioritized through optimized asset loading, conditional script enqueuing, and GPU-accelerated animations that respect user motion preferences.

Targeted at software engineers, technical writers, and developer advocates, DevEngine Premium provides custom post types for projects and code snippets, tech stack badge components, and block patterns for hero sections, experience timelines, and project showcases. The theme is fully accessible with WCAG 2.1 AA compliance, keyboard navigation support, and comprehensive ARIA landmark roles throughout all templates.

== Installation ==

1. Download the DevEngine Premium theme zip file from your purchase location.

2. Log in to your WordPress admin dashboard and navigate to Appearance > Themes > Add New.

3. Click the Upload Theme button at the top of the page, select the downloaded zip file, and click Install Now.

4. After installation completes, click Activate to enable the theme on your site.

5. Navigate to Appearance > Customize to configure your GitHub username, color scheme preferences, and other theme options. All features are built-in and no additional plugins are required for core functionality.

== Frequently Asked Questions ==

= Does this theme require the Classic Editor? =

No, DevEngine Premium is built exclusively for the Gutenberg block editor and WordPress Full Site Editing. The theme leverages modern block patterns, custom Gutenberg blocks, and theme.json configuration to provide a native editing experience. Classic Editor plugin is not supported and may cause conflicts with theme functionality.

= How do I connect my GitHub account? =

Navigate to Appearance > Customize > GitHub Integration panel in your WordPress admin. Enter your GitHub username in the provided field. Optionally, you can add a GitHub Personal Access Token to increase API rate limits from 60 requests per hour to 5000 requests per hour. The token is stored securely in your WordPress database and should be a read-only token with no write permissions. Once configured, you can use the GitHub Repo Card block in any post or page to display repository information.

= Does the dark mode work without JavaScript? =

Yes, the theme implements graceful degradation for dark mode. The default CSS theme is dark, so users without JavaScript will see the dark theme by default. JavaScript enhances the experience by adding a toggle button, detecting system preferences, and allowing users to save their preference in localStorage. The theme switcher respects the prefers-color-scheme media query and applies the appropriate theme class to the document root element.

= Is this theme accessible? =

DevEngine Premium is designed with accessibility as a core principle, targeting WCAG 2.1 AA compliance. The theme includes comprehensive keyboard navigation support, proper ARIA landmark roles on all major page sections, skip-to-content links, focus-visible indicators with teal outline rings, and screen reader optimized markup. All interactive elements are keyboard accessible, form inputs include proper labels, and color contrast ratios meet accessibility standards. The theme respects prefers-reduced-motion media queries and disables animations for users who prefer reduced motion.

= Can I use this theme with a page builder? =

DevEngine Premium is optimized specifically for the Gutenberg block editor and WordPress Full Site Editing architecture. While it may technically work with third-party page builders, we do not recommend or support this configuration. The theme's custom blocks, block patterns, and theme.json configurations are designed to work seamlessly with Gutenberg. Using page builders may result in layout conflicts, broken styling, and loss of theme-specific features. For the best experience, we recommend using the native WordPress block editor.

== Changelog ==

= 1.0.0 = * 2024-01-15
* Initial release

Design System:
* Fluid typography scale with clamp() functions
* Comprehensive color palette with dark and light mode support
* Spacing scale based on 4px base unit
* Custom CSS custom properties for all design tokens
* Modern CSS Grid utilities with bento grid layout support

GitHub Integration:
* GitHub API client class with caching and error handling
* Custom GitHub Repo Card Gutenberg block
* REST API endpoint for repository data
* Customizer panel for GitHub credentials configuration
* Automatic cache flushing on project updates

Block Patterns:
* Hero Code Split pattern with code example display
* Experience Timeline pattern with career history layout
* Project Bento Grid pattern with non-uniform grid showcase

Performance:
* Conditional asset loading based on block presence
* GPU-accelerated animations using transform properties
* RequestAnimationFrame optimization for scroll handlers
* Vite-based build pipeline for optimized production assets
* Preconnect hints for Google Fonts

Accessibility:
* WCAG 2.1 AA compliance target
* Comprehensive ARIA landmark roles
* Skip-to-content link implementation
* Keyboard navigation support throughout
* Screen reader optimized markup
* Focus-visible indicators with custom styling
* Reduced motion support for all animations

== Upgrade Notice ==

= 1.0.0 =
Initial release of DevEngine Premium. This is the first stable version with all core features implemented and tested.

== Credits ==

Inter Font — SIL Open Font License 1.1 — Google Fonts
JetBrains Mono — SIL Open Font License 1.1 — JetBrains
Prism.js — MIT License — Lea Verou & contributors
AOS.js — MIT License — Michał Sajnóg
Modern CSS Reset — MIT License — Andy Bell
Screenshot image — Screenshot uses placeholder image, CC0 licensed

