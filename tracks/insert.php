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
$user = $track->user_name;
$band = $track->band_name;
$duration = $track->duration;
//$ancestor_id = $track->ancestor_id;
$upload_date = $track->upload_date;
$instrument = $track->instrument;
$tags = $track->tags;
$img_url = $track->img_url;
$track_url = $track->track_url;

$con = mysqli_connect("127.0.0.1","Test_user","","jamhub");
if($user == NULL){
	$sql = "INSERT INTO `tracks`(`track_name`, `band_name`, `duration`, `upload_date`, `instrument`,
		`tags`, `img_url` , `track_url`) VALUES ('$name', '$band', $duration, '$upload_date',
		'$instrument', '$tags', '$img_url', '$track_url')";
}
else{
	$sql = "INSERT INTO `tracks`(`track_name`, `user_name`, `duration`, `upload_date`, `instrument`,
		`tags`, `img_url` , `track_url`) VALUES ('$name', '$user', $duration, '$upload_date',
		'$instrument', '$tags', '$img_url', '$track_url')";
}

$track_id=0;
$status="";
$error="";
if(mysqli_query($con, $sql)){
	$sql = "UPDATE `users` SET `num_of_tracks` = 
			(SELECT COUNT(*) FROM `tracks` WHERE tracks.user_name = users.user_name AND 'ancestor_id' = 0)";
	if(mysqli_query($con, $sql)){
		$sql = "UPDATE `users` SET `num_of_jams` = 
			(SELECT COUNT(*) FROM `tracks` WHERE tracks.user_name = users.user_name AND 'ancestor_id' > 0)";
		if(mysqli_query($con, $sql)){
			$status = "success";
			$user_id = mysqli_insert_id($con);
		}
		else{
			$status = "Ufail";
			$error = mysqli_error($con);
		}
	}
	else{
		$status = "Ufail";
		$error = mysqli_error($con);
	}
}
else
{
	$status = "fail";
	$error = mysqli_error($con);
}

echo json_encode(array("status" => $status, "user_id" => $user_id, "error"=> $error));

mysqli_close($con);
?>