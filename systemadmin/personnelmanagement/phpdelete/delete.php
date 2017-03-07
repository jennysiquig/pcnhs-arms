<?php
	require_once "../../../resources/config.php";
	session_start();

if(!$conn) {
    die();
}
    $per_id = $_GET['per_id'];
    
    $_SESSION['per_id'] = $per_id;

    $query = 'DELETE FROM personnel WHERE per_id = ?';
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, 's', $per_id);

    mysqli_stmt_execute($stmt);

    $per_del = "DELETED PERSONNEL ACCOUNT : $per_id";
    $_SESSION['user_activity'][] = $per_del;

header("location: ../../index.php");
?>