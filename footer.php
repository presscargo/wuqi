<?php
/**
 * The footer
 */
?>
		<?php hybrid_get_sidebar( 'primary' ); // Loads the sidebar/primary.php template. ?>

		<?php hybrid_get_sidebar( 'secondary' ); // Loads the sidebar/secondary.php template. ?>

		</div>

	</div><!-- #main -->

	<div class="footer-widgets">

		<div class="footer-widgets-wrap">

			<aside <?php hybrid_attr( 'sidebar', 'footer-1' ); ?>>

				<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>

					<?php dynamic_sidebar( 'footer-1' ); ?>

				<?php endif; ?>

			</aside>

			<aside <?php hybrid_attr( 'sidebar', 'footer-2' ); ?>>

				<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>

					<?php dynamic_sidebar( 'footer-2' ); ?>

				<?php endif; ?>

			</aside>

			<aside <?php hybrid_attr( 'sidebar', 'footer-3' ); ?>>

				<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>

					<?php dynamic_sidebar( 'footer-3' ); ?>

				<?php endif; ?>

			</aside>

		</div>

	</div>

	<footer <?php hybrid_attr( 'footer' ); ?>>

		<div class="footer-wrap">

			<div class="colophon">

				<p class="credit">
					<?php printf(
						// Translators: 1 is current year, 2 is site name/link, 3 is WordPress name/link, and 4 is theme name/link.
						esc_html__( 'Copyright &#169; %1$s %2$s. Powered by %3$s and %4$s.', 'wuqi' ),
						date_i18n( 'Y' ), hybrid_get_site_link(), hybrid_get_wp_link(), hybrid_get_theme_link()
					); ?>
				</p><!-- .credit -->

			</div>

		</div>

	</footer><!-- #footer -->

<?php wp_footer(); // WordPress hook for loading JavaScript, toolbar, and other things in the footer. ?>

</body>
</html>