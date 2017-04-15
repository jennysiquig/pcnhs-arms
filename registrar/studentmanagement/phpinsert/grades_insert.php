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
			$credit_earned = htmlspecialchars($_POST['credit_earned']);

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
			$hasSpecialGrade = false;

			$curr_id = $_GET['curr_id'];
			$curr_code = "";

			$checkcurriculum = "SELECT * FROM pcnhsdb.curriculum where curr_id = $curr_id;";
			$result = $conn->query($checkcurriculum);
			if($result->num_rows>0) {
				while ($row = $result->fetch_assoc()) {
					$curr_code = $row['curr_code'];
				}
			}

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
			foreach ($_POST['subj_id'] as $key => $value) {
				$subj_id = htmlspecialchars($_POST['subj_id'][$key]);
				$fin_grade = htmlspecialchars($_POST['fin_grade'][$key]);
				$credit_earned = htmlspecialchars($_POST['credit_earned'][$key]);
				$special_grade = strtoupper(htmlspecialchars($_POST['special_grade'][$key]));
// 	
				if(!empty($fin_grade) && !empty($special_grade) && $curr_code == "NSEC") {
					$special_grade = "";
				}
				if(empty($fin_grade) && !empty($special_grade)) {
					$fin_grade = 99;
					$hasSpecialGrade = true;
				}

				if(!empty($special_grade) && $curr_code != "NSEC") {
					$willInsert = false;
					$alert_type = "danger";
					$error_message = "Special grades are for NSEC Students only.";
					$popover = new Popover();
					$popover->set_popover($alert_type, $error_message);	
					$_SESSION['error_pop'] = $popover->get_popover();
					header("Location: " . $_SERVER["HTTP_REFERER"]);
					die();
				}

				if($fin_grade > 74 && $credit_earned == 0 && is_numeric($credit_earned)) {
					$willInsert = false;
					$alert_type = "danger";
					$error_message = "Invalid Credit Earned input. Enter Credit Earned that is greater than 0 if the Final Grade is greater than 74";
					$popover = new Popover();
					$popover->set_popover($alert_type, $error_message);	
					$_SESSION['error_pop'] = $popover->get_popover();
					header("Location: " . $_SERVER["HTTP_REFERER"]);
					die();
				}

				if(!is_numeric($credit_earned)) {
					if($curr_code != "K-12") {
						$willInsert = false;
						$alert_type = "danger";
						$error_message = "'P' for PROMOTED or 'R' for RETAINED is for K-12 curriculum only. ";
						$popover = new Popover();
						$popover->set_popover($alert_type, $error_message);	
						$_SESSION['error_pop'] = $popover->get_popover();
						header("Location: " . $_SERVER["HTTP_REFERER"]);
						die();
					}else {
						if(strtoupper($credit_earned) == 'P') {
							$credit_earned = "PROMOTED";
						}elseif(strtoupper($credit_earned) == 'R') {
							$credit_earned = "RETAINED";
						}else {
							$credit_earned = "";
							$willInsert = false;
							$alert_type = "danger";
							$error_message = "Invalid Credit Earned input. Enter 'P' for PROMOTED or 'R' for RETAINED.";
							$popover = new Popover();
							$popover->set_popover($alert_type, $error_message);	
							$_SESSION['error_pop'] = $popover->get_popover();
							header("Location: " . $_SERVER["HTTP_REFERER"]);
							die();
						}

						if($fin_grade < 75) {
							$credit_earned = "RETAINED";;
						}
						if($fin_grade > 75) {
							$credit_earned = "PROMOTED";
						}
					}
				}
				if(is_numeric($credit_earned)) {
					if($curr_code == "K-12") {
						$willInsert = false;
						$alert_type = "danger";
						$error_message = "Enter 'P' for PROMOTED or 'R' for RETAINED. ";
						$popover = new Popover();
						$popover->set_popover($alert_type, $error_message);	
						$_SESSION['error_pop'] = $popover->get_popover();
						header("Location: " . $_SERVER["HTTP_REFERER"]);
						die();
					}
				}
				

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
				if($fin_grade > 99.99 || $fin_grade < 65) {
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
				if($fin_grade < 75 && $fin_grade != 0 && $curr_code != "K-12") {
					$credit_earned = 0;
					$comment ="FAILED";
					$total_credit -= 1;
					if($total_credit < 1) {
						$total_credit = 0;
					}
				}else {
					$comment = "PASSED";
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
					$total_credit = "N/A";
				}
				if($hasSpecialGrade) {
					$fin_grade = 0.0;
				}
				$insertgrades .= "INSERT INTO `pcnhsdb`.`studentsubjects` (`stud_id`, `subj_id`, `schl_year`, `yr_level`, `fin_grade`, `comment`, `credit_earned`,  `special_grade`) VALUES ('$stud_id', '$subj_id', '$schl_year', '$yr_level', '$fin_grade', '$comment', '$credit_earned', '$special_grade');";
				
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