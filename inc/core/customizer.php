<?php
// Remove the layout section from Hybrid. We'll add it back another way
function wuqi_customize_register( $wp_customize ) {
	$wp_customize->remove_section( 'layout' );
}
add_action( 'customize_register', 'wuqi_customize_register' );

if ( ! class_exists( 'Kirki' ) ) {
	return;
}

// Links
new \Kirki\Section( 'morelink', array(
	'title'       => esc_html__( 'Press Cargo', 'wuqi' ),
	'type'        => 'link',
	'button_text' => esc_html__( 'View More Themes', 'wuqi' ),
	'button_url'  => 'https://presscargo.io/themes/',
	'priority'    => 13,
) );

new \Kirki\Section( 'reviewlink', array(
	'title'       => esc_html__( 'Like This Theme?', 'wuqi' ),
	'panel'       => 'options',
	'type'        => 'link',
	'button_text' => esc_html__( 'Write a Review', 'wuqi' ),
	'button_url'  => 'https://wordpress.org/support/theme/wuqi/reviews/#new-post',
	'priority'    => 1,
) );

/*
 * =============================
 * Content
 * ============================= 
 */

// Panel
new \Kirki\Panel( 'content', array(
	'title'       => esc_html__( 'Content', 'wuqi' ),
	'priority'    => 30,
) );

// Section: General
new \Kirki\Section( 'general', array(
	'priority'    => 10,
	'title'       => esc_html__( 'General', 'wuqi' ),
	'panel'       => 'content',
) );

new \Kirki\Field\Radio( [
	'settings'    => 'general_post_author',
	'label'       => esc_html__( 'Post Author', 'wuqi' ),
	'section'     => 'general',
	'default'     => 'visible',
	'priority'    => 40,
	'choices'     => [
		'visible'   => esc_html__( 'Visible', 'wuqi' ),
		'hidden' => esc_html__( 'Hidden', 'wuqi' )
	],
] );

// Section: Page Layout
new \Kirki\Section( 'page', array(
	'priority'    => 20,
	'title'       => esc_html__( 'Page Layout', 'wuqi' ),
	'panel'       => 'content',
) );

new \Kirki\Field\Radio_Image( [
	'settings'    => 'page_layout',
	'label'       => esc_html__( 'Page Layout', 'wuqi' ),
	'section'     => 'page',
	'default'     => '2c-l',
	'priority'    => 10,
	'choices'     => [
		'2c-l'   => get_template_directory_uri() . '/assets/images/layouts/2c-l.png',
		'1c'     => get_template_directory_uri() . '/assets/images/layouts/1c.png',
	],
] );

// Section: Blog Layout
new \Kirki\Section( 'blog', array(
	'priority'    => 30,
	'title'       => esc_html__( 'Blog Layout', 'wuqi' ),
	'panel'       => 'content',
) );

new \Kirki\Field\Radio_Image( [
	'settings'    => 'blog_layout',
	'label'       => esc_html__( 'Blog Layout', 'wuqi' ),
	'section'     => 'blog',
	'default'     => '1c',
	'priority'    => 10,
	'choices'     => [
		'2c-l'   => get_template_directory_uri() . '/assets/images/layouts/2c-l.png',
		'1c'     => get_template_directory_uri() . '/assets/images/layouts/1c.png',
	],
] );

new \Kirki\Field\Radio( [
	'settings'    => 'blog_post_display',
	'label'       => esc_html__( 'Post Display', 'wuqi' ),
	'section'     => 'blog',
	'default'     => 'tiled',
	'priority'    => 20,
	'choices'     => [
		'tiled'   => esc_html__( 'Tiled', 'wuqi' ),
		'list' => esc_html__( 'List', 'wuqi' )
	],
] );

new \Kirki\Field\Radio( [
	'settings'    => 'blog_post_thumbnail',
	'label'       => esc_html__( 'Post Thumbnail', 'wuqi' ),
	'section'     => 'blog',
	'default'     => 'visible',
	'priority'    => 30,
	'choices'     => [
		'visible'   => esc_html__( 'Visible', 'wuqi' ),
		'hidden' => esc_html__( 'Hidden', 'wuqi' )
	],
] );

new \Kirki\Field\Radio( [
	'settings'    => 'blog_post_first_thumbnail',
	'label'       => esc_html__( 'Thumbnail of First Post', 'wuqi' ),
	'section'     => 'blog',
	'default'     => 'hidden',
	'priority'    => 30,
	'choices'     => [
		'visible'   => esc_html__( 'Visible', 'wuqi' ),
		'hidden' => esc_html__( 'Hidden', 'wuqi' )
	],
] );

// Section: Archive Layout
new \Kirki\Section( 'archive', array(
	'priority'    => 40,
	'title'       => esc_html__( 'Archive Layout', 'wuqi' ),
	'panel'       => 'content',
) );

new \Kirki\Field\Radio_Image( [
	'settings'    => 'archive_layout',
	'label'       => esc_html__( 'Archive Layout', 'wuqi' ),
	'section'     => 'archive',
	'default'     => '2c-l',
	'priority'    => 10,
	'choices'     => [
		'2c-l'   => get_template_directory_uri() . '/assets/images/layouts/2c-l.png',
		'1c'     => get_template_directory_uri() . '/assets/images/layouts/1c.png',
	],
] );

new \Kirki\Field\Radio( [

	'settings'    => 'archive_post_display',
	'label'       => esc_html__( 'Post Display', 'wuqi' ),
	'section'     => 'archive',
	'default'     => 'tiled',
	'priority'    => 20,
	'choices'     => [
		'tiled'   => esc_html__( 'Tiled', 'wuqi' ),
		'list' => esc_html__( 'List', 'wuqi' )
	],
] );

new \Kirki\Field\Radio( [
	'type'        => 'radio',
	'settings'    => 'archive_post_thumbnail',
	'label'       => esc_html__( 'Post Thumbnail', 'wuqi' ),
	'section'     => 'archive',
	'default'     => 'visible',
	'priority'    => 30,
	'choices'     => [
		'visible'   => esc_html__( 'Visible', 'wuqi' ),
		'hidden' => esc_html__( 'Hidden', 'wuqi' )
	],
] );

// Section: Post Layout
new \Kirki\Section( 'post', array(
	'priority'    => 50,
	'title'       => esc_html__( 'Post Layout', 'wuqi' ),
	'panel'       => 'content',
) );

new \Kirki\Field\Radio_Image( [
	'settings'    => 'post_layout',
	'label'       => esc_html__( 'Post Layout', 'wuqi' ),
	'section'     => 'post',
	'default'     => '2c-l',
	'priority'    => 10,
	'choices'     => [
		'2c-l'   => get_template_directory_uri() . '/assets/images/layouts/2c-l.png',
		'1c'     => get_template_directory_uri() . '/assets/images/layouts/1c.png',
	],
] );

// Section: Colors
// This is a preset section
new \Kirki\Field\Color( [
	'settings'    => 'header_mobile_bg_color',
	'label'       => __( 'Mobile Header Background Color', 'wuqi' ),
	'section'     => 'colors',
	'default'     => '#000000',
	'output'      => array(
		array(
			'element' => '.header-wrap',
			'property' => 'background-color',
			'media_query' => '@media (max-width: 1024px)'
		)
	)
] );

new \Kirki\Field\Color( [
	'settings'    => 'header_mobile_text_color',
	'label'       => __( 'Mobile Header Text Color', 'wuqi' ),
	'section'     => 'colors',
	'default'     => '#ffffff',
	'output'      => array(
		array(
			'element' => '.site-header a',
			'property' => 'color',
			'media_query' => '@media (max-width: 1024px)'
		),
		array(
			'element' => '.menu-toggle span, .menu-toggle span:before, .menu-toggle span:after',
			'property' => 'background-color',
			'media_query' => '@media (max-width: 1024px)'
		)
	)
] );