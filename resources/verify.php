<?php
	session_start();
?>
<?php
	require_once 'config.php';
	/*   */
	$username = $_POST['username'];
	$password = $_POST['password'];

	$queryStatement = "";
	/*   */
	if(!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$queryStatement = "SELECT * from personnel where uname = ? and password = ? and accnt_status = 'ACTIVE'";
	
	$preparedQuery = $conn->prepare($queryStatement);
	$preparedQuery->bind_param("ss",$username,$password);
	$preparedQuery->execute();
	$result = $preparedQuery->get_result();
	/*   */
	if($result->num_rows>0) {
		while ($row=$result->fetch_assoc()) {
			if($row['access_type']=="SYSTEM ADMINISTRATOR" || $row['access_type']=="system administrator") {
				$_SESSION['per_id'] = $row['per_id'];
				$_SESSION['username'] = $row['username'];
				$_SESSION['first_name'] = $row['first_name'];
				$_SESSION['last_name'] = $row['last_name'];
				//
				$_SESSION['account_type'] = "systemadmin";
				$_SESSION['logged_in'] = "true";
                $_SESSION['accnt_status'] = "ACTIVE";
				//
				header("Location: ../systemadmin/index.php");
			}
			if($row['access_type']=="REGISTRAR" || $row['access_type']=="registrar") {
				$_SESSION['per_id'] = $row['per_id'];
				$_SESSION['username'] = $row['username'];
				$_SESSION['first_name'] = $row['first_name'];
				$_SESSION['last_name'] = $row['last_name'];
				//
                $_SESSION['account_type'] = "registrar";
				$_SESSION['logged_in'] = "true";
                $_SESSION['accnt_status'] = "ACTIVE";
				//
				header("Location: ../registrar/index.php");
			}
		}
	}
	else {
        $_SESSION['error_message'] = "INVALID LOGIN <br>
									  CONTACT SYSTEM ADMIN";
		die(header("Location: ../login.php"));
	}
	$conn->close();
?>