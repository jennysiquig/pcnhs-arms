<?php
    require_once "../../../resources/config.php";
    require_once "../bcrypt/Bcrypt.php";
    include('../../../resources/classes/Popover.php');
    
    session_start();

    $per_id = htmlspecialchars(filter_var($_POST['per_id'], FILTER_SANITIZE_STRING));
    $uname = htmlspecialchars(filter_var($_POST['uname']));
    $password = htmlspecialchars(filter_var($_POST['password']));
    $hashed_pw = Bcrypt::hashPassword($password);
    $last_name = htmlspecialchars(filter_var($_POST['last_name'], FILTER_SANITIZE_STRING));
    $first_name = htmlspecialchars(filter_var($_POST['first_name'], FILTER_SANITIZE_STRING));
    $mname = htmlspecialchars(filter_var($_POST['mname'], FILTER_SANITIZE_STRING));
    $position = htmlspecialchars(filter_var($_POST['position'], FILTER_SANITIZE_STRING));
    $access_type = htmlspecialchars(filter_var($_POST['access_type'], FILTER_SANITIZE_STRING));
    $accnt_status = htmlspecialchars(filter_var($_POST['accnt_status'], FILTER_SANITIZE_STRING));

    $insertChck = true;

    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (empty($per_id) || empty($uname) || empty($password) || empty($last_name) || empty($first_name) || 
        empty($mname) || empty($position) || empty($position) || empty($access_type) || empty($accnt_status) || empty($hashed_pw)) {
        $insertChck = false;
        $alert_type = "danger";
        $error_message = "Cannot insert values to Database";
        $popover = new Popover();
        $popover->set_popover($alert_type, $error_message);
        $_SESSION['error_pop'] = $popover->get_popover(); 
        header("location" .$_SERVER["HTTP_REFERER"]);
    }
    
    $queryCheck1 = "SELECT * from personnel where per_id = ?";

    $preparedQuery1 = $conn->prepare($queryCheck1);
    $preparedQuery1->bind_param("s",$per_id);
    $preparedQuery1->execute();
    $result1 = $preparedQuery1->get_result();

    $queryCheck2 = "SELECT * from personnel where uname = ?";

    $preparedQuery2 = $conn->prepare($queryCheck2);
    $preparedQuery2->bind_param("s",$uname);
    $preparedQuery2->execute();
    $result2 = $preparedQuery2->get_result();
     
    if ($result1->num_rows > 0) {
         //ERROR NOTIFICATIONS
         $_SESSION['error_msg_personnel1'] = "Personnel ID: $per_id already exists";
         $insertChck = false;
         $alert_type = "danger";
         $error_message = "Personnel ID already exists";
         $popover = new Popover();
         $popover->set_popover($alert_type, $error_message);
         $_SESSION['error_pop'] = $popover->get_popover(); 
         header("location" .$_SERVER["HTTP_REFERER"]);
         die(header("Location: ../personnel_add.php"));
    }

    if ($result2->num_rows > 0) {
        //ERROR NOTIFICATIONS
         $_SESSION['error_msg_personnel2'] = "User name: $uname already exists";
         $insertChck = false;
         $alert_type = "danger";
         $error_message = "Username already exists";
         $popover = new Popover();
         $popover->set_popover($alert_type, $error_message);
         $_SESSION['error_pop2'] = $popover->get_popover(); 
         header("location" .$_SERVER["HTTP_REFERER"]);
         die(header("Location: ../personnel_add.php"));
    }

    else{

        $statement = $conn->prepare("INSERT INTO `pcnhsdb`.`personnel` (`per_id`, `uname`,`password`, `last_name`, `first_name`, `mname`, `position`, `access_type`, `accnt_status`, `hashed_pw`) 
                                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $statement->bind_param("ssssssssss",$per_id, $uname, $password, $last_name, $first_name, $mname, $position, $access_type,$accnt_status, $hashed_pw);

        $statement->execute();

        //USER LOGS
        $per_add = "ADDED PERSONNEL ACCOUNT : $per_id";
        $_SESSION['user_activity'][] = $per_add;

        // SUCCESS NOTIFICATION
        $alert_type = "success";
        $message = "Personnel $uname Added Successfully";
        $popover = new Popover();
        $popover->set_popover($alert_type, $message);   
        $_SESSION['success_personnel'] = $popover->get_popover();
        
        header("location: ../personnel_view.php?per_id=$per_id");

        $statement->close();
        
    $conn->close();
    }
?>