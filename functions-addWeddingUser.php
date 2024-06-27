<?php

// Add Wedding / User page

function addDeadline($deadline, string $weddingID, string $weddingDate)
{
  $timeframe = $deadline['timeframe']['value'];
  $time = $deadline['time'];
  $date = date('Y-m-d', strtotime('-' . $time . ' ' . $timeframe, strtotime($weddingDate)));

  $dl = array('name' => $deadline['event'], 'date' => $date, 'payment_deadline' => $deadline['payment_deadline']);

  add_row('deadlines', $dl, $weddingID);
}

function addWeddingUser()
{
  $error = '';
  if (isset($_POST['action']) && $_POST['action'] === 'createWeddingUser') {
    $person1 = $_POST["person1"];
    $person2 = $_POST["person2"];
    $email = $_POST["email"];
    $weddingDate = $_POST["wedding_date"];

    $userName = [
      strtolower($person1), 'and', strtolower($person2),
    ];

    $displayNameParts = [
      $person1, '&', $person2,
    ];
    $displayName = implode(' ', $displayNameParts);

    // Create user
    $user_data = array(
      'user_login' => implode(',', $userName),
      'display_name' => $displayName,
      'user_pass' => 'Bruno319!',
      'user_email' => $email,
      'role' => 'wedding'
    );

    $newUserID = wp_insert_user($user_data);
    if (is_wp_error($newUserID)) {
      $error = $newUserID->get_error_message();
    } else {
      // Create wedding
      $wedding = array(
        'post_type' => 'wedding',
        'post_status' => 'publish',
        'post_title' => $displayName,
        'post_content' => '',
        'post_author' => $newUserID
      );
      $weddingID = wp_insert_post($wedding, true);

      if (is_wp_error($weddingID)) {
        $error = $weddingID->get_error_message();
      } else {
        // Add wedding meta
        $weddingDateID = update_field('wedding_date', $weddingDate, $weddingID);
        if (!$weddingDateID) {
          $error = 'Wedding meta failure';
        } else {
          // Add wedding deadlines
          $deadlines = get_field('deadlines_config', 'option');

          foreach ($deadlines as $dl) {
            addDeadline($dl, $weddingID, $weddingDate);
          }
        }
      }
    }

    if ($error) {
?>
      <div class="error notice">
        <p><?php echo $error; ?></p>
      </div>
    <?php
    } else {
      $user = get_user_by('id', $newUserID);
    ?>
      <div class="updated notice">
        <p>A wedding page has been created for <?php echo $user->display_name; ?> <a href="edit.php?post_type=wedding">here</a></a></p>
      </div>
  <?php
    }
  }
  ?>
  <div class="wrap">
    <h1 class="wp-heading-inline"><?php echo get_admin_page_title(); ?></h1>
    <form name="config_actions" action="" method="post">
      <table class="form-table">
        <tr>
          <th><label for="person1">Groom/Bride Name</label></th>
          <td><input type="text" class="regular-text" name="person1" value="" id="person1" required /></td>
        </tr>
        <tr>
          <th><label for="person2">Bride/Groom Name</label></th>
          <td><input type="text" class="regular-text" name="person2" value="" id="person2" required /></td>
        </tr>
        <tr>
          <th><label for="email">Email address</label></th>
          <td><input type="text" class="regular-text" name="email" value="" id="email" required /></td>
        </tr>
        <tr>
          <th><label for="wedding_date">Wedding Date</label></th>
          <td><input name="wedding_date" type="date" value="" required>
          <td>
        </tr>
      </table>
      <input type="hidden" name="action" value="createWeddingUser" />
      <p class="submit"><input type="submit" name="createuser" id="createusersub" class="button button-primary" value="Add New Couple"></p>
    </form>
  </div>
<?php
}

function addWeddingUserPage()
{
  add_submenu_page(
    'edit.php?post_type=wedding',
    'New Wedding Couple',
    'Add New Couple',
    'administrator',
    'new',
    'addWeddingUser'
  );
}
add_action('admin_menu', 'addWeddingUserPage');

function remove_existing_user_form()
{
  if (!is_super_admin()) {
    echo '<style>
        #add-existing-user,
        #add-existing-user + p,
        #adduser,
        h2#create-new-user,
        h2#create-new-user + p {
          display: none;
        }
      </style>';
  }
}
add_action('admin_head', 'remove_existing_user_form');
