<?php if ( is_singular( 'post' ) ) : // If viewing a single post page. ?>

	<nav class="post-navigation">
		<div class="nav-links">
			<?php previous_post_link( '<div class="nav-prev">' . esc_html__( 'Previous Post %link', 'wuqi' ) . '</div>', '%title' ); ?>
			<?php next_post_link(     '<div class="nav-next">' . esc_html__( 'Next Post %link',     'wuqi' ) . '</div>', '%title' ); ?>
		</div>
	</nav><!-- .post-navigation -->

<?php elseif ( is_home() || is_archive() || is_search() ) : // If viewing the blog, an archive, or search results. ?>

	<?php the_posts_pagination(
		array(
			'class' => 'posts-navigation',
			'prev_text' => esc_html_x( '&larr; Previous', 'posts navigation', 'wuqi' ), 
			'next_text' => esc_html_x( 'Next &rarr;',     'posts navigation', 'wuqi' )
		) 
	); ?>

<?php endif; // End check for type of page being viewed. ?>