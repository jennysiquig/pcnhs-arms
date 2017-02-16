<?php
	require_once "../../../resources/config.php";

	if(!$conn) {
		die();
	}

	$stud_id = $_POST['stud_id'];
	$lastName = $_POST['lastName'];
	$firstName = $_POST['firstName'];
	$middleName = $_POST['middleName'];
	$gender = $_POST['gender'];
	$birthdate = $_POST['birthdate'];
	$barangay = $_POST['barangay'];
	$towncity = $_POST['towncity'];
	$province = $_POST['province'];
	$parent_name = $_POST['parent_name'];
	$occupation = $_POST['occupation'];
	$parent_address = $_POST['parent_address'];

	$updatestmnt1 = "UPDATE `pcnhsdb`.`students` SET `first_name`='$firstName', `mid_name`='$middleName', `last_name`='$lastName', `gender`='$gender', `birth_date`='$birthdate', `province`='$province', `towncity`='$towncity', `barangay`='$barangay' WHERE `stud_id`='$stud_id';";

	$updatestmnt2 = "UPDATE `pcnhsdb`.`parent` SET `pname`='$parent_name', `occupation`='$occupation', `address`='$parent_address' WHERE `stud_id`='$stud_id';
";
	mysqli_query($conn, $updatestmnt1);
	mysqli_query($conn, $updatestmnt2);


	header("location: ../student_info.php?stud_id=$stud_id");
?>