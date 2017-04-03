<?php
        require_once "resources/config.php";
	    session_start();

        date_default_timezone_set('Asia/Manila');
        $loTime = date("h:i:sa");
        $_SESSION ['loTime'] = $loTime;
        $timeout_message;

        if(!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        if(isset($_SESSION['timeout_message'])) {
            $timeout_message = $_SESSION['timeout_message'];
        }

        $log_id = $_SESSION['log_id'];
        $username = $_SESSION['username'];
        $accnt_type = $_SESSION['accnt_type'];
        $sDate = $_SESSION['sDate'];
        $liTime = $_SESSION['liTime'];
        
        $user_act = $_SESSION ['user_activity'];

        foreach ($_SESSION['user_activity'] as $user_act) {
            
        $stmt = $conn->prepare("INSERT INTO `pcnhsdb`.`user_logs` (`log_id`,`user_name`,`account_type`,`log_date`,`log_in_time`,`log_out_time`,`user_act`) 
                                VALUES (?,?,?,?,?,?,?)");

        $stmt ->bind_param("issssss",$log_id,$username,$accnt_type,$sDate,$liTime,$loTime,$user_act);
        
        $stmt->execute(); 
        }

    session_unset();
	session_destroy();
    session_start();
    $_SESSION['timeout_message'] = $timeout_message;
	header("location: login.php");
?>