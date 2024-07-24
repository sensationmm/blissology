<?php
// Hide unnecessary admin pages
function blissologyRemoveAdminPages()
{
  if (!is_super_admin()) {
    remove_menu_page('index.php');
    remove_menu_page('edit.php');
    remove_menu_page('edit.php?post_type=page');
    remove_menu_page('themes.php');
    remove_menu_page('tools.php');
    remove_menu_page('plugins.php');
    remove_menu_page('edit.php?post_type=acf-field-group');
    remove_submenu_page('index.php', 'my-sites.php');
    remove_submenu_page('options-general.php', 'options-writing.php');
    remove_submenu_page('options-general.php', 'options-reading.php');
    remove_submenu_page('options-general.php', 'options-discussion.php');
    remove_submenu_page('options-general.php', 'options-media.php');
    remove_submenu_page('options-general.php', 'options-privacy.php');
    remove_submenu_page('options-general.php', 'options-permalink.php');
  }
  remove_menu_page('edit-comments.php');
  remove_menu_page('upload.php');
  remove_submenu_page('edit.php?post_type=acf-field-group', 'edit.php?post_type=acf-post-type');
}
add_action('admin_menu', 'blissologyRemoveAdminPages');

function blissologyRemoveAdminBar()
{
  if (!is_super_admin()) {
    show_admin_bar(false);
  }
  // add_filter( 'show_admin_bar', '__return_false' );
}
add_action('wp_before_admin_bar_render', 'blissologyRemoveAdminBar');

add_action("rest_api_init", function () {
  register_rest_route("/wp/v2/options", "/all", [
    "methods" => "GET",
    "callback" => "acf_options_route",
  ]);
});
function acf_options_route()
{
  return get_fields('options');
};

add_action('admin_enqueue_scripts', 'load_admin_styles');
function load_admin_styles()
{
  wp_enqueue_style('admin_css', get_template_directory_uri() . '/admin-style.css', false, '1.0.0');
}
