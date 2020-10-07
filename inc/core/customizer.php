<?php
// Remove the layout section from Hybrid. We'll add it back another way
function wuqi_customize_register( $wp_customize ) {
	$wp_customize->remove_section( 'layout' );
}
add_action( 'customize_register', 'wuqi_customize_register' );

if ( ! class_exists( 'Kirki' ) ) {
	return;
}

// Config
Kirki::add_config( 'wuqi', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
) );

// Links
Kirki::add_section( 'morelink', array(
	'title'       => esc_html__( 'Press Cargo', 'wuqi' ),
	'type'        => 'link',
	'button_text' => esc_html__( 'View More Themes', 'wuqi' ),
	'button_url'  => 'https://presscargo.io/themes/',
	'priority'    => 13,
) );

Kirki::add_section( 'reviewlink', array(
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
Kirki::add_panel( 'content', array(
	'title'       => esc_html__( 'Content', 'wuqi' ),
	'priority'    => 30,
) );

// Section: General
Kirki::add_section( 'general', array(
	'priority'    => 10,
	'title'       => esc_html__( 'General', 'wuqi' ),
	'panel'       => 'content',
) );

Kirki::add_field( 'wuqi', [
	'type'        => 'radio',
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
Kirki::add_section( 'page', array(
	'priority'    => 20,
	'title'       => esc_html__( 'Page Layout', 'wuqi' ),
	'panel'       => 'content',
) );

Kirki::add_field( 'wuqi', [
	'type'        => 'radio-image',
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
Kirki::add_section( 'blog', array(
	'priority'    => 30,
	'title'       => esc_html__( 'Blog Layout', 'wuqi' ),
	'panel'       => 'content',
) );

Kirki::add_field( 'wuqi', [
	'type'        => 'radio-image',
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

Kirki::add_field( 'wuqi', [
	'type'        => 'radio',
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

Kirki::add_field( 'wuqi', [
	'type'        => 'radio',
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

Kirki::add_field( 'wuqi', [
	'type'        => 'radio',
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
Kirki::add_section( 'archive', array(
	'priority'    => 40,
	'title'       => esc_html__( 'Archive Layout', 'wuqi' ),
	'panel'       => 'content',
) );

Kirki::add_field( 'wuqi', [
	'type'        => 'radio-image',
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

Kirki::add_field( 'wuqi', [
	'type'        => 'radio',
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

Kirki::add_field( 'wuqi', [
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
Kirki::add_section( 'post', array(
	'priority'    => 50,
	'title'       => esc_html__( 'Post Layout', 'wuqi' ),
	'panel'       => 'content',
) );

Kirki::add_field( 'wuqi', [
	'type'        => 'radio-image',
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