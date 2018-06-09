<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET');
	header('Access-Control-Max-Age: 1000');

	$st = "";

	ob_start();
	$dbconn = pg_connect("host=ec2-54-243-201-19.compute-1.amazonaws.com dbname=d6l7ok3hq22v56 user=urajyjzpeyxzrd password=6wPRddpZ71tso8Ym_jVtpT2dmS")
	or die($st = "error");

	if($st == "error") {
		echo "error";
	} else {
		echo "success";
	}

	ob_start();
	pg_close($dbconn);
	ob_end_clean();
?>