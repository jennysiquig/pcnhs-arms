<?php
	session_start();
	$_SESSION['grade'][] = $_GET['grade'];
	$_SESSION['gradepos'][] = $_GET['gradepos'];

?>