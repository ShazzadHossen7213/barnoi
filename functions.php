<?php

/**
 * barnoi functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package barnoi
 */

if (! defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function barnoi_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on barnoi, use a find and replace
		* to change 'barnoi' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('barnoi', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'barnoi'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
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
			'barnoi_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'barnoi_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function barnoi_content_width()
{
	$GLOBALS['content_width'] = apply_filters('barnoi_content_width', 640);
}
add_action('after_setup_theme', 'barnoi_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function barnoi_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'barnoi'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'barnoi'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'barnoi_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function barnoi_scripts()
{
	wp_enqueue_style('barnoi-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('barnoi-style', 'rtl', 'replace');

	wp_enqueue_script('barnoi-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'barnoi_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Adding custom post.
 */

require get_template_directory() . '/inc/custom-post.php';

// Enqueue custom styles and scripts for the Barnoi theme
function barnoi_css_js_file_calling()
{
	// Enqueue custom CSS
	wp_enqueue_style('barnoi-style', get_stylesheet_uri());
	//wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '4.0.0', 'all');

	wp_enqueue_style('custom', get_template_directory_uri() . '/css/custom.css', array(), '1.0.0', 'all');
	wp_enqueue_style('fonts', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css



', array(), '1.0.0', 'all');


	//jQuery
	wp_enqueue_script('jquery');
	wp_register_script('bootstrap', get_template_directory_uri() . 'js/bootstrap.min.js', array(), '1.0.0', '4.0.0');


	wp_register_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css', array(), '4.5.2');

	// Register Bootstrap JS
	wp_register_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js', array('jquery'), '4.5.2', true);

	// Enqueue Bootstrap CSS
	wp_enqueue_style('bootstrap-css');

	// Enqueue Bootstrap JS
	wp_enqueue_script('bootstrap-js');
}
add_action('wp_enqueue_scripts', 'barnoi_css_js_file_calling');

function enqueue_teammember_admin_styles()
{
	// Check if we are in the admin and editing the teammember post type
	if (get_current_screen()->post_type === 'teammember') {
		wp_enqueue_style('teammember-admin-styles', get_template_directory_uri() . '/css/teammember.css');
	}
}
add_action('admin_enqueue_scripts', 'enqueue_teammember_admin_styles');
