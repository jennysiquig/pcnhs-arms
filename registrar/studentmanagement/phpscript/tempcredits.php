<?php
	session_start();
	$_SESSION['credits'][] = $_GET['credits'];
	$_SESSION['creditspos'][] = $_GET['creditspos'];

?>