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
