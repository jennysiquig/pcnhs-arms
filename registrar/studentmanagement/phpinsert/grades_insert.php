<?php
	session_start();
	include('../../../resources/classes/Popover.php');
?>
<?php
	unset($_SESSION['grades_array']);
	if(isset($_SESSION['save-type'])) {
		if ($_SESSION['save-type'] == "save-to-file") {
			$out = fopen('php://output', 'a');
			$stud_id = htmlspecialchars($_POST['stud_id'], ENT_QUOTES);
			$schl_year = htmlspecialchars($_POST['schl_year'], ENT_QUOTES);
			$yr_level = htmlspecialchars($_POST['yr_level'], ENT_QUOTES);
			$average_grade = filter_var($_POST['average_grade'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			$schl_name = htmlspecialchars($_POST['schl_name'], ENT_QUOTES);
			$total_credit = filter_var($_POST['total_credits'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			$insertgrades = "";
			$comment = "";
			$credit_earned = filter_var($_POST['credit_earned'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

			header('Content-type:text/csv');
			header("Content-Disposition: attachment; filename=$stud_id-year-level-$yr_level-partial-save.csv");
			header("Content-Transfer-Encoding: UTF-8");

			
			$list = array($_POST['subj_id'],$_POST['fin_grade'],$_POST['credit_earned']);
			foreach ($list as $fields) {
				fputcsv($out, $fields);
			}
			fclose($out);
		}elseif($_SESSION['save-type'] == "save-to-db") {
			require_once "../../../resources/config.php";
			if(!$conn) {
				die();
			}
			$stud_id = htmlspecialchars($_POST['stud_id'], ENT_QUOTES);
			$schl_year = htmlspecialchars($_POST['schl_year'], ENT_QUOTES);
			$yr_level = htmlspecialchars($_POST['yr_level'], ENT_QUOTES);
			$average_grade = filter_var($_POST['average_grade'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			$schl_name = htmlspecialchars($_POST['schl_name'], ENT_QUOTES);
			$total_credit = filter_var($_POST['total_credits'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
			$insertgrades = "";
			$comment = "";
			$willInsert = true;

			$checkgrade = "SELECT * from pcnhsdb.grades where stud_id = '$stud_id' AND yr_level = '$yr_level'";
		    $result = $conn->query($checkgrade);
		    if ($result->num_rows > 0) {
		        $alert_type = "danger";
		        $error_message = "Student $stud_id grades for year level $yr_level is already existing.";
		        $popover = new Popover();
		        $popover->set_popover($alert_type, $error_message); 
		        $_SESSION['hasgrades'] = $popover->get_popover();
		        header("location: grades.php?stud_id=".$stud_id);
		        die();
		    }
// 
			if($average_grade > 99.999) {
				$willInsert = false;
				$alert_type = "danger";
				$error_message = "You have entered an Invalid Average Grade.";
				$popover = new Popover();
				$popover->set_popover($alert_type, $error_message);	
				$_SESSION['error_pop'] = $popover->get_popover();
				header("Location: " . $_SERVER["HTTP_REFERER"]);
				die();
			}
			if(empty($average_grade)) {
				$willInsert = false;
				$alert_type = "danger";
				$error_message = "Empty Average Grade.";
				$popover = new Popover();
				$popover->set_popover($alert_type, $error_message);	
				$_SESSION['error_pop'] = $popover->get_popover();
				header("Location: " . $_SERVER["HTTP_REFERER"]);
				die();
			}
			if(!is_numeric($total_credit)) {
				$willInsert = false;
				$alert_type = "danger";
				$error_message = "Empty Total Credits Earned.";
				$popover = new Popover();
				$popover->set_popover($alert_type, $error_message);	
				$_SESSION['error_pop'] = $popover->get_popover();
				header("Location: " . $_SERVER["HTTP_REFERER"]);
				die();
			}
			foreach ($_POST['subj_id'] as $key => $value) {
				$subj_id = htmlspecialchars($_POST['subj_id'][$key]);
				$fin_grade = htmlspecialchars($_POST['fin_grade'][$key]);
				$credit_earned = htmlspecialchars($_POST['credit_earned'][$key]);
// 	
				if(empty($credit_earned)) {
					$credit_earned = 1;
				}

				if($fin_grade > 99.99 || $fin_grade < 70) {
					$willInsert = false;
					$alert_type = "danger";
					$error_message = "You have entered an Invalid Final Grade.";
					$popover = new Popover();
					$popover->set_popover($alert_type, $error_message);	
					$_SESSION['error_pop'] = $popover->get_popover();
					header("Location: " . $_SERVER["HTTP_REFERER"]);
					die();
				}
		// 
				if(empty($fin_grade) || empty($credit_earned)) {
					$willInsert = false;
					$alert_type = "danger";
					$error_message = "Please complete the form before saving to database.";
					$popover = new Popover();
					$popover->set_popover($alert_type, $error_message);	
					$_SESSION['error_pop'] = $popover->get_popover();
					header("Location: " . $_SERVER["HTTP_REFERER"]);
					die();
				} 
				if($credit_earned < 0 || $credit_earned > 100) {
					$willInsert = false;
					$alert_type = "danger";
					$error_message = "You have entered an Invalid Credits Earned.";
					$popover = new Popover();
					$popover->set_popover($alert_type, $error_message);	
					$_SESSION['error_pop'] = $popover->get_popover();
					header("Location: " . $_SERVER["HTTP_REFERER"]);
					die();
				}
				if($fin_grade < 65 && $fin_grade != 0) {
					$credit_earned = 0;
					$comment ="FAILED";
				}else {
					$comment = "PASSED";
				}
		//
				 

				$insertgrades .= "INSERT INTO `pcnhsdb`.`studentsubjects` (`stud_id`, `subj_id`, `schl_year`, `yr_level`, `fin_grade`, `comment`, `credit_earned`) VALUES ('$stud_id', '$subj_id', '$schl_year', '$yr_level', '$fin_grade', '$comment', '$credit_earned');";
				
			}
			$insertaverage = "INSERT INTO `pcnhsdb`.`grades` (`stud_id`, `schl_name`, `schl_year`, `yr_level`, `average_grade`, `total_credit`) VALUES ('$stud_id', '$schl_name', '$schl_year', '$yr_level', '$average_grade', '$total_credit');";

			if($willInsert) {
				unset($_SESSION['grade']);
				unset($_SESSION['credits']);
				unset($_SESSION['save-type']);
				mysqli_query($conn, $insertaverage);
				mysqli_multi_query($conn, $insertgrades);
				echo "<p>Updating Database, please wait...</p>";
				header("refresh:3;url=../grades.php?stud_id=$stud_id");
				$_SESSION['user_activity'][] = "ADDED NEW GRADES: $stud_id - $yr_level";
			}
		}
	}
?>