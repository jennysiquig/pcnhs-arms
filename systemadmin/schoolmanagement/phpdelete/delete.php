<?php
	require_once "../../../resources/config.php";
	session_start();

if(!$conn) {
    die();
}
    $sign_id = $_GET['sign_id'];
    $first_name = $_GET['first_name'];
    $mname = $_GET['mname'];
    $last_name = $_GET['last_name'];

    $query = 'DELETE FROM signatories WHERE sign_id = ?';
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, 's', $sign_id);

    mysqli_stmt_execute($stmt);

    $sign_del = "DELETED SIGNATORY $first_name $mname $last_name";
    $_SESSION['user_activity'][] = $sign_del;

header("location: ../signatories.php");
?>