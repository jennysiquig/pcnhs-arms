
<?php
	$urlpath = "pcnhs-arms"; //set path to the folder name of the web application (ex: pcnhs.sis)
	$base_url = "http://".$_SERVER['SERVER_NAME'].'/'.$urlpath; //base_url (localhost/pcnhs.sis)

    $host = 'localhost';
    $db = 'pcnhsdb'; //default
    $user = 'root'; //default
    $pass = 'root'; //default
    
    $conn = new mysqli($host,$user,$pass,$db);

?>