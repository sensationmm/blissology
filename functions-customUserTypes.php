<?php
remove_role('subscriber');
remove_role('editor');
remove_role('contributor');
remove_role('author');
add_role('wedding', 'Wedding Couple', array(
  'read' => true,
  'create_posts' => true,
  'edit_post' => true,
  'edit_posts' => true,
  'edit_others_posts' => false,
  'edit_published_posts' => true,
  'publish_posts' => true,
  'manage_categories' => false,
));
