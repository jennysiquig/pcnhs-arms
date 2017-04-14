<?php ob_start(); ?>
<?php session_start(); ?>
<?php
	// Query
	require_once '../../resources/config.php';
	// +++++++++++++++++
	$stud_id = $_GET['stud_id'];
	$cred_id = htmlspecialchars($_POST['credential'], ENT_QUOTES);
    $request_type = htmlspecialchars($_POST['request_type'], ENT_QUOTES);
    $signatory = htmlspecialchars($_POST['signatory'], ENT_QUOTES);
    $personnel_id = htmlspecialchars($_SESSION['per_id'], ENT_QUOTES);
    $date = htmlspecialchars($_POST['date'], ENT_QUOTES);
    $admitted_to = htmlspecialchars($_POST['admitted_to'], ENT_QUOTES);
    $request_purpose = strtoupper(htmlspecialchars($_POST['request_purpose']));
    //$remarks = htmlspecialchars($_POST['remarks'], ENT_QUOTES);

    $checkpending = "SELECT * FROM pcnhsdb.requests where status = 'p' and stud_id = '$stud_id' order by req_id desc limit 1;";
    $result = $conn->query($checkpending);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $req_id = $row['req_id'];
            $update = "UPDATE `pcnhsdb`.`requests` SET `request_type`='$request_type', `status`='u' ,`admitted_to` = '$admitted_to' , `sign_id`='$signatory' WHERE `req_id`='$req_id';";

            //mysqli_query($conn, $update);
        }
    }else {
         $statement1 = "INSERT INTO `pcnhsdb`.`requests` (`cred_id`, `stud_id`, `request_type`, `status`, `date_processed`, `admitted_to`, `request_purpose`, `sign_id`, `per_id`) VALUES ('$cred_id', '$stud_id', '$request_type', 'u', '$date', '$admitted_to', '$request_purpose' ,'$signatory', '$personnel_id');";

        //mysqli_query($conn, $statement1);
    }
    // ++++++++++++++++
	if(!$conn) {
		die();
	}
	$cred_id;
	$statement = "SELECT curr_id FROM pcnhsdb.students where stud_id = '$stud_id';";
	$result = $conn->query($statement); 
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$curr_id = $row['curr_id'];
		}
	}

	header("location: k_12form.php?stud_id=$stud_id&cred_id=$cred_id&request_type=$request_type&signatory=$signatory&personnel_id=$personnel_id&date=$date&admitted_to=$admitted_to&request_purpose=$request_purpose");
	

	

?>