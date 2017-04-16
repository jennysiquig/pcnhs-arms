<?php
	require_once "../../../resources/config.php";
	$search = $_GET['query'];
	
	if(!$conn) {
		$response = "Database Connection Error";
	}

	$query = "SELECT * FROM pcnhsdb.personnel where uname LIKE '$search%' and uname not like 'registrar' and uname not like 'admin' 
			  OR position like '$search';";

	$result = $conn->query($query);
	if($result->num_rows>0) {
		while($row=$result->fetch_assoc()) {
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