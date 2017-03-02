<?php
	$transaction_date = $_GET['transaction_date'];
	echo $transaction_date;
	echo "<br>";
	$from_and_to_date = explode("-", $transaction_date);
	echo $from_and_to_date[0];
	echo "<br>";
	echo $from_and_to_date[1];

	$sqldate_format_from = explode("/", $from_and_to_date[0]);
	$m = $sqldate_format_from[0];
	$d = $sqldate_format_from[1];
	$y = $sqldate_format_from[2];
	$m = preg_replace('/\s+/', '', $m);
	$d = preg_replace('/\s+/', '', $d);
	$y = preg_replace('/\s+/', '', $y);
	echo "<br>";
	echo $m;
	echo "<br>";
	echo $d;
	echo "<br>";
	echo $y."-".$m."-".$d;
	echo "<br>";

	$sqldate_format_to = explode("/", $from_and_to_date[1]);
	$m = $sqldate_format_to[0];
	$d = $sqldate_format_to[1];
	$y = $sqldate_format_to[2];

	echo "<br>";
	echo $m;
	echo "<br>";
	echo $d;
	echo "<br>";
	echo $y;
	echo "<br>";

?>