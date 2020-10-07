<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Wuqi
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'wuqi' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="header-wrap">
			<div class="site-branding">
				<?php the_custom_logo(); ?>
				
				<?php if ( is_front_page() && is_home() ) :	?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php endif; ?>

				<?php $wuqi_description = get_bloginfo( 'description', 'display' ); ?>

				<?php if ( $wuqi_description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $wuqi_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="site-navigation main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
					<span><?php esc_html_e( 'Primary Menu', 'wuqi' ); ?></span>
				</button>
				<?php if ( has_nav_menu( 'primary' ) ) : ?>

					<?php
					wp_nav_menu( array(
						'theme_location' 	=> 'primary',
						'menu_id'           => 'menu-primary',
						'container_id'      => 'menu-primary-container'
					) );
					?>
				
				<?php endif; ?>
			</nav><!-- #site-navigation -->
		</div>
	</header><!-- #masthead -->

	
	<div class="site-custom-header">
		<?php $object_id = get_queried_object_id(); ?>

		<?php if ( is_singular() && has_post_thumbnail( $object_id ) ) : ?>
			<figure class="site-custom-header" style="background-image:url(<?php echo get_the_post_thumbnail_url( $object_id, 'full' ); ?>);">
					<?php echo get_the_post_thumbnail( $object_id ); ?>
			</figure>
		<?php elseif ( get_header_image() ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<figure class="site-custom-header" style="background-image:url(<?php header_image(); ?>);">
					<img src="<?php header_image(); ?>" width="<?php echo absint( get_custom_header()->width ); ?>" height="<?php echo absint( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				</figure>
			</a>
		<?php endif; ?>
	</div>

	<div id="main" class="main">

			<div class="content-wrap">
