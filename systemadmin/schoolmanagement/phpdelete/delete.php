<?php
    require_once "../../../resources/config.php";
    include('../../../resources/classes/Popover.php');
    session_start();

if(!$conn) {
    die();
}
    $sign_id = $_GET['sign_id'];
    $first_name = $_GET['first_name'];

    $query = 'DELETE FROM signatories WHERE sign_id = ?';
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, 's', $sign_id);

    mysqli_stmt_execute($stmt);

    $sign_del = "DELETED SIGNATORY : $sign_id";
    $_SESSION['user_activity'][] = $sign_del;

    //NOTIFICATIONS
    $alert_type = "danger";
    $message = "Signatory Deleted";
    $popover = new Popover();
    $popover->set_popover($alert_type, $message);   
    $_SESSION['sign_del'] = $popover->get_popover();

header("location: ../signatories.php");
?>