<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Max-Age: 1000');

date_default_timezone_set("America/Toronto");

ob_start();

$mysql = mysqli_connect('127.0.0.1','server','cwelch','websiteData');

$query = "USE websiteData";

$result = mysqli_query($mysql,$query)or die(mysqli_error($mysql));

$field = $_GET['field'];

$workoutquery = "SELECT * FROM ".$field;

$workoutresults= mysqli_query($mysql,$workoutquery)or die(mysqli_error($mysql));

$data = array();
while($workoutrow = mysqli_fetch_assoc($workoutresults)){
	array_push($data,$workoutrow);
}
ob_end_clean();
echo json_encode($data,JSON_PRETTY_PRINT);

ob_start();
mysqli_close($mysql);
ob_end_clean();

?>