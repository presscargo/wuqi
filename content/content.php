<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_singular( get_post_type() ) ) : // If viewing a single post. ?>

		<header class="entry-header">
			<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>

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

		<?php if ( ( is_home() && 'visible' == get_theme_mod( 'blog_post_thumbnail', 'visible' ) ) || ( is_archive() && 'visible' == get_theme_mod( 'archive_post_thumbnail', 'visible' ) ) ) : ?>
			<div class="entry-featured-media">
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( 'wuqi-full' ); ?>
				<?php else : ?>
					<div class="wuqi-placeholder"></div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<header class="entry-header">
			<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . get_permalink() . '" rel="bookmark" itemprop="url">', '</a></h2>' ); ?>

			<?php wuqi_entry_byline(); ?>
		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-summary' ); ?>>
			<?php if ( strpos( get_the_content(), '<!--more-->' ) || strpos( get_the_content(), 'more-link' ) ) : ?>
				<?php the_content(); ?>
			<?php else : ?>
				<?php the_excerpt(); ?>
			<?php endif; ?>
		</div><!-- .entry-summary -->

	<?php endif; // End single post check. ?>

</article><!-- .entry -->