<?php
	require_once "../../../resources/config.php";
	if(!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	session_start();


	$stud_id = test_ifset($_POST['stud_id']);
	$first_name = test_ifset($_POST['first_name']);
	$mid_name = test_ifset($_POST['mid_name']);
	$last_name = test_ifset($_POST['last_name']);
	$gender = test_ifset($_POST['gender']);

	$birth_date = test_ifset($_POST['birthdate']);

	$province = test_ifset($_POST['birth_place_province']);
	$towncity = test_ifset($_POST['birth_place_towncity']);
	$barangay = test_ifset($_POST['birth_place_barangay']);

	$second_school_name = test_ifset($_POST['second_school_name']);
	$program = test_ifset($_POST['program']);
	$curriculum = test_ifset($_POST['curriculum']);

	$pname = test_ifset($_POST['pname']);
	$parent_occupation = test_ifset($_POST['occupation']);
	$parent_address = test_ifset($_POST['parent_address']);

	$primary_schl_name = test_ifset($_POST['schl_name']);
	$primary_schl_year = test_ifset($_POST['schl_year']);
	$total_elem_years = test_ifset($_POST['total_elem_years']);
	$gpa = test_ifset($_POST['gpa']);
	$willInsert = true;
// validate gpa
	if($gpa > 99.99 || $gpa < 75) {
		$willInsert = false;
			$_SESSION['error_pop'] = <<<ERROR_POP
			<div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong>Error: </strong>You have entered an Invalid Average Grade.
            </div>
ERROR_POP;
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		
	}

	$validate_p_schl_yr = explode("-", $primary_schl_year);
	$year1 = $validate_p_schl_yr[0];
	$year2 = $validate_p_schl_yr[1];
// validate primary school year
	if(intval($year1) > intval($year2) || intval($year2) != (intval($year1)+1) ) {
		$willInsert = false;
			$_SESSION['error_pop'] = <<<ERROR_POP
			<div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong>Error: </strong>You have entered an Invalid Primary School Year.
            </div>
ERROR_POP;
		
			header("Location: " . $_SERVER["HTTP_REFERER"]);
	}

// Duplicate Checker
	$selectStudents = "SELECT * from students where stud_id = '$stud_id' and first_name = '$first_name' and last_name = '$last_name' and birth_date = '$birth_date';";
	$result = $conn->query($selectStudents);
	if ($result->num_rows > 0) {
		$willInsert = false;
			$_SESSION['error_pop'] = <<<ERROR_POP
			<div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong>Error: </strong>Duplicate Student Record.
            </div>
ERROR_POP;
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

		header("Location: ../student_info.php?stud_id=$stud_id");
	}
	

	

	
	
	
	$conn->close();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	function test_ifset($data) {
		if(isset($data)) {
			test_input($data);
			return $data;
		}else {
			return "";
		}
	}

	// function test_select_bday($data) {
	// 	if($data == "none") {
	// 		$_SESSION['none_selected'] = "<p style='color: red'>* Please Select</p>";
	// 	}else{
	// 		return $data;
	// 	}
	// }

?>