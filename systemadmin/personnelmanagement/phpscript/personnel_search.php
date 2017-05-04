<?php
	require_once "../../../resources/config.php";
	$search = $_GET['query'];

	$query = "SELECT * FROM pcnhsdb.personnel where uname LIKE '$search%' and uname not like 'registrar' and uname not like 'admin'
			  OR position like '$search';";

	$result = DB::query($query);
	if (count($result) > 0) {
		foreach ($result as $row) {
			$uname = $row['uname'];
			$response[] = array(
				'uname' => "$uname",
			);
		}
	}else {
		$response[] = array(
				'uname' => "",
		);
	}
	echo json_encode($response);
?>
