<?php
	require_once "../../../resources/config.php";
	$search = $_GET['query'];

	$query = "SELECT * FROM pcnhsdb.signatories WHERE sign_id LIKE '$search%'
              OR first_name LIKE '$search%'
              OR mname LIKE '$search%'
              OR last_name LIKE '$search%'
              OR CONCAT(first_name,mname,last_name) LIKE '$search%'
              OR CONCAT(first_name,' ',last_name) LIKE '$search%'
              OR CONCAT(last_name,first_name,mname) LIKE '$search%'
              OR CONCAT(last_name,' ',first_name) LIKE '$search%';";

    $query2 = "SELECT * FROM pcnhsdb.signatories WHERE
    		   yr_started LIKE '$search%'
    		   OR yr_ended LIKE '$search%';";

	$result = DB::query($query);
	$result2 = DB::query($query2);

	if (count($result) > 0) {
		foreach ($result as $row) {
			$sign_id = $row['sign_id'];
			$name = $row['first_name'].' '.$row['last_name'];
			$response[] = array(
				'name' => "$name",
			);
		}
	}else {
		$response[] = array(
				'name' => "",
		);
	}
	echo json_encode($response);
?>
