<?php
    require_once "resources/config.php";
    session_start();

    date_default_timezone_set('Asia/Manila');
    $loTime = date("h:i:sa");
    $_SESSION ['loTime'] = $loTime;
    $timeout_message;

    if (isset($_SESSION['timeout_message'])) {
        $timeout_message = $_SESSION['timeout_message'];
    }

    $log_id = $_SESSION['log_id'];
    $username = $_SESSION['username'];
    $accnt_type = $_SESSION['accnt_type'];
    $sDate = $_SESSION['sDate'];
    $liTime = $_SESSION['liTime'];

    $user_act = "N/A";
    foreach ($_SESSION['user_activity'] as $user_act) {
      if(is_null($user_act)) {
        $user_act = "N/A";
      }
        DB::insert('user_logs', array(
          'log_id' => $log_id,
          'user_name' => $username,
          'account_type' => $accnt_type,
          'log_date' => $sDate,
          'log_in_time' => $liTime,
          'log_out_time' => $loTime,
          'user_act' => $user_act
        ));
    }

    session_unset();
    session_destroy();
    session_start();
    $_SESSION['timeout_message'] = $timeout_message;
    header("location: login.php");
?>
