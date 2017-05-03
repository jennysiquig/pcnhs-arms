<?php
    require_once "../../../resources/config.php";
    session_start();

    $stud_id = htmlspecialchars($_GET['stud_id'], ENT_QUOTES);
    $cred_id = htmlspecialchars($_POST['credential'], ENT_QUOTES);
    $request_type = htmlspecialchars($_POST['request_type'], ENT_QUOTES);
    $personnel_id = htmlspecialchars($_SESSION['per_id'], ENT_QUOTES);
    $date = htmlspecialchars($_POST['date'], ENT_QUOTES);
    $request_purpose = strtoupper(htmlspecialchars($_POST['request_purpose']));
    $admitted_to = "N/A";

    $checkpending = "SELECT * FROM pcnhsdb.requests where status = 'p' and stud_id = '$stud_id' and cred_id = '$cred_id' order by req_id desc limit 1;";
    $result = DB::query($checkpending);
    if (count($result) > 0) {
      foreach ($result as $row) {
            $req_id = $row['req_id'];
            DB::update('requests', array(
              'request_type' => $request_type,
              'status' => 'u',
              'admitted_to' => $admitted_to
            ), "req_id=%i", $req_id);
            header("location: ../unclaimed.php");
            die();
        }
    }else {
        DB::insert('requests', array(
          'cred_id' => $cred_id,
          'stud_id' => $stud_id,
          'request_type' => $request_type,
          'status' => 'u',
          'date_processed' => $date,
          'admitted_to' => $admitted_to,
          'request_purpose' => $request_purpose,
          'sign_id' => '',
          'per_id' => $personnel_id
        ));

        header("location: ../unclaimed.php");
        die();
    }



?>
