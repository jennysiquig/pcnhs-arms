
<?php
	$path = "";
	$base_url = "http://".$_SERVER['SERVER_NAME'].'/'.$path;

    $host = 'localhost';
    $db = 'pcnhsdb';
    $user = 'pcnhs';
    $pass = 'pcnhs';
    
    $conn = new mysqli($host,$user,$pass,$db);

?>