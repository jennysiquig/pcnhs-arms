<?php
    require_once "../../../resources/config.php";
    session_start();

    $stud_id = htmlspecialchars($_GET['stud_id'], ENT_QUOTES);
    $cred_id = htmlspecialchars($_POST['credential'], ENT_QUOTES);
    $request_type = htmlspecialchars($_POST['request_type'], ENT_QUOTES);
    $personnel_id = htmlspecialchars($_SESSION['per_id'], ENT_QUOTES);
    $date = htmlspecialchars($_POST['date'], ENT_QUOTES);
    $request_purpose = strtoupper(htmlspecialchars($_POST['request_purpose']));
    if(!$conn) {
        die();
    }
	$statement1 = "INSERT INTO `pcnhsdb`.`requests` (`cred_id`, `stud_id`, `request_type`, `status`, `date_processed`, `request_purpose`,  `per_id`) VALUES ('$cred_id', '$stud_id', '$request_type', 'u', '$date', '$request_purpose', '$personnel_id');";

    mysqli_query($conn, $statement1);

    header("location: ../unclaimed.php")

?>