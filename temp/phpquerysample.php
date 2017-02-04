<?php
	if(!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$statement = "SELECT * FROM pcnhsdb.curriculum";
	$result = $conn->query($statement);
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$curr_id = $row['curr_id'];
			$curr_name = $row['curr_name'];
		}
	}
?>