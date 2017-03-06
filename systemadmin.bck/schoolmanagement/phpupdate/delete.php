<?php
require_once "../../../resources/config.php";

if(!$conn) {
    die();
}
    $sign_id = $_GET['sign_id'];

    $query = 'DELETE FROM signatories WHERE sign_id = ?';
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, 'i', $sign_id);

    mysqli_stmt_execute($stmt);

header("location: ../signatories.php");
?>