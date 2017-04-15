<?php
	session_start();
	require_once "../../../resources/config.php";
	include '../../../resources/classes/Popover.php';
	if(!$conn) {
		die();
	}
	
	$willInsert = true;
	$stud_id = htmlspecialchars($_POST['stud_id'], ENT_QUOTES);
	$lastName = htmlspecialchars($_POST['lastName'], ENT_QUOTES);
	$firstName = htmlspecialchars($_POST['firstName'], ENT_QUOTES);
	$middleName = htmlspecialchars($_POST['middleName'], ENT_QUOTES);
	$gender = htmlspecialchars($_POST['gender'], ENT_QUOTES);
	$birthdate = htmlspecialchars($_POST['birthdate']);
	$barangay = htmlspecialchars($_POST['barangay'], ENT_QUOTES);
	$towncity = htmlspecialchars($_POST['towncity'], ENT_QUOTES);
	$province = htmlspecialchars($_POST['province'], ENT_QUOTES);
	$parent_name = htmlspecialchars($_POST['parent_name'], ENT_QUOTES);
	$occupation = htmlspecialchars($_POST['occupation'], ENT_QUOTES);
	$parent_address = htmlspecialchars($_POST['parent_address'], ENT_QUOTES);
	$total_elem_years = htmlspecialchars($_POST['total_elem_years'], ENT_QUOTES);
	$gpa = htmlspecialchars($_POST['gpa'], ENT_QUOTES);

	if(!is_numeric($gpa)) {
		$gpa = 0;
	}
	if ($total_elem_years < 5) {
		$willInsert = false;
		$alert_type = "danger";
		$error_message = "Invalid Total Elementary Years.";
		$popover = new Popover();
		$popover->set_popover($alert_type, $error_message);
		$_SESSION['error_pop'] = $popover->get_popover();
		header("location: ".$_SERVER['HTTP_REFERER']);
		die();
	}

	$updatestmnt1 = "UPDATE `pcnhsdb`.`students` SET `first_name`='$firstName', `mid_name`='$middleName', `last_name`='$lastName', `gender`='$gender', `birth_date`='$birthdate', `province`='$province', `towncity`='$towncity', `barangay`='$barangay' WHERE `stud_id`='$stud_id';";

	$updatestmnt2 = "UPDATE `pcnhsdb`.`parent` SET `pname`='$parent_name', `occupation`='$occupation', `address`='$parent_address' WHERE `stud_id`='$stud_id';";

	$updatestmnt3 = "UPDATE `pcnhsdb`.`primaryschool` SET `total_elem_years`='$total_elem_years', `gen_average`='$gpa' WHERE `stud_id`='$stud_id';";

	if($willInsert) {
		mysqli_query($conn, $updatestmnt1);
		mysqli_query($conn, $updatestmnt2);
		mysqli_query($conn, $updatestmnt3);

		$_SESSION['user_activity'][] = "UPDATED INFORMATION OF: $stud_id";

		header("location: ../student_info.php?stud_id=$stud_id");
	}
?>