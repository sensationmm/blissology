<?php
remove_role('subscriber');
remove_role('editor');
remove_role('contributor');
remove_role('author');
add_role('wedding', 'Wedding Couple', array(
  'read' => true,
  'create_posts' => true,
  'edit_posts' => true,
  'edit_others_posts' => false,
  'publish_posts' => true,
  'manage_categories' => false,
));
