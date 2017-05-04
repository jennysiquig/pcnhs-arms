<?php

$variable_url = "$" . "base_url";
$variable_host = "$" . "host";
$variable_db = "$" . "dbName";
$variable_user = "$" . "user";
$variable_pass = "$" . "password";
$variable_conn = "$" . "conn";


$protocol = $_POST['protocol'];
$host = $_POST['dbhost'];
$db = $_POST['dbname'];
$user = $_POST['dbuser'];
$pass = $_POST['dbpass'];

if (isset($_POST['urlpath']) && $_POST['protocol'] == "http://") {
    $urlpath = '/' . $_POST['urlpath'];
} else {
    $urlpath = "";
}

echo $urlpath;
$base_url = "$protocol" . $_SERVER['SERVER_NAME'] . "$urlpath";

$string_replace = "<?php
    require_once 'meekrodb.php';
    $variable_url='$base_url';
    //$variable_host='$host';
    DB::$variable_db='$db';
    DB::$variable_user='$user';
    DB::$variable_pass='$pass';
    //$variable_conn = new mysqli($variable_host,$variable_user,$variable_pass,$variable_db);
?>";
$string_replace_pc = "<?php
    $variable_url='$base_url';
?>";
//echo $string_replace;
$file = fopen("resources/config.php", "w");
fwrite($file, $string_replace);
fclose($file);

$file = fopen("resources/templates/admin/pathconfig.php", "w");
fwrite($file, $string_replace_pc);
fclose($file);

$file = fopen("resources/templates/registrar/pathconfig.php", "w");
fwrite($file, $string_replace_pc);
fclose($file);

header("location: login.php");
die();

?>
