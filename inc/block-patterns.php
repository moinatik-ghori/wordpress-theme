<?php
/**
 * Block Patterns Registration
 *
 * @package DevEngine_Premium
 * @since 1.0.0
 */

declare(strict_types=1);

/**
 * DevEngine Premium WordPress Theme, (C) 2024 DevEngine
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package DevEngine_Premium
 * @since 1.0.0
 */

/**
 * Register block patterns and pattern category.
 *
 * @since 1.0.0
 */
function devengine_register_block_patterns(): void {
	// Register pattern category.
	if ( function_exists( 'register_block_pattern_category' ) ) {
		register_block_pattern_category(
			'devengine_patterns',
			array( 'label' => esc_html__( 'DevEngine Patterns', 'devengine' ) )
		);
	}

	// Pattern 1: Hero Code Split.
	register_block_pattern(
		'devengine/hero-code-split',
		array(
			'title'       => esc_html__( 'Hero — Code Split', 'devengine' ),
			'description' => esc_html__( 'A hero section with code example split layout.', 'devengine' ),
			'categories'  => array( 'devengine_patterns', 'featured' ),
			'content'     => '<!-- wp:columns {"className":"devengine-hero"} -->
<div class="wp-block-columns devengine-hero"><!-- wp:column {"width":"60%"} -->
<div class="wp-block-column" style="flex-basis:60%"><!-- wp:heading {"level":1,"fontSize":"2xl","textColor":"white","className":"hero__title"} -->
<h1 class="wp-block-heading has-2xl-font-size has-white-color has-text-color hero__title">I Build Things for the Web.</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted","className":"hero__description"} -->
<p class="has-muted-color has-text-color hero__description">Senior Software Engineer specializing in scalable systems and developer tooling.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"className":"hero__actions"} -->
<div class="wp-block-buttons hero__actions"><!-- wp:button {"className":"btn btn--primary"} -->
<div class="wp-block-button btn btn--primary"><a class="wp-block-button__link wp-element-button">View Projects</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"btn btn--ghost"} -->
<div class="wp-block-button btn btn--ghost"><a class="wp-block-button__link wp-element-button">Download CV</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"40%"} -->
<div class="wp-block-column" style="flex-basis:40%"><!-- wp:group {"className":"code-block-wrapper","backgroundColor":"surface","style":{"border":{"radius":"12px"},"spacing":{"padding":{"top":"var:preset|spacing|lg","right":"var:preset|spacing|lg","bottom":"var:preset|spacing|lg","left":"var:preset|spacing|lg"}}}} -->
<div class="wp-block-group code-block-wrapper has-surface-background-color has-background" style="border-radius:12px;padding-top:var(--wp--preset--spacing--lg);padding-right:var(--wp--preset--spacing--lg);padding-bottom:var(--wp--preset--spacing--lg);padding-left:var(--wp--preset--spacing--lg)"><!-- wp:code {"className":"code-block"} -->
<pre class="wp-block-code code-block"><code>async function fetchUserData(userId) {
  try {
    const response = await fetch(
      `https://api.example.com/users/${userId}`,
      {
        method: \'GET\',
        headers: {
          \'Content-Type\': \'application/json\',
          \'Authorization\': `Bearer ${token}`
        }
      }
    );
    
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    
    const data = await response.json();
    return data;
  } catch (error) {
    console.error(\'Fetch error:\', error);
    throw error;
  }
}</code></pre>
<!-- /wp:code --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->',
		)
	);

	// Pattern 2: Experience Timeline.
	register_block_pattern(
		'devengine/experience-timeline',
		array(
			'title'       => esc_html__( 'Experience Timeline', 'devengine' ),
			'description' => esc_html__( 'A vertical timeline displaying career experience.', 'devengine' ),
			'categories'  => array( 'devengine_patterns' ),
			'content'     => '<!-- wp:group {"className":"timeline"} -->
<div class="wp-block-group timeline"><!-- wp:group {"className":"timeline__item"} -->
<div class="wp-block-group timeline__item"><!-- wp:group {"className":"timeline__dot"} -->
<div class="wp-block-group timeline__dot"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"timeline__content"} -->
<div class="wp-block-group timeline__content"><!-- wp:heading {"level":3,"className":"timeline__title"} -->
<h3 class="wp-block-heading timeline__title">Senior Software Engineer — TechCorp Inc.</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted","className":"timeline__date"} -->
<p class="has-muted-color has-text-color timeline__date">January 2022 — Present</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"timeline__description"} -->
<p class="timeline__description">Leading development of microservices architecture using Node.js and TypeScript. Implemented CI/CD pipelines with GitHub Actions and Docker. Mentored junior developers and established coding standards.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"timeline__item"} -->
<div class="wp-block-group timeline__item"><!-- wp:group {"className":"timeline__dot"} -->
<div class="wp-block-group timeline__dot"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"timeline__content"} -->
<div class="wp-block-group timeline__content"><!-- wp:heading {"level":3,"className":"timeline__title"} -->
<h3 class="wp-block-heading timeline__title">Full Stack Developer — StartupHub</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted","className":"timeline__date"} -->
<p class="has-muted-color has-text-color timeline__date">March 2020 — December 2021</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"timeline__description"} -->
<p class="timeline__description">Built scalable web applications using React, Next.js, and PostgreSQL. Optimized database queries reducing load times by 40%. Collaborated with design team to implement responsive UI components.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"timeline__item"} -->
<div class="wp-block-group timeline__item"><!-- wp:group {"className":"timeline__dot"} -->
<div class="wp-block-group timeline__dot"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"timeline__content"} -->
<div class="wp-block-group timeline__content"><!-- wp:heading {"level":3,"className":"timeline__title"} -->
<h3 class="wp-block-heading timeline__title">Software Engineer — Digital Solutions</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted","className":"timeline__date"} -->
<p class="has-muted-color has-text-color timeline__date">June 2019 — February 2020</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"timeline__description"} -->
<p class="timeline__description">Developed RESTful APIs using PHP and Laravel. Integrated third-party payment gateways and implemented OAuth2 authentication. Maintained legacy codebase while migrating to modern frameworks.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"timeline__item"} -->
<div class="wp-block-group timeline__item"><!-- wp:group {"className":"timeline__dot"} -->
<div class="wp-block-group timeline__dot"></div>
<!-- /wp:group -->

<!-- wp:group {"className":"timeline__content"} -->
<div class="wp-block-group timeline__content"><!-- wp:heading {"level":3,"className":"timeline__title"} -->
<h3 class="wp-block-heading timeline__title">Junior Developer — WebWorks Agency</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"textColor":"muted","className":"timeline__date"} -->
<p class="has-muted-color has-text-color timeline__date">August 2018 — May 2019</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"timeline__description"} -->
<p class="timeline__description">Created custom WordPress themes and plugins. Built responsive websites using HTML5, CSS3, and JavaScript. Gained experience with version control, code reviews, and agile development methodologies.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- Note: Timeline connector line is styled via CSS ::before pseudo-element on .timeline class (see _timeline.scss) -->',
		)
	);

	// Pattern 3: Project Bento Grid.
	register_block_pattern(
		'devengine/project-bento-grid',
		array(
			'title'       => esc_html__( 'Project Bento Grid', 'devengine' ),
			'description' => esc_html__( 'A non-uniform grid layout showcasing projects.', 'devengine' ),
			'categories'  => array( 'devengine_patterns', 'portfolio' ),
			'content'     => '<!-- wp:group {"className":"grid grid--bento"} -->
<div class="wp-block-group grid grid--bento"><!-- wp:group {"className":"grid-item--large card card--project"} -->
<div class="wp-block-group grid-item--large card card--project"><!-- wp:image {"sizeSlug":"devengine-card","className":"card__image"} -->
<figure class="wp-block-image card__image"><img alt="E-Commerce Platform" src="data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 800 600\'%3E%3Crect fill=\'%232dd4bf\' width=\'800\' height=\'600\'/%3E%3C/svg%3E"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"className":"card__title"} -->
<h3 class="wp-block-heading card__title">E-Commerce Platform</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"card__description"} -->
<p class="card__description">Scalable e-commerce solution built with Next.js and Stripe integration. Features real-time inventory management and advanced analytics dashboard.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"badge-group"} -->
<div class="wp-block-group badge-group"><!-- wp:paragraph {"className":"badge badge--tech"} -->
<p class="badge badge--tech">Next.js</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"badge badge--tech"} -->
<p class="badge badge--tech">TypeScript</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"badge badge--tech"} -->
<p class="badge badge--tech">Stripe</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"badge badge--tech"} -->
<p class="badge badge--tech">PostgreSQL</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:buttons {"className":"card__actions"} -->
<div class="wp-block-buttons card__actions"><!-- wp:button {"className":"btn btn--primary"} -->
<div class="wp-block-button btn btn--primary"><a class="wp-block-button__link wp-element-button">Live Demo</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"btn btn--ghost"} -->
<div class="wp-block-button btn btn--ghost"><a class="wp-block-button__link wp-element-button">GitHub</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"card card--project"} -->
<div class="wp-block-group card card--project"><!-- wp:image {"sizeSlug":"devengine-card","className":"card__image"} -->
<figure class="wp-block-image card__image"><img alt="API Gateway" src="data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 800 600\'%3E%3Crect fill=\'%230f172a\' width=\'800\' height=\'600\'/%3E%3C/svg%3E"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"className":"card__title"} -->
<h3 class="wp-block-heading card__title">API Gateway</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"card__description"} -->
<p class="card__description">High-performance API gateway with rate limiting and authentication middleware.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"badge-group"} -->
<div class="wp-block-group badge-group"><!-- wp:paragraph {"className":"badge badge--tech"} -->
<p class="badge badge--tech">Go</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"badge badge--tech"} -->
<p class="badge badge--tech">Redis</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"badge badge--tech"} -->
<p class="badge badge--tech">Docker</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:buttons {"className":"card__actions"} -->
<div class="wp-block-buttons card__actions"><!-- wp:button {"className":"btn btn--primary"} -->
<div class="wp-block-button btn btn--primary"><a class="wp-block-button__link wp-element-button">Live Demo</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"btn btn--ghost"} -->
<div class="wp-block-button btn btn--ghost"><a class="wp-block-button__link wp-element-button">GitHub</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"card card--project"} -->
<div class="wp-block-group card card--project"><!-- wp:image {"sizeSlug":"devengine-card","className":"card__image"} -->
<figure class="wp-block-image card__image"><img alt="Design System" src="data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 800 600\'%3E%3Crect fill=\'%2364748b\' width=\'800\' height=\'600\'/%3E%3C/svg%3E"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"className":"card__title"} -->
<h3 class="wp-block-heading card__title">Design System</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"card__description"} -->
<p class="card__description">Component library and design tokens for consistent UI across applications.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"badge-group"} -->
<div class="wp-block-group badge-group"><!-- wp:paragraph {"className":"badge badge--tech"} -->
<p class="badge badge--tech">React</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"badge badge--tech"} -->
<p class="badge badge--tech">Storybook</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"badge badge--tech"} -->
<p class="badge badge--tech">TypeScript</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:buttons {"className":"card__actions"} -->
<div class="wp-block-buttons card__actions"><!-- wp:button {"className":"btn btn--primary"} -->
<div class="wp-block-button btn btn--primary"><a class="wp-block-button__link wp-element-button">Live Demo</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"btn btn--ghost"} -->
<div class="wp-block-button btn btn--ghost"><a class="wp-block-button__link wp-element-button">GitHub</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"grid-item--wide card card--project"} -->
<div class="wp-block-group grid-item--wide card card--project"><!-- wp:image {"sizeSlug":"devengine-card","className":"card__image"} -->
<figure class="wp-block-image card__image"><img alt="Open Source Contributions" src="data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 800 600\'%3E%3Crect fill=\'%231e293b\' width=\'800\' height=\'600\'/%3E%3C/svg%3E"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"level":3,"className":"card__title"} -->
<h3 class="wp-block-heading card__title">Open Source Contributions</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"card__description"} -->
<p class="card__description">Contributing to popular open source projects including React, Next.js, and various developer tools. Focus on performance optimizations and accessibility improvements.</p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"badge-group"} -->
<div class="wp-block-group badge-group"><!-- wp:paragraph {"className":"badge badge--tech"} -->
<p class="badge badge--tech">Open Source</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"badge badge--tech"} -->
<p class="badge badge--tech">Community</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"badge badge--tech"} -->
<p class="badge badge--tech">Contributions</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:buttons {"className":"card__actions"} -->
<div class="wp-block-buttons card__actions"><!-- wp:button {"className":"btn btn--primary"} -->
<div class="wp-block-button btn btn--primary"><a class="wp-block-button__link wp-element-button">View Contributions</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"btn btn--ghost"} -->
<div class="wp-block-button btn btn--ghost"><a class="wp-block-button__link wp-element-button">GitHub Profile</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->',
		)
	);
}
add_action( 'init', 'devengine_register_block_patterns', 9 );

