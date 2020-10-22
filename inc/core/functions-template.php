<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Wuqi
 */

/**
 * Filter the body attributes.
 *
 * @since  1.0.0
 * @access public
 * @return array
 */
function wuqi_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( is_home() ) {
		$classes[] = esc_attr( 'layout-' . get_theme_mod( 'blog_post_display', 'tiled' ) );
		$classes[] = esc_attr( 'blog-post-first-thumbnail-' . get_theme_mod( 'blog_post_first_thumbnail', 'hidden' ) );
	}

	if ( is_archive() || is_search() ) {
		$classes[] = esc_attr( 'layout-' . get_theme_mod( 'archive_post_display', 'tiled' ) );
	}

	return $classes;
}
add_filter( 'body_class', 'wuqi_body_classes' );

/**
 * Filter the branding attributes.
 *
 * @since  1.0.0
 * @access public
 * @return array
 */
function wuqi_attr_content( $attr ) {
	$attr['id'] = 'content-primary';
	return $attr;
}
add_filter( 'hybrid_attr_content', 'wuqi_attr_content' );

/**
 * Filter the branding attributes.
 *
 * @since  1.0.0
 * @access public
 * @return array
 */
function wuqi_attr_sidebar( $attr, $context ) {
	if ( 'primary' == $context || 'secondary' == $context ) {
		$attr['id'] = 'content-secondary';
	}
	return $attr;
}
add_filter( 'hybrid_attr_sidebar', 'wuqi_attr_sidebar', 10, 2 );

/**
 * Filters the default theme layout. Metaboxes options should still be able
 * to override these.
 *
 * @since  1.0.0
 * @access public
 * @return array
 */
function wuqi_theme_layout( $theme_layout ) {

	/* If viewing a singular post, get the post layout. */
	if ( is_singular() )
		$layout = hybrid_get_post_layout( get_queried_object_id() );

	/* If viewing an author archive, get the user layout. */
	elseif ( is_author() )
		$layout = hybrid_get_user_layout( get_queried_object_id() );

	/* If a layout was found, set it. */
	if ( !empty( $layout ) && 'default' !== $layout ) {
		$theme_layout = $layout;
	}

	else {
		if ( is_home() ) {
			$layout = get_theme_mod( 'blog_layout', '1c' );
		}

		if ( is_archive() || is_search() ) {
			$layout = get_theme_mod( 'archive_layout', '2c-l' );
		}

		if ( is_page() ) {
			$layout = get_theme_mod( 'page_layout', '2c-l' );
		}

		if ( is_single() ) {
			$layout = get_theme_mod( 'post_layout', '2c-l' );
		}

		if ( ! empty( $layout ) ) $theme_layout = $layout;
	}

	return $theme_layout;
}
add_filter( 'hybrid_get_theme_layout', 'wuqi_theme_layout', 5 );


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function wuqi_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'wuqi_pingback_header' );

/**
 * Add markup for dropdown arrows
 *
 * @since  1.0.0
 * @access public
 * @return string
 */
function wuqi_nav_menu_arrow( $item_output, $item, $depth, $args ) {
	if ( in_array( 'menu-item-has-children', $item->classes ) ){
        $item_output .= '<span class="wuqi-dropdown-arrow"></span>';
    }
	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'wuqi_nav_menu_arrow', 10, 4 );

/**
 * Filter the excerpt length
 *
 * @since  1.0.0
 * @access public
 * @return int
 */
function wuqi_excerpt_length( $length ) {
	if ( is_admin() ) {
		return $length;
	}
	
	return 40;
}
add_filter( 'excerpt_length', 'wuqi_excerpt_length', 999 );