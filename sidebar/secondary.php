<?php if ( '1c' !== hybrid_get_theme_layout() && ! is_page() ) : // If not a one-column layout. ?>

	<aside <?php hybrid_attr( 'sidebar', 'secondary' ); ?>>

		<?php if ( is_active_sidebar( 'secondary' ) ) : // If the sidebar has widgets. ?>

			<?php dynamic_sidebar( 'secondary' ); // Displays the secondary sidebar. ?>

		<?php endif; // End widgets check. ?>

	</aside><!-- #sidebar-secondary -->

<?php endif; // End layout check. ?>