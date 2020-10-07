<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package wuqi
 */

if ( ! function_exists( 'wuqi_entry_byline' ) ) :
	function wuqi_entry_byline() { ?>
		<ul class="entry-byline">
			<?php if ( 'visible' == get_theme_mod( 'general_post_author' ) ) : ?>
				<li <?php hybrid_attr( 'entry-author' ); ?>><?php the_author_posts_link(); ?></li>
			<?php endif; ?>
			<li><a href="<?php the_permalink(); ?>"><time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time></a></li>

			<?php $terms = get_the_terms( get_the_ID(), 'post_format' ); ?>
			<?php if ( $terms ) : ?>
				<li><?php hybrid_post_format_link(); ?></li>
			<?php endif; ?>
			
			<?php if ( current_user_can( 'manage_options' ) ) : ?>
				<li><?php edit_post_link( __( 'Edit', 'wuqi' ) ); ?></li>
			<?php endif; ?>
		</ul><!-- .entry-byline --><?php
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;
