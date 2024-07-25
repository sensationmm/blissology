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
    'supports' => array_merge(['title', 'author'], $taxonomies),
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
    'menu',
    array_merge(
      array(
        'labels' => defaultPostLabels('menu', 'Food', 'Food Item', 'Food Items'),
        'menu_icon' => 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGhlaWdodD0iMjRweCIgdmlld0JveD0iMCAtOTYwIDk2MCA5NjAiIHdpZHRoPSIyNHB4IiBmaWxsPSIjZThlYWVkIj48cGF0aCBkPSJtMTc1LTEyMC01Ni01NiA0MTAtNDEwcS0xOC00Mi01LTk1dDU3LTk1cTUzLTUzIDExOC02MnQxMDYgMzJxNDEgNDEgMzIgMTA2dC02MiAxMThxLTQyIDQ0LTk1IDU3dC05NS01bC01MCA1MCAzMDQgMzA0LTU2IDU2LTMwNC0zMDItMzA0IDMwMlptMTE4LTM0MkwxNzMtNTgycS01NC01NC01NC0xMjl0NTQtMTI5bDI0OCAyNTAtMTI4IDEyOFoiLz48L3N2Zz4=',
      ),
      defaultPostTypeArgs('menu')
    )
  );
  register_post_type(
    'drink',
    array_merge(
      array(
        'labels' => defaultPostLabels('drink', 'Drink', 'Drink Item', 'Drinks Items'),
        'menu_icon' => 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGhlaWdodD0iMjRweCIgdmlld0JveD0iMCAtOTYwIDk2MCA5NjAiIHdpZHRoPSIyNHB4IiBmaWxsPSIjZThlYWVkIj48cGF0aCBkPSJNMTIwLTgwdi04MGg4MHYtMTI4cS0zNS0xMi01Ny41LTQyLjVUMTIwLTQwMHYtMzIwaDI0MHYzMjBxMCAzOS0yMi41IDY5LjVUMjgwLTI4OHYxMjhoODB2ODBIMTIwWm04MC00NDBoODB2LTEyMGgtODB2MTIwWm00MCAxNjBxMTcgMCAyOC41LTExLjVUMjgwLTQwMHYtNDBoLTgwdjQwcTAgMTcgMTEuNSAyOC41VDI0MC0zNjBaTTUyMC04MHEtMzMgMC01Ni41LTIzLjVUNDQwLTE2MHYtMzgycTAtMjYgMTUtNDYuNXQzOS0yOS41bDM4LTE0cTE0LTUgMjEtMTQuNXQ3LTIzLjV2LTE3MHEwLTE3IDExLjUtMjguNVQ2MDAtODgwaDEyMHExNyAwIDI4LjUgMTEuNVQ3NjAtODQwdjE3MHEwIDE0IDcgMjMuNXQyMSAxNC41bDM4IDE0cTI0IDkgMzkgMjkuNXQxNSA0Ni41djM4MnEwIDMzLTIzLjUgNTYuNVQ4MDAtODBINTIwWm0xMjAtNjgwaDQwdi00MGgtNDB2NDBaTTUyMC00ODBoMjgwdi02MmwtMzgtMTRxLTM4LTE0LTYwLTQ0dC0yMi02OHYtMTJoLTQwdjEycTAgMzgtMjIgNjh0LTYwIDQ0bC0zOCAxNHY2MlptMCAzMjBoMjgwdi04MEg1MjB2ODBabTAtMTYwaDI4MHYtODBINTIwdjgwWk0yNDAtNDQwWm0yODAgMTIwdi04MCA4MFoiLz48L3N2Zz4=',
      ),
      defaultPostTypeArgs('drink')
    )
  );
  register_post_type(
    'upgrade',
    array_merge(
      array(
        'labels' => defaultPostLabels('upgrade', 'Upgrades', 'Upgrade', 'Upgrades'),
        'menu_icon' => 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGhlaWdodD0iMjRweCIgdmlld0JveD0iMCAtOTYwIDk2MCA5NjAiIHdpZHRoPSIyNHB4IiBmaWxsPSIjZThlYWVkIj48cGF0aCBkPSJtMzg3LTQxMiAzNS0xMTQtOTItNzRoMTE0bDM2LTExMiAzNiAxMTJoMTE0bC05MyA3NCAzNSAxMTQtOTItNzEtOTMgNzFaTTI0MC00MHYtMzA5cS0zOC00Mi01OS05NnQtMjEtMTE1cTAtMTM0IDkzLTIyN3QyMjctOTNxMTM0IDAgMjI3IDkzdDkzIDIyN3EwIDYxLTIxIDExNXQtNTkgOTZ2MzA5bC0yNDAtODAtMjQwIDgwWm0yNDAtMjgwcTEwMCAwIDE3MC03MHQ3MC0xNzBxMC0xMDAtNzAtMTcwdC0xNzAtNzBxLTEwMCAwLTE3MCA3MHQtNzAgMTcwcTAgMTAwIDcwIDE3MHQxNzAgNzBaTTMyMC0xNTlsMTYwLTQxIDE2MCA0MXYtMTI0cS0zNSAyMC03NS41IDMxLjVUNDgwLTI0MHEtNDQgMC04NC41LTExLjVUMzIwLTI4M3YxMjRabTE2MC02MloiLz48L3N2Zz4='
      ),
      defaultPostTypeArgs('upgrade')
    )
  );

  function addUpgradeIsUpgrade($postID)
  {
    if (get_post_type($postID) == 'upgrade') {
      update_field('is_upgrade', 1, $postID);
    }
  }
  add_action('wp_insert_post', 'addUpgradeIsUpgrade');


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
        'menu_icon' => 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGhlaWdodD0iMjRweCIgdmlld0JveD0iMCAtOTYwIDk2MCA5NjAiIHdpZHRoPSIyNHB4IiBmaWxsPSIjZThlYWVkIj48cGF0aCBkPSJNNDAtMjAwdi02MDBoODB2NDAwaDMyMHYtMzIwaDMyMHE2NiAwIDExMyA0N3Q0NyAxMTN2MzYwaC04MHYtMTIwSDEyMHYxMjBINDBabTI0MC0yNDBxLTUwIDAtODUtMzV0LTM1LTg1cTAtNTAgMzUtODV0ODUtMzVxNTAgMCA4NSAzNXQzNSA4NXEwIDUwLTM1IDg1dC04NSAzNVptMjQwIDQwaDMyMHYtMTYwcTAtMzMtMjMuNS01Ni41VDc2MC02NDBINTIwdjI0MFpNMjgwLTUyMHExNyAwIDI4LjUtMTEuNVQzMjAtNTYwcTAtMTctMTEuNS0yOC41VDI4MC02MDBxLTE3IDAtMjguNSAxMS41VDI0MC01NjBxMCAxNyAxMS41IDI4LjVUMjgwLTUyMFptMC00MFptMjQwLTgwdjI0MC0yNDBaIi8+PC9zdmc+',
      ),
      defaultPostTypeArgs('accommodation')
    )
  );
  register_post_type(
    'schedule',
    array_merge(
      array(
        'labels' => defaultPostLabels('schedule', 'Schedule', 'Schedule Item', 'Schedule Items'),
        'menu_icon' => 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGhlaWdodD0iMjRweCIgdmlld0JveD0iMCAtOTYwIDk2MCA5NjAiIHdpZHRoPSIyNHB4IiBmaWxsPSIjZThlYWVkIj48cGF0aCBkPSJtNjEyLTI5MiA1Ni01Ni0xNDgtMTQ4di0xODRoLTgwdjIxNmwxNzIgMTcyWk00ODAtODBxLTgzIDAtMTU2LTMxLjVUMTk3LTE5N3EtNTQtNTQtODUuNS0xMjdUODAtNDgwcTAtODMgMzEuNS0xNTZUMTk3LTc2M3E1NC01NCAxMjctODUuNVQ0ODAtODgwcTgzIDAgMTU2IDMxLjVUNzYzLTc2M3E1NCA1NCA4NS41IDEyN1Q4ODAtNDgwcTAgODMtMzEuNSAxNTZUNzYzLTE5N3EtNTQgNTQtMTI3IDg1LjVUNDgwLTgwWm0wLTQwMFptMCAzMjBxMTMzIDAgMjI2LjUtOTMuNVQ4MDAtNDgwcTAtMTMzLTkzLjUtMjI2LjVUNDgwLTgwMHEtMTMzIDAtMjI2LjUgOTMuNVQxNjAtNDgwcTAgMTMzIDkzLjUgMjI2LjVUNDgwLTE2MFoiLz48L3N2Zz4=',
      ),
      defaultPostTypeArgs('location')
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
  register_taxonomy('drinkType', 'drink', defaultTaxonomyArgs('Drink Category', 'Drink Categories', 'drinkTypes'));
  register_taxonomy('roomLocation', 'accommodation', defaultTaxonomyArgs('Room Location', 'Room Locations', 'roomLocations'));
  register_taxonomy('upgradeType', 'upgrade', defaultTaxonomyArgs('Upgrade Type', 'Upgrade Types', 'upgradeTypes'));

  global $wp_rewrite;
  $wp_rewrite->set_permalink_structure('/%postname%/');
}
add_action('init', 'blissologyCustomPosts');
