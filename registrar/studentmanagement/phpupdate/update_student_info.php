<?php
	require_once "../../../resources/config.php";

	if(!$conn) {
		die();
	}

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

	$updatestmnt1 = "UPDATE `pcnhsdb`.`students` SET `first_name`='$firstName', `mid_name`='$middleName', `last_name`='$lastName', `gender`='$gender', `birth_date`='$birthdate', `province`='$province', `towncity`='$towncity', `barangay`='$barangay' WHERE `stud_id`='$stud_id';";

	$updatestmnt2 = "UPDATE `pcnhsdb`.`parent` SET `pname`='$parent_name', `occupation`='$occupation', `address`='$parent_address' WHERE `stud_id`='$stud_id';
";
	mysqli_query($conn, $updatestmnt1);
	mysqli_query($conn, $updatestmnt2);

	$_SESSION['user_activity'][] = "Updated Info of: $stud_id";

	header("location: ../student_info.php?stud_id=$stud_id");
?>