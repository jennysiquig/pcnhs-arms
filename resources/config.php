
<?php
	$path = "pcnhs.sis"; //set path to the folder name of the web application (ex: pcnhs.sis)
	$base_url = "http://".$_SERVER['SERVER_NAME'].'/'.$path; //base_url (localhost/pcnhs.sis)

    $host = 'localhost';
    $db = 'pcnhsdb'; //default
    $user = 'pcnhs'; //default
    $pass = 'pcnhs'; //default
    
    $conn = new mysqli($host,$user,$pass,$db);

?>