<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] !== 'POST'){ 	//Validating request method.
	die(json_encode(array("error" => "Only POST requests are allowed.")));
}

$request_body = file_get_contents('php://input');		//checking parameters
if(empty($request_body))
	die(json_encode(array("error" => "Missing request paramters.")));

$user = json_decode($request_body);

if(json_last_error() != JSON_ERROR_NONE)			//validating JSON object
	die(json_encode(array("error" => "Invalid JSON object.")));

$user_name = $user->user_name;
$password = $user->password;
$first_name = $user->first_name;
$last_name = $user->last_name;
$email = $user->email;
$img_url = $user->img_url;

$con = mysqli_connect("127.0.0.1","Test_user","","jamhub");
if($password==NULL){
	if($img_url==""){
		$sql = "UPDATE `users` SET `first_name` = '$first_name', `last_name` = '$last_name'
				, `email` = '$email' WHERE `user_name` = '$user_name'";
	}else{
		$sql = "UPDATE `users` SET `first_name` = '$first_name', `last_name` = '$last_name'
				, `email` = '$email', `img_url` = '$img_url' WHERE `user_name` = '$user_name'";
	}
}
else{
	$sql = "UPDATE `users` SET `password` = '$password', `first_name` = '$first_name'
			, `last_name` = '$last_name', `email` = '$email', `img_url` = '$img_url' 
			WHERE `user_name` = '$user_name'";
}

$status="";
$error="";
if(mysqli_query($con, $sql)){
	$status = "success";
}
else{
	$status = "fail";
	$error = mysqli_error($con);
}

$sql = "SELECT `img_url` FROM `users` WHERE `user_name` = '$user_name'";
$result = mysqli_query($con, $sql);
$url="";
if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$url = $row["img_url"];
}

echo json_encode(array("status" => $status, "error" => $error, "url" => $url));

mysqli_close($con);
?>