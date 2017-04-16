<?php
	require_once "../../../resources/config.php";
	$search = $_GET['query'];
	
	if(!$conn) {
		$response = "Database Connection Error";
	}

	$query = "SELECT * FROM pcnhsdb.user_logs where user_name like '$search%';";

	$result = $conn->query($query);
	if($result->num_rows>0) {
		while($row=$result->fetch_assoc()) {
			$user_name = $row['user_name'];
			$response[] = array(
				'user_name' => "$user_name",
			);
		}
	}else {
		$response[] = array(
				'user_name' => "Personnel account not found",
		);
	}
	echo json_encode($response);
?>