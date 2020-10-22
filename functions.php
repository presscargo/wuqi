<?php
/**
 * Wuqi functions and definitions
 *
 * @package    Wuqi
 * @subpackage Functions
 * @version    1.0.0
 * @author     David Sutoyo <david@smallharbor.com>
 * @copyright  Copyright (c) 2020, David Sutoyo
 * @link       https://github.com/dsutoyo/wuqiwp
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */


/**
 * Singleton class for launching the theme and setup configuration.
 *
 * @since  1.0.0
 * @access public
 */
final class Wuqi {

	/**
	 * Directory path to the theme folder.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $dir = '';

	/**
	 * Directory URI to the theme folder.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $uri = '';

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup();
			$instance->includes();
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Initial theme setup.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup() {

		$this->dir = trailingslashit( get_template_directory()     );
		$this->uri = trailingslashit( get_template_directory_uri() );

		/* Define Constants. */
		// Theme Version
		define( 'WUQI_VERSION', '1.0.1' );

		// Settings
		define( 'WUQI_SETTINGS', 'wuqi-settings' );

		// Theme Directory
		define( 'WUQI_DIR', trailingslashit( get_template_directory() ) );

		// Theme Directory URI
		define( 'WUQI_URI', trailingslashit( get_template_directory_uri() ) );
	}

	/**
	 * Loads include and admin files for the plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function includes() {
		// Load the Hybrid Core framework and theme files.
		require_once( $this->dir . 'library/hybrid.php' );

		require_once( $this->dir . 'inc/core/functions-scripts.php' );
		require_once( $this->dir . 'inc/core/functions-template.php' );

		require_once( $this->dir . 'inc/core/custom-header.php' );
		require_once( $this->dir . 'inc/core/template-tags.php' );

		require_once( $this->dir . 'inc/kirki/kirki.php' );
		require_once( $this->dir . 'inc/core/customizer.php' );
	}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Theme setup.
		add_action( 'after_setup_theme', array( $this, 'theme_setup' ),  5 );

		// Register menus.
		add_action( 'init', array( $this, 'register_menus' ) );

		// Register image sizes.
		add_action( 'init', array( $this, 'register_image_sizes' ) );

		// Register sidebars.
		add_action( 'widgets_init', array( $this, 'register_sidebars' ), 5 );

		// Register layouts.
		add_action( 'hybrid_register_layouts', array( $this, 'register_layouts' ) );
	}

	/**
	 * The theme setup function.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on wuqi, use a find and replace
		 * to change 'wuqi' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'wuqi', get_template_directory() . '/languages' );

		// Core custom logo.
		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 400,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		) );

		// Theme layouts.
		add_theme_support( 'theme-layouts', array( 'default' => is_rtl() ? '2c-r' :'2c-l' ) );

		// Get the image
		add_theme_support( 'get-the-image' );

		// Automatically add feed links to <head>.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Switch default core markup to output valid HTML5.
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'wuqi_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support( 'starter-content', array(
			'widgets' => array(
				'primary' => array(
					'search_primary' => array( 'search', array() ),
					'recent_primary' => array( 'recent-posts', array(
						'title' => 'Recent Posts',
					) ),
				),
				'secondary' => array(
					'search_secondary' => array( 'search', array() ),
					'recent_secondary' => array( 'recent-posts', array(
						'title' => 'Recent Posts',
					) ),
				),
			)
		) );

		// Handle content width for embeds and images.
		$GLOBALS['content_width'] = apply_filters( 'wuqi_content_width', 640 );
	}

	/**
	 * Registers nav menus.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register_menus() {
		register_nav_menu( 'primary',   _x( 'Primary',   'nav menu location', 'wuqi' ) );
	}

	/**
	 * Registers image sizes.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register_image_sizes() {
		add_image_size( 'wuqi-full', 1200, 500, true );
		add_image_size( 'wuqi-thumbnail', 360, 150, true );
	}

	/**
	 * Registers sidebars.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	function register_sidebars() {
		hybrid_register_sidebar(
			array(
				'id'          => 'primary',
				'name'        => _x( 'Page Sidebar', 'sidebar', 'wuqi' ),
				'description' => __( 'The main sidebar for pages. It is displayed on either the left or right side of the page based on the chosen layout.', 'wuqi' )
			)
		);

		hybrid_register_sidebar(
			array(
				'id'          => 'secondary',
				'name'        => _x( 'Blog Sidebar', 'sidebar', 'wuqi' ),
				'description' => __( 'The main sidebar for single blog posts and blog archives. It is displayed on either the left or right side of the page based on the chosen layout.', 'wuqi' )
			)
		);

		hybrid_register_sidebar(
			array(
				'id'          => 'footer-1',
				'name'        => _x( 'Footer One', 'sidebar', 'wuqi' ),
				'description' => __( 'Footer widget area one.', 'wuqi' )
			)
		);

		hybrid_register_sidebar(
			array(
				'id'          => 'footer-2',
				'name'        => _x( 'Footer Two', 'sidebar', 'wuqi' ),
				'description' => __( 'Footer widget area two.', 'wuqi' )
			)
		);

		hybrid_register_sidebar(
			array(
				'id'          => 'footer-3',
				'name'        => _x( 'Footer Three', 'sidebar', 'wuqi' ),
				'description' => __( 'Footer widget area three.', 'wuqi' )
			)
		);
	}

	/**
	 * Registers layouts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register_layouts() {
		hybrid_register_layout( '1c',        array( 'label' => __( '1 Column Wide',                'wuqi' ), 'image' => '%s/assets/images/layouts/1c.png' ) );
		hybrid_register_layout( '2c-l',      array( 'label' => __( '2 Columns: Content / Sidebar', 'wuqi' ), 'image' => '%s/assets/images/layouts/2c-l.png' ) );
	}
}

/**
 * Gets the instance of the `Wuqi` class.  This function is useful for quickly grabbing data
 * used throughout the theme.
 *
 * @since  1.0.0
 * @access public
 * @return object
 */
function wuqi() {
	return Wuqi::get_instance();
}

wuqi();