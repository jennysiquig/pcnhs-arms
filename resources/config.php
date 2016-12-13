
<?php
	$path = "pcnhs.sis";
	$base_url = "http://".$_SERVER['SERVER_NAME'].'/'.$path;

    $host = 'localhost';
    $db = 'pcnhsdb';
    $user = 'root';
    $pass = '';
    
    $conn = new mysqli($host,$user,$pass,$db);

?>