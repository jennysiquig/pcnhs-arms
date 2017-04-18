<?php
    require_once "../../../resources/config.php";
    session_start();

    $stud_id = htmlspecialchars($_GET['stud_id'], ENT_QUOTES);
    $cred_id = htmlspecialchars($_POST['credential'], ENT_QUOTES);
    $request_type = htmlspecialchars($_POST['request_type'], ENT_QUOTES);
    $personnel_id = htmlspecialchars($_SESSION['per_id'], ENT_QUOTES);
    $date = htmlspecialchars($_POST['date'], ENT_QUOTES);
    $request_purpose = strtoupper(htmlspecialchars($_POST['request_purpose']));
    $admitted_to = "N/A";

    if(!$conn) {
        die();
    }

    $checkpending = "SELECT * FROM pcnhsdb.requests where status = 'p' and stud_id = '$stud_id' and cred_id = '$cred_id' order by req_id desc limit 1;";
    $result = $conn->query($checkpending);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $req_id = $row['req_id'];
            $update = "UPDATE `pcnhsdb`.`requests` SET `request_type`='$request_type', `status`='u' ,`admitted_to` = '$admitted_to' WHERE `req_id`='$req_id';";

            mysqli_query($conn, $update);
            header("location: ../unclaimed.php");
            die();
        }
    }else {
         $statement1 = "INSERT INTO `pcnhsdb`.`requests` (`cred_id`, `stud_id`, `request_type`, `status`, `date_processed`, `admitted_to`, `request_purpose`, `sign_id`, `per_id`) VALUES ('$cred_id', '$stud_id', '$request_type', 'u', '$date', '$admitted_to', '$request_purpose', '$personnel_id');";

        mysqli_query($conn, $statement1);
        header("location: ../unclaimed.php");
        die();
    }
	
   

?>