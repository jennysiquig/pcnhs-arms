<?php
require_once "../../../resources/config.php";
include ('../../../resources/classes/Popover.php');

session_start();

$sign_id = $_GET['sign_id'];
$first_name = $_GET['first_name'];
$query = "DELETE FROM signatories WHERE sign_id = '$sign_id'";
DB::query($query);
$sign_del = "DELETED SIGNATORY: $sign_id";
$_SESSION['user_activity'][] = $sign_del;

$alert_type = "danger";
$message = "Signatory Deleted";
$popover = new Popover();
$popover->set_popover($alert_type, $message);
$_SESSION['sign_del'] = $popover->get_popover();
header("location: ../signatory_list.php");
?>
