<?php
	session_start();
?>
<?php
	include 'config.php';
	/*   */
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$queryStatement = "";
	/*   */
	if(!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
		$queryStatement = "SELECT * from personnel where uname = ? and password = ?";
	
	$preparedQuery = $conn->prepare($queryStatement);
	$preparedQuery->bind_param("ss",$username,$password);
	$preparedQuery->execute();
	$result = $preparedQuery->get_result();
	/*   */
	if($result->num_rows>0) {
		while ($row=$result->fetch_assoc()) {
			if($row['access_type']=="system administrator") {
				$_SESSION['username'] = $row['username'];
				$_SESSION['first_name'] = $row['first_name'];
				$_SESSION['last_name'] = $row['last_name'];
				$access_type = $row['access_type'];

				header("Location: ../systemadmin/index.php");
			}
			if($row['access_type']=="registrar") {
				$_SESSION['username'] = $row['username'];
				$_SESSION['first_name'] = $row['first_name'];
				$_SESSION['last_name'] = $row['last_name'];
				$access_type = $row['access_type'];

				header("Location: ../registrar/index.php");
			}
			
			
			$_SESSION['session_account'] = $account_type;
			/*   */
			
		}
	}else {
		$_SESSION['error_message'] = "Invalid Username or Password";
		header("Location: ../login.php");
		die();
	}
	$conn->close();
?>