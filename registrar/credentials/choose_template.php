<?php ob_start(); ?>
<?php session_start(); ?>
<?php
	// Query
	require_once '../../resources/config.php';

    if(!isset($_SESSION['generated_form137'])) {
        $_SESSION['generated_form137'] = true;
    }else {
        if($_SESSION['generated_form137']) {
            unset($_SESSION['generated_form137']);
            header("location: ../../index.php");
            die();
        }
    }
	// +++++++++++++++++
	$stud_id = $_GET['stud_id'];
	$cred_id = htmlspecialchars($_POST['credential'], ENT_QUOTES);
    $request_type = htmlspecialchars($_POST['request_type'], ENT_QUOTES);
    $signatory = htmlspecialchars($_POST['signatory'], ENT_QUOTES);
    $for_signature = htmlspecialchars($_POST['for_signature'], ENT_QUOTES);
    $personnel_id = htmlspecialchars($_SESSION['per_id'], ENT_QUOTES);
    $date = htmlspecialchars($_POST['date'], ENT_QUOTES);
    $admitted_to = htmlspecialchars($_POST['admitted_to'], ENT_QUOTES);
    $request_purpose = strtoupper(htmlspecialchars($_POST['request_purpose']));
    //$remarks = htmlspecialchars($_POST['remarks'], ENT_QUOTES);
     if(empty($admitted_to)) {
      $admitted_to = "N/A";
    }

    $checkpending = "SELECT * FROM pcnhsdb.requests where status = 'p' and stud_id = '$stud_id' and cred_id = '$cred_id' order by req_id desc limit 1;";
    $result = DB::query($checkpending);
		if(count($result) > 0) {
			foreach ($result as $row) {
				$req_id = $row['req_id'];
				DB::update('requests', array(
					'request_type' => $request_type,
					'status' => 'u',
					'admitted_to' => $admitted_to,
					'sign_id' => $signatory
				), "req_id=%i", $req_id);
			}

		}
		else {
        DB::insert('requests', array(
					'cred_id' => $cred_id,
					'stud_id' => $stud_id,
					'request_type' => $request_type,
					'status' => 'u',
					'date_processed' => $date,
					'admitted_to' => $admitted_to,
					'request_purpose' => $request_purpose,
					'sign_id' => $signatory,
					'per_id' => $personnel_id
				));
    }
    // ++++++++++++++++

	$cred_id;
	$statement = "SELECT curr_id FROM pcnhsdb.students where stud_id = '$stud_id';";
	$result = DB::query($statement);
	if(count($result) > 0) {
		foreach ($result as $row) {
			$curr_id = $row['curr_id'];
		}
	}



	header("location: k_12form.php?stud_id=$stud_id&cred_id=$cred_id&request_type=$request_type&signatory=$signatory&personnel_id=$personnel_id&date=$date&admitted_to=$admitted_to&request_purpose=$request_purpose&for_signature=$for_signature");

?>
