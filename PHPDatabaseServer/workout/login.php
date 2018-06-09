<?php

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Max-Age: 1000');

	date_default_timezone_set("America/Toronto");

	function loginlog($value){
		if($value != "" && $value != NULL){
			$date = date('Y-m-d H:i:s');
			file_put_contents("login.log",("\r\n[".$date."] ".$value),FILE_APPEND);
		}
	}

	ob_start();

	$username = $_POST['name'];
	$password = $_POST['pass'];

	loginlog("Login request made for user : ".$username);

	$mysql = mysqli_connect('127.0.0.1','server','cwelch','websiteData');

	$query = "USE websiteData";

	$result = mysqli_query($mysql,$query)or die(mysqli_error($mysql));

	$query = "SELECT id,firstname,lastname,username FROM user WHERE username='".$username."' AND password='".$password."'";

	$result = mysqli_query($mysql,$query)or die(mysqli_error($mysql));

	$num_row = mysqli_num_rows($result);

	$row = mysqli_fetch_array($result,MYSQL_ASSOC);

	$json = json_encode($row,JSON_PRETTY_PRINT);
	loginlog($json);

	loginlog(ob_get_contents());
	ob_end_clean();

	if( $num_row >=1 ) {
		$row['message']= 'success';
	} else if( $num_row == 0 ) {
		$row['message']= 'invalid';
	} else{
		$row['message']='error';
		$row['messageerror']=$result;
	}
	echo json_encode($row);

	ob_start();
	mysqli_close($mysql);
	ob_end_clean();
?>