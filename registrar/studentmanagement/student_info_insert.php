<?php
	session_start();
	// $stud_id;
	// $first_name; 
	// $mid_name;
	// $last_name; 
	// $gender; 
	// $birth_date; 
	// $birth_place; 
	// $second_school_name;  
	// $program;
	// $curriculum; 

	// $pname; 
	// $parent_occupation; 
	// $parent_address;

	// $primary_schl_name;
	// $primary_schl_year;
	// $total_elem_years;
	// $gpa;
	// ====
	$stud_id = test_ifset($_POST['stud_id']);
	$first_name = test_ifset($_POST['first_name']);
	$mid_name = test_ifset($_POST['mid_name']);
	$last_name = test_ifset($_POST['last_name']);
	$gender = test_ifset($_POST['gender']);

	if(!empty(test_ifset($_POST['byear'])) && !empty(test_ifset($_POST['bmonth'])) && !empty(test_ifset($_POST['bday']))) {
		$birth_date = $_POST['byear'].'-'.$_POST['bmonth'].'-'.$_POST['bday'];
	}

	$birth_place = test_ifset($_POST['birth_place_barangay']).', '.test_ifset($_POST['birth_place_province']);
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

	
	require_once "../../resources/config.php";

	if(!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	//1 ========================
	$statement1 = "INSERT INTO `pcnhsdb`.`students` (`stud_id`, `first_name`, `mid_name`, `last_name`, `gender`, `birth_date`, `birth_place`, `second_school_name`, `curr_id`, `prog_id`) VALUES ('$stud_id' , '$first_name', '$mid_name', '$last_name', '$gender', '$birth_date', '$birth_place', '$second_school_name', '$curriculum', '$program')";

	//2 ========================
	$statement2 = "INSERT INTO `pcnhsdb`.`parent` (`stud_id`, `pname`, `occupation`, `address` ) VALUES ('$stud_id', '$pname', '$parent_occupation', '$parent_address')";
	
	// //3 ========================
	$statement3 = "INSERT INTO `pcnhsdb`.`primaryschool` (`stud_id`, `psname`, `pschool_year`, `total_elem_years`, `gen_average`) VALUES ('$stud_id', '$primary_schl_name', '$primary_schl_year', '$total_elem_years', '$gpa')";

	$insertstmt1 = mysqli_query($conn, $statement1);
	$insertstmt2 = mysqli_query($conn, $statement2);
	$insertstmt3 = mysqli_query($conn, $statement3);

	if($insertstmt1 && $insertstmt2 && $insertstmt3) {
		header("location: student_info.php?stud_id=$stud_id");
	}else {
		header("location:javascript://history.go(-1)");
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