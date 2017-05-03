<?php
	require_once "../../../resources/config.php";
	$search = $_GET['query'];

	$query = "SELECT * FROM pcnhsdb.user_logs where user_name like '$search%';";

	$result = DB::query($query);
	if (count($result) > 0) {
		foreach ($result as $row) {
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
