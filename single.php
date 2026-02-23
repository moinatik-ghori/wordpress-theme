<?php
/**
 * Single Post Template
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

get_header();
?>

<article <?php post_class( 'single-post container' ); ?> itemscope itemtype="https://schema.org/BlogPosting">
	<header class="single-post__header">
		<?php devengine_breadcrumbs(); ?>

		<?php the_title( '<h1 class="single-post__title" itemprop="headline">', '</h1>' ); ?>

		<div class="single-post__meta">
			<?php
			$author_id = get_the_author_meta( 'ID' );
			?>
			<span class="single-post__author">
				<?php echo get_avatar( $author_id, 32 ); ?>
				<a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>" itemprop="author" itemscope itemtype="https://schema.org/Person">
					<span itemprop="name"><?php the_author(); ?></span>
				</a>
			</span>

			<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" itemprop="datePublished">
				<?php the_time( get_option( 'date_format' ) ); ?>
			</time>

			<?php
			$content = strip_tags( get_the_content() );
			$word_count = str_word_count( $content );
			$reading_time = ceil( $word_count / 200 );
			?>
			<span class="single-post__reading-time">
				<?php
				printf(
					/* translators: %d: Reading time in minutes */
					esc_html( _n( '%d min read', '%d min read', $reading_time, 'devengine' ) ),
					esc_html( $reading_time )
				);
				?>
			</span>
		</div>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="single-post__hero" itemprop="image">
			<?php the_post_thumbnail( 'devengine-hero' ); ?>
			<?php
			$caption = get_the_post_thumbnail_caption();
			if ( $caption ) :
				?>
				<figcaption><?php echo esc_html( $caption ); ?></figcaption>
			<?php endif; ?>
		</figure>
	<?php endif; ?>

	<div class="single-post__content prose" itemprop="articleBody">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'devengine' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>

	<?php
	$tags = get_the_tags();
	if ( $tags ) :
		?>
		<footer class="single-post__tags">
			<?php
			foreach ( $tags as $tag ) {
				printf(
					'<a href="%s" class="badge badge--tech">%s</a> ',
					esc_url( get_tag_link( $tag->term_id ) ),
					esc_html( $tag->name )
				);
			}
			?>
		</footer>
	<?php endif; ?>

	<aside class="author-bio" aria-label="<?php esc_attr_e( 'About the author', 'devengine' ); ?>">
		<?php echo get_avatar( $author_id, 96 ); ?>
		<div class="author-bio__content">
			<h3 class="author-bio__name"><?php the_author(); ?></h3>
			<p class="author-bio__description">
				<?php echo esc_html( get_the_author_meta( 'description' ) ); ?>
			</p>
			<a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>" class="btn btn--ghost">
				<?php esc_html_e( 'View all posts', 'devengine' ); ?>
			</a>
		</div>
	</aside>

	<?php
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
	?>

	<?php
	the_post_navigation(
		array(
			'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'devengine' ) . '</span> <span class="nav-title">%title</span>',
			'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'devengine' ) . '</span> <span class="nav-title">%title</span>',
		)
	);
	?>
</article>

<?php
get_footer();

