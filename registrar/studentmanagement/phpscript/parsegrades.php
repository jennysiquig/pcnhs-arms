<?php 
	session_start();
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["grades"]["name"]);
	$uploadOk = 1;
	$fileType = pathinfo($target_file,PATHINFO_EXTENSION);

	// Check if file already exists
	if (file_exists($target_file)) {
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["grades"]["size"] > 500000) {
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($fileType != "csv" ) {
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	// if everything is ok, try to upload file
	} else {
		move_uploaded_file($_FILES["grades"]["tmp_name"], $target_file);
	}
	
	if($uploadOk == 1) {
		$csvAsArray = array_map('str_getcsv', file($target_file));
		$_SESSION['grades_array'] = $csvAsArray;
		unlink($target_file);
		header("location: ".$_SERVER['HTTP_REFERER']);
	}else {
		header("location: ".$_SERVER['HTTP_REFERER']);
	}
	

?>