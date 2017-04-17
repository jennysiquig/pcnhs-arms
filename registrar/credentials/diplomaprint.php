<?php require_once "../../resources/config.php"; ?>
<?php ob_start(); ?>
<?php session_start(); ?>
<?php
	$date = $_POST['date'];
	$cred_id = $_POST['credential'];
	$request_purpose = $_POST['request_purpose'];
	$admitted_to = "N/A";
	$signatory = $_POST['signatory'];

	//update database (ako na gagawa dito)

	//test display
	echo $date."<br>";
	echo $cred_id."<br>";
	echo $request_purpose."<br>";
	echo $admitted_to."<br>";
	echo $signatory."<br>";

	//query then echo to diploma template
?>