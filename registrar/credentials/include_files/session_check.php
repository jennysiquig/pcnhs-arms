<?php
    session_start();
    // Session Timeout
    $time = time();
    $session_timeout = 1800; //seconds
    
    if(isset($_SESSION['last_activity']) && ($time - $_SESSION['last_activity']) > $session_timeout) {
        $_SESSION['timeout_message'] = "You have been logged out due to inactivity. Please Login Again.";
        header("location: ../../logout.php");
    }

    $_SESSION['last_activity'] = $time;
    if(isset($_SESSION['logged_in']) && isset($_SESSION['account_type'])){
    	if($_SESSION['account_type'] != "registrar") {
    		echo "<p>Access Failed <a href='../../index.php'>Back to Home</a></p>";
    		die();
    	}
    }else {
    	header('Location: ../../login.php');
    }
    
?>