<?php
// Custom Post Types
function defaultPostLabels($slug, $title, $singular, $plural)
{
  return [
    'name' => __($title),
    'all_items' => __($plural),
    'add_new' => __("Add {$singular}", $slug),
    'add_new_item' => __("Add New {$singular}", $slug),
    'edit_item' => __("Edit {$singular}", $slug),
    'singular_name' => __($singular)
  ];
};
function defaultPostTypeArgs($name, $taxonomies = [])
{
  return [
    'public' => true,
    'has_archive' => true,
    'rewrite' => array('slug' => $name),
    'show_in_rest' => true,
    'rest_base' => $name,
    'supports' => array_merge(['title'], $taxonomies),
  ];
};
function blissologyCustomPosts()
{
  register_post_type(
    'wedding',
    array_merge(
      array(
        'labels' => defaultPostLabels('wedding', 'Weddings', 'Wedding', 'Weddings'),
        'menu_icon' => 'dashicons-heart',
      ),
      defaultPostTypeArgs('wedding'),
      array(
        'capability_type' => 'post',
        'capabilities' => array(
          'create_posts' => 'do_not_allow',
          'delete_posts' => 'do_not_allow',
        ),
        'map_meta_cap' => true,
      )
    )
  );
  register_post_type(
    'accommodation',
    array_merge(
      array(
        'labels' => array(
          'name' => __('Accommodation'),
          'all_items' => __('Rooms'),
          'add_new' => __('Add New', 'accommodation'),
          'singular_name' => __('Room')
        ),
        'labels' => defaultPostLabels('accommodation', 'Accommodation', 'Room', 'Rooms'),
        'menu_icon' => 'dashicons-admin-multisite',
      ),
      defaultPostTypeArgs('accommodation')
    )
  );
  register_post_type(
    'menu',
    array_merge(
      array(
        'labels' => defaultPostLabels('menu', 'Menu', 'Menu Item', 'Menu Items'),
        'menu_icon' => 'dashicons-food',
      ),
      defaultPostTypeArgs('menu')
    )
  );
  register_post_type(
    'location',
    array_merge(
      array(
        'labels' => defaultPostLabels('location', 'Locations', 'Location', 'Locations'),
        'menu_icon' => 'dashicons-location',
      ),
      defaultPostTypeArgs('location')
    )
  );
  register_post_type(
    'schedule',
    array_merge(
      array(
        'labels' => defaultPostLabels('schedule', 'Schedule', 'Schedule Item', 'Schedule Items'),
        'menu_icon' => 'dashicons-schedule',
      ),
      defaultPostTypeArgs('location')
    )
  );

  function defaultTaxonomyArgs($nameSingular, $namePlural, $slug)
  {
    return [
      'hierarchical' => true,
      'labels' => array(
        'name' => __($namePlural, 'taxonomy general name'),
        'singular_name' => __($nameSingular, 'taxonomy singular name'),
        'search_items' =>  __("Search {$namePlural}"),
        'all_items' => __("All {$namePlural}"),
        'parent_item' => __("Parent {$nameSingular}"),
        'parent_item_colon' => __("Parent {$nameSingular}:"),
        'edit_item' => __("Edit {$nameSingular}"),
        'update_item' => __("Update {$nameSingular}"),
        'add_new_item' => __("Add New {$nameSingular}"),
        'new_item_name' => __("New {$nameSingular} Name"),
        'menu_name' => __($namePlural),
      ),
      'rewrite' => array(
        'slug' => $slug, // This controls the base slug that will display before each term
        'with_front' => false, // Don't display the category base before "/locations/"
        'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
      ),

      'show_in_rest' => true,
    ];
  };

  register_taxonomy('menuType', 'menu', defaultTaxonomyArgs('Menu Category', 'Menu Categories', 'menuTypes'));

  global $wp_rewrite;
  $wp_rewrite->set_permalink_structure('/%postname%/');
}
add_action('init', 'blissologyCustomPosts');
