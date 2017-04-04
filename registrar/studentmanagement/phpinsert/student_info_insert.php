<?php
	require_once "../../../resources/config.php";
	include('../../../resources/classes/Popover.php');
	if(!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	session_start();


	$stud_id = htmlspecialchars(filter_var($_POST['stud_id'], FILTER_SANITIZE_STRING));
	$first_name = htmlspecialchars(filter_var($_POST['first_name'], FILTER_SANITIZE_STRING));
	$mid_name = htmlspecialchars(filter_var($_POST['mid_name'], FILTER_SANITIZE_STRING));
	$last_name = htmlspecialchars(filter_var($_POST['last_name'], FILTER_SANITIZE_STRING));
	$gender = htmlspecialchars(filter_var($_POST['gender'], FILTER_SANITIZE_STRING));

	$birth_date = htmlspecialchars(filter_var($_POST['birthdate']));

	$province = htmlspecialchars(filter_var($_POST['birth_place_province'], FILTER_SANITIZE_STRING));
	$towncity = htmlspecialchars(filter_var($_POST['birth_place_towncity'], FILTER_SANITIZE_STRING));
	$barangay = htmlspecialchars(filter_var($_POST['birth_place_barangay'], FILTER_SANITIZE_STRING));

	$second_school_name = htmlspecialchars(filter_var($_POST['second_school_name'], FILTER_SANITIZE_STRING));
	$program = htmlspecialchars(filter_var($_POST['program'], FILTER_SANITIZE_STRING));
	$curriculum = htmlspecialchars(filter_var($_POST['curriculum'], FILTER_SANITIZE_STRING));

	$pname = htmlspecialchars(filter_var($_POST['pname'], FILTER_SANITIZE_STRING));
	$parent_occupation = htmlspecialchars(filter_var($_POST['occupation'], FILTER_SANITIZE_STRING));
	$parent_address = htmlspecialchars(filter_var($_POST['parent_address'], FILTER_SANITIZE_STRING));

	$primary_schl_name = htmlspecialchars(filter_var($_POST['schl_name'], FILTER_SANITIZE_STRING));
	$primary_schl_year = htmlspecialchars($_POST['schl_year'], FILTER_SANITIZE_STRING);
	$total_elem_years = htmlspecialchars(filter_var($_POST['total_elem_years'], FILTER_SANITIZE_STRING));
	$gpa = htmlspecialchars(filter_var($_POST['gpa'], FILTER_SANITIZE_STRING));
	$willInsert = true;
	
	
// validate gpa
	if($gpa > 99.99 || $gpa < 75) {
		$willInsert = false;
		$alert_type = "danger";
		$error_message = "You have entered an invalid Average Grade.";
		$popover = new Popover();
		$popover->set_popover($alert_type, $error_message);	
		$_SESSION['error_pop'] = $popover->get_popover();
		header("Location: " . $_SERVER["HTTP_REFERER"]);
		
	}

	$validate_p_schl_yr = explode("-", $primary_schl_year);
	$year1 = $validate_p_schl_yr[0];
	$year2 = $validate_p_schl_yr[1];
// validate primary school year
	if(intval($year1) > intval($year2) || intval($year2) != (intval($year1)+1) ) {
		$willInsert = false;
		$alert_type = "danger";
		$error_message = "You have entered an invalid Primary School Year.";
		$popover = new Popover();
		$popover->set_popover($alert_type, $error_message);	
		$_SESSION['error_pop'] = $popover->get_popover();
		header("Location: " . $_SERVER["HTTP_REFERER"]);
	}
// validate empty inputs
	if(empty($stud_id) || empty($first_name) || empty($last_name) || empty($province) || empty($towncity) || empty($pname) || empty($parent_occupation) || empty($parent_address) || empty($primary_schl_name) || empty($primary_schl_year) || empty($total_elem_years) || empty($gender) || empty($second_school_name)) {

		$willInsert = false;
		$alert_type = "danger";
		$error_message = "Cannot insert to database. Please make sure that you have input a valid value.";
		$popover = new Popover();
		$popover->set_popover($alert_type, $error_message);	
		$_SESSION['error_pop'] = $popover->get_popover();
		header("Location: " . $_SERVER["HTTP_REFERER"]);

	}
// Duplicate Checker
	$selectStudents = "SELECT * from students where stud_id = '$stud_id' and first_name = '$first_name' and last_name = '$last_name' and birth_date = '$birth_date';";
	$result = $conn->query($selectStudents);
	if ($result->num_rows > 0) {
		$willInsert = false;
			$alert_type = "danger";
			$error_message = "Duplicate Student found.";
			$popover = new Popover();
			$popover->set_popover($alert_type, $error_message);	
			$_SESSION['error_pop'] = $popover->get_popover();
		header("Location: " . $_SERVER["HTTP_REFERER"]);
	}	

	
	//1 ========================
	$statement1 = "INSERT INTO `pcnhsdb`.`students` (`stud_id`, `first_name`, `mid_name`, `last_name`, `gender`, `birth_date`, `province`, `towncity`, `barangay`, `second_school_name`, `curr_id`, `prog_id`) VALUES ('$stud_id' , '$first_name', '$mid_name', '$last_name', '$gender', '$birth_date', '$province', '$towncity', '$barangay', '$second_school_name', '$curriculum', '$program')";

	//2 ========================
	$statement2 = "INSERT INTO `pcnhsdb`.`parent` (`stud_id`, `pname`, `occupation`, `address` ) VALUES ('$stud_id', '$pname', '$parent_occupation', '$parent_address')";
	
	// //3 ========================
	$statement3 = "INSERT INTO `pcnhsdb`.`primaryschool` (`stud_id`, `psname`, `pschool_year`, `total_elem_years`, `gen_average`) VALUES ('$stud_id', '$primary_schl_name', '$primary_schl_year', '$total_elem_years', '$gpa')";

	if($willInsert) {
		$insertstmt1 = mysqli_query($conn, $statement1);
		$insertstmt2 = mysqli_query($conn, $statement2);
		$insertstmt3 = mysqli_query($conn, $statement3);
// Generate Success Popover
		$alert_type = "success";
		$message = "Added Student Successfully.";
		$popover = new Popover();
		$popover->set_popover($alert_type, $message);	
		$_SESSION['success'] = $popover->get_popover();
		$_SESSION['user_activity'][] = "Added New Student: $first_name $last_name";
		header("Location: ../student_info.php?stud_id=$stud_id");
	}
	
	$conn->close();

?>