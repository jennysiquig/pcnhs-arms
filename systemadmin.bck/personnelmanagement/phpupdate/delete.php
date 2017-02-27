<?php
require_once "../../../resources/config.php";

if(!$conn) {
    die();
}
    $per_id = $_GET['per_id'];

    $query = 'DELETE FROM personnel WHERE per_id = ?';
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, 'i', $per_id);

    mysqli_stmt_execute($stmt);

header("location: ../../index.php");
?>