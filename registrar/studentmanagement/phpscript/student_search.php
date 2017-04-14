<?php
	require_once "../../../resources/config.php";
	$search = $_GET['query'];
	
	if(!$conn) {
		$response = "Database Connection Error";
	}

	$query = "SELECT * from students left join curriculum on students.curr_id = curriculum.curr_id where last_name like '%$search' or first_name like '%$search' or stud_id like '%$search' or concat(first_name,' ',last_name) like '%$search' or concat(last_name,' ',first_name,' ',mid_name) like '%$search' or concat(first_name,' ',mid_name,' ',last_name) like '%$search';";

	$result = $conn->query($query);
	if($result->num_rows>0) {
		while($row=$result->fetch_assoc()) {
			$stud_id = $row['stud_id'];
			$full_name = $row['first_name'].' '.$row['last_name'];

			$response[] = array(
				'name' => "$full_name",
			);
		}
	}else {
		$response[] = array(
				'name' => "No student found.",
		);
	}

	echo json_encode($response);

?>