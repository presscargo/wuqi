<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_singular( get_post_type() ) ) : // If viewing a single post. ?>

		<header class="entry-header">
			<?php if ( get_option( 'show_avatars' ) ) : // If avatars are enabled. ?>
				<?php echo get_avatar( get_the_author_meta( 'email' ) ); ?>
			<?php endif; // End avatars check. ?>
			<?php wuqi_entry_byline(); ?>
		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php hybrid_post_terms( array( 'taxonomy' => 'category', 'text' => esc_html__( 'Posted in %s', 'wuqi' ) ) ); ?>
			<?php hybrid_post_terms( array( 'taxonomy' => 'post_tag', 'text' => esc_html__( 'Tagged %s', 'wuqi' ) ) ); ?>
		</footer><!-- .entry-footer -->

	<?php else : // If not viewing a single post. ?>

		<header class="entry-header">
			<?php if ( get_option( 'show_avatars' ) ) : // If avatars are enabled. ?>
				<?php echo get_avatar( get_the_author_meta( 'email' ) ); ?>
			<?php endif; // End avatars check. ?>
			<?php wuqi_entry_byline(); ?>
		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
		</div><!-- .entry-content -->

	<?php endif; // End single post check. ?>

</article><!-- .entry -->