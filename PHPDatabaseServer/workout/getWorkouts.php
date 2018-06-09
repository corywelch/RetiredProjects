<?php

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET');
	header('Access-Control-Max-Age: 1000');

	date_default_timezone_set("America/Toronto");

	ob_start();

	$mysql = mysqli_connect('127.0.0.1','server','cwelch','websiteData');

	$query = "USE websiteData";

	$result = mysqli_query($mysql,$query)or die(mysqli_error($mysql));

	$userID = $_GET['userid'];

	$workoutquery = "SELECT w.id AS 'workoutid', u.username AS 'username', u.id AS 'userid', l.name AS 'location', l.id AS 'locationid', w.date AS 'date', w.start_time AS 'starttime', w.note AS 'workoutnote' FROM workout w JOIN location l ON l.id=w.location_id JOIN user u ON u.id=w.user_id WHERE w.user_id='".$userID."' ORDER BY date DESC";

	$workoutresults= mysqli_query($mysql,$workoutquery)or die(mysqli_error($mysql));

	$data = array();
	while($workoutrow = mysqli_fetch_assoc($workoutresults)){

		$wid = $workoutrow['workoutid'];
		$movequery = "SELECT m.id AS 'moveid', be.name AS 'baseexercisename', m.note AS 'movenote', wml.order AS 'order' FROM workout_move_link wml JOIN move m ON m.id=wml.move_id JOIN exercise be ON be.id=m.base_exercise_id WHERE wml.workout_id=".$wid." ORDER BY wml.order";
		$moveresults= mysqli_query($mysql,$movequery)or die(mysqli_error($mysql));
		$workoutrow['move'] = array();
		while($moverow = mysqli_fetch_array($moveresults,MYSQL_ASSOC)){
			$mid = $moverow['moveid'];
			$setquery = "SELECT msl.set_id AS 'setid', e.name AS 'exercise', e.type AS 'exercisetype', s.reps_time AS 'reptime', s.weight AS 'weight', e.unit AS 'unit', st.type AS 'settype', s.note AS 'setnote', msl.order AS 'order' FROM move_set_link msl JOIN `set` s ON s.id=msl.set_id JOIN exercise e ON e.id=s.exercise_id JOIN set_type st ON st.id=s.set_type_id WHERE msl.move_id=".$mid." ORDER BY msl.order";
			$setresults= mysqli_query($mysql,$setquery)or die(mysqli_error($mysql));
			$moverow['set'] = array();
			while($setrow = mysqli_fetch_array($setresults,MYSQL_ASSOC)){
				array_push($moverow['set'],$setrow);
			}
			array_push($workoutrow['move'],$moverow);
		}
		//echo json_encode($workoutrow,JSON_PRETTY_PRINT);
		array_push($data,$workoutrow);
	}
	ob_end_clean();
	echo json_encode($data,JSON_PRETTY_PRINT);

	ob_start();
	mysqli_close($mysql);
	ob_end_clean();

?>