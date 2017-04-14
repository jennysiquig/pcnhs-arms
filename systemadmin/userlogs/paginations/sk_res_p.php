<?php require_once "../resources/config.php"; ?>
<?php
$statement_disp = "select * from user_logs";
$rows = mysqli_num_rows(mysqli_query($conn, $statement_disp));

if ($rows > 50000) {
  $alert_type = "info";
  $error_message = "REMINDER: USER ACTIVITY LOGS TABLE WILL BE TRUNCATED ";
  $popover = new Popover();
  $popover->set_popover($alert_type, $error_message);
  $_SESSION['trunc_notif'] = $popover->get_popover();
  $sql = "TRUNCATE TABLE user_logs";
  mysqli_query($conn, $sql);
}

else {
  $total = ceil($rows / $limit);
  echo "<p>Showing $limit  Entries</p>";
  echo '<div class="pull-right">
                      <div class="col s12">
                      <ul class="pagination center-align">';
  if ($page > 1) {
    echo "<li class=''><a href='index.php?page=" . ($page - 1) . "&search_key=$search_key'>Previous</a></li>";
  }
  else
  if ($total <= 0) {
    echo '<li class="disabled"><a>Previous</a></li>';
  }
  else {
    echo '<li class="disabled"><a>Previous</a></li>';
  }

  $x = 0;
  $y = 0;
  if (($page + 5) <= $total) {
    if ($page >= 3) {
      $x = $page + 2;
    }
    else {
      $x = 5;
    }

    $y = $page;
    if ($y <= $total) {
      $y-= 2;
      if ($y < 1) {
        $y = 1;
      }
    }
  }
  else {
    $x = $total;
    $y = $total - 5;
    if ($y < 1) {
      $y = 1;
    }
  }

  for ($i = $y; $i <= $x; $i++) {
    if ($i == $page) {
      echo "<li class='active'><a href='index.php?page=$i'>$i</a></li>";
    }
    else {
      echo "<li class=''><a href='index.php?page=$i'>$i</a></li>";
    }
  }

  if ($total == 0) {
    echo "<li class='disabled'><a>Next</a></li>";
  }
  else if ($page != $total) {
    echo "<li class=''><a href='index.php?page=" . ($page + 1) . "'>Next</a></li>";
  }
  else {
    echo "<li class='disabled'><a>Next</a></li>";
  }

  echo "</ul></div></div>";
}

?>
