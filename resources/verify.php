<?php
    require_once 'config.php';
    session_start();

    /*   */
    date_default_timezone_set('Asia/Manila');
    $_SESSION['sDate'] = date("d/m/Y");
    $_SESSION['liTime'] = date("h:i:sa");

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

    $log_id = null;
    $_SESSION['log_id'] = $log_id;

    //For User Activity
    $_SESSION['user_activity'][]= $user_activity;

/*   */
    if($result->num_rows>0) {
        while ($row=$result->fetch_assoc()) {
            if($row['access_type']=="SYSTEM ADMINISTRATOR" || $row['access_type']=="system administrator") {
                $_SESSION['username'] = $row['username'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['last_name'] = $row['last_name'];
                $_SESSION['per_id'] = $row['per_id'];
                //
                $_SESSION['account_type'] = "systemadmin";
                $_SESSION['logged_in'] = "true";
                $_SESSION['accnt_status'] = "ACTIVE";

                //For User_Logs
                $_SESSION['username'] = $username;
                $_SESSION['accnt_type'] = "SYSTEM ADMIN";

                header("Location: ../systemadmin/index.php");
            }

            if($row['access_type']=="REGISTRAR" || $row['access_type']=="registrar") {
                $_SESSION['username'] = $row['username'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['last_name'] = $row['last_name'];
                $_SESSION['per_id'] = $row['per_id'];
                //
                $_SESSION['account_type'] = "registrar";
                $_SESSION['logged_in'] = "true";
                $_SESSION['accnt_status'] = "ACTIVE";

                //For User_Logs
                $_SESSION['username'] = $username;
                $_SESSION['accnt_type'] = "REGISTRAR";

                header("Location: ../registrar/index.php");
            }
        }
    }
    
    else {
        $_SESSION['error_message'] = "Invalid Login <br>
                                      Contact System Admin";
        die(header("Location: ../login.php"));
    }
    $conn->close();
?>