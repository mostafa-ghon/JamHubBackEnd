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

	$con = mysqli_connect("127.0.0.1","Test_user","","jamhub");
	$sql = "INSERT INTO `users`(`user_name`, `password`, `first_name`, `last_name`) 
				VALUES ('$user_name', '$password', '$first_name', '$last_name')";

	$user_id=0;
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