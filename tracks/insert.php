<?php
	header('Content-Type: application/json');

	if ($_SERVER["REQUEST_METHOD"] !== 'POST'){ 	//Validating request method.
		die(json_encode(array("error" => "Only POST requests are allowed.")));
	}

	$request_body = file_get_contents('php://input');		//checking parameters
	if(empty($request_body))
		die(json_encode(array("error" => "Missing request paramters.")));

	$track = json_decode($request_body);

	if(json_last_error() != JSON_ERROR_NONE)			//validating JSON object
		die(json_encode(array("error" => "Invalid JSON object.")));

	$name = $track->name;
	$band = $track->band;
	$user_id = $track->user_id;
	$band_id = $track->band_id;
	$duration = $track->duration;
	//$ancestor_id = $track->ancestor_id;
	$upload_date = $track->upload_date;
	$instrument = $track->instrument;
	$tags = $track->tags;
	$img_url = $track->img_url;
	$track_url = $track->track_url;

	$con = mysqli_connect("127.0.0.1","Test_user","","jamhub");
	if($band){
		$sql = "INSERT INTO `tracks`(`name`, `band_id`, `duration`, `upload_date`, `instrument`, `tags`, `img_url`
					, `track_url`) VALUES ('$name', $band_id, $duration, '$upload_date', '$instrument'
						, '$tags', '$img_url', '$track_url')";
	}
	else{
		$sql = "INSERT INTO `tracks`(`name`, `user_id`, `duration`, `upload_date`, `instrument`, `tags`, `img_url`
					, `track_url`) VALUES ('$name', $user_id, $duration, '$upload_date', '$instrument'
						, '$tags', '$img_url', '$track_url')";
	}

	$track_id=0;
	$status="";
	$error="";
	if(mysqli_query($con, $sql)){
		$status = "success";
		$user_id = mysqli_insert_id($con);
	}
	else
	{
		$status = "fail";
		$error = mysqli_error($con);
	}

	echo json_encode(array("status" => $status, "user_id" => $user_id, "error"=> $error));

	mysqli_close($con);
?>