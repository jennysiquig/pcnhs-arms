<?php
	
	// $stud_id;
	// $first_name; 
	// $mid_name;
	// $last_name; 
	// $gender; 
	// $birth_date; 
	// $birth_place; 
	// $schl_location; 
	// $yr_grad; 
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

	$stud_id = $_POST['stud_id'];
	$first_name = $_POST['first_name'];
	$mid_name = $_POST['mid_name'];
	$last_name = $_POST['last_name'];
	$gender = $_POST['gender'];
	$birth_date = $_POST['byear'].'-'.$_POST['bmonth'].'-'.$_POST['bday'];
	$birth_place = $_POST['birth_place'];
	$second_school_name = $_POST['second_school_name'];
	$program = $_POST['program'];
	$curriculum = $_POST['curriculum'];

	$pname = $_POST['pname'];
	$parent_occupation = $_POST['occupation'];
	$parent_address = $_POST['parent_address'];

	$primary_schl_name = $_POST['schl_name'];
	$primary_schl_year = $_POST['schl_year'];
	$total_elem_years = $_POST['total_elem_years'];
	$gpa = $_POST['gpa'];

	
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

	mysqli_query($conn, $statement1);
	mysqli_query($conn, $statement2);
	mysqli_query($conn, $statement3);


	header("location: student_info.php?stud_id=$stud_id");

	
	
	
	$conn->close();

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	
	


?>