<?php
/**
 * Scripts and styles.
 *
 * @package    Wuqi
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

add_action( 'wp_enqueue_scripts', 'wuqi_scripts' );
add_action( 'wp_enqueue_scripts', 'wuqi_styles' );

/**
 * Load scripts for the front end.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function wuqi_scripts() {
	wp_enqueue_script( 'wuqi', get_template_directory_uri() . '/assets/js/app.js', array('jquery'), WUQI_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

/**
 * Load stylesheets for the front end.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function wuqi_styles() {
	wp_enqueue_style( 'wuqi-google-fonts', 'https://fonts.googleapis.com/css2?family=Sora:wght@200;300;400;500;600;700;800&display=swap' );
	wp_enqueue_style( 'wuqi-style', get_template_directory_uri() . '/assets/css/style.css', array(), WUQI_VERSION );
	wp_style_add_data( 'wuqi-style', 'rtl', 'replace' );
}