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

		<header class="entry-header">
			<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . hybrid_get_the_post_format_url() . '">', is_rtl() ? ' <span class="meta-nav">&larr;</span>' : ' <span class="meta-nav">&rarr;</span>' . '</a></h2>' ); ?>

			<ul class="entry-byline">
				<li><a href="<?php the_permalink(); ?>"><time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time></a></li>

				<?php hybrid_post_format_link(); ?>

				<?php if ( 0 < get_comments_number() ) : ?>
					<li><?php comments_popup_link( number_format_i18n( 0 ), number_format_i18n( 1 ), '%', 'comments-link', '' ); ?></li>
				<?php endif; ?>
				
				<?php if ( current_user_can( 'manage_options' ) ) : ?>
					<li><?php edit_post_link(); ?></li>
				<?php endif; ?>
			</ul><!-- .entry-byline -->
		</header><!-- .entry-header -->

	<?php endif; // End single post check. ?>

</article><!-- .entry -->