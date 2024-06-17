<?php
/**
 * blissology functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package blissology
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function blissology_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on blissology, use a find and replace
		* to change 'blissology' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'blissology', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'blissology' ),
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
			'blissology_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

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
add_action( 'after_setup_theme', 'blissology_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blissology_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'blissology_content_width', 640 );
}
add_action( 'after_setup_theme', 'blissology_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function blissology_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'blissology' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'blissology' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'blissology_widgets_init' );

 
function blissology_scripts() {
	wp_enqueue_style( 'blissology-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'blissology-style', 'rtl', 'replace' );

	wp_enqueue_script( 'blissology-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'blissology_scripts' );

require get_template_directory() . '/inc/custom-header.php';

require get_template_directory() . '/inc/template-tags.php';

require get_template_directory() . '/inc/template-functions.php';

require get_template_directory() . '/inc/customizer.php';

if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Custom Post Types
 */
function defaultPostTypeArgs($name) {
  return [
    'public' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => $name),
    'show_in_rest' => true,
    'rest_base' => $name,
    'supports' => ['title'],
  ];
};
function blissologyCustomPosts() {
  register_post_type( 'accommodation',
    array_merge(
      array(
        'labels' => array(
          'name' => __( 'Accommodation' ),
          'all_items' => __( 'Rooms' ),
          'add_new' => __('Add New', 'accommodation'),
          'singular_name' => __( 'Room' )
        ),
        'menu_icon' => 'dashicons-admin-multisite',
        ),
      defaultPostTypeArgs('accommodation')
    )
  );
  register_post_type( 'menu',
    array_merge(
      array(
        'labels' => array(
          'name' => __( 'Menu' ),
          'all_items' => __( 'Menu Items' ),
          'add_new' => __('Add New', 'menu'),
          'singular_name' => __( 'Menu Item' )
        ),
        'menu_icon' => 'dashicons-food',
      ),
      defaultPostTypeArgs('menu')
    )
  );
  register_post_type( 'location',
    array_merge(
      array(
        'labels' => array(
          'name' => __( 'Locations' ),
          'add_new' => __('Add New', 'location'),
          'singular_name' => __( 'Location' )
        ),
        'menu_icon' => 'dashicons-location',
      ),
      defaultPostTypeArgs('location')
    )
  );
  register_post_type( 'schedule',
    array_merge(
      array(
        'labels' => array(
          'name' => __( 'Schedule' ),
          'all_items' => __( 'Schedule Items' ),
          'add_new' => __('Add New', 'schedule'),
          'singular_name' => __( 'Schedule Item' )
        ),
        'menu_icon' => 'dashicons-schedule',
      ),
      defaultPostTypeArgs('location')
    )
  );
  
  function defaultTaxonomyArgs($nameSingular, $namePlural, $slug) {
    return [
      'hierarchical' => true,
      'labels' => array(
        'name' => __( $namePlural, 'taxonomy general name' ),
        'singular_name' => __( $nameSingular, 'taxonomy singular name' ),
        'search_items' =>  __( "Search {$namePlural}" ),
        'all_items' => __( "All {$namePlural}" ),
        'parent_item' => __( "Parent {$nameSingular}" ),
        'parent_item_colon' => __( "Parent {$nameSingular}:" ),
        'edit_item' => __( "Edit {$nameSingular}" ),
        'update_item' => __( "Update {$nameSingular}" ),
        'add_new_item' => __( "Add New {$nameSingular}" ),
        'new_item_name' => __( "New {$nameSingular} Name" ),
        'menu_name' => __( $namePlural ),
      ),
      'rewrite' => array(
        'slug' => $slug, // This controls the base slug that will display before each term
        'with_front' => false, // Don't display the category base before "/locations/"
        'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
      ),
    ];
  };

  register_taxonomy('menuType', 'menu', defaultTaxonomyArgs('Menu Category', 'Menu Categories', 'menuTypes'));


  global $wp_rewrite;
  $wp_rewrite->set_permalink_structure( '/%postname%/' );
}
add_action( 'init', 'blissologyCustomPosts' );

function blissologyRemoveAdminPages() {
  if ( !is_super_admin() ) {
    remove_menu_page( 'themes.php' );    
    remove_menu_page( 'tools.php' );    
    remove_menu_page( 'plugins.php');
    remove_menu_page( 'edit.php?post_type=acf-field-group');
    remove_submenu_page( 'index.php', 'my-sites.php' );      
    remove_submenu_page( 'options-general.php', 'options-writing.php');
    remove_submenu_page( 'options-general.php', 'options-reading.php');
    remove_submenu_page( 'options-general.php', 'options-discussion.php');
    remove_submenu_page( 'options-general.php', 'options-media.php');
    remove_submenu_page( 'options-general.php', 'options-privacy.php');
    remove_submenu_page( 'options-general.php', 'options-permalink.php');
  }
  // remove_menu_page( 'edit.php' );   
  remove_menu_page( 'edit-comments.php' );   
  remove_menu_page( 'upload.php' );   
  remove_submenu_page( 'edit.php?post_type=acf-field-group','edit.php?post_type=acf-post-type');
}
add_action( 'admin_menu', 'blissologyRemoveAdminPages' );

function blissologyRemoveAdminBar() {
  if ( !is_super_admin() ) {
    show_admin_bar(false);
  }
  // add_filter( 'show_admin_bar', '__return_false' );
}
add_action('wp_before_admin_bar_render', 'blissologyRemoveAdminBar');

// Fix wordpress stripping custom port colon
add_filter( 'wp_normalize_site_data', function( $data ) {
    $data['domain'] = str_replace('50011', ':50011', $data['domain']);
    $data['domain'] = str_replace('::', ':', $data['domain']);
    return $data;
}, 50, 1 );