<?php
	header('Content-Type: application/json');

	if ($_SERVER["REQUEST_METHOD"] !== 'POST'){ //Validating request method.
		die(json_encode(array("error" => "Only POST requests are allowed.")));
	}

	$request_body = file_get_contents('php://input');
	if(empty($request_body))				//checking parameters
		die(json_encode(array("error" => "Missing request paramters.")));

	$login = json_decode($request_body);

	if(json_last_error() != JSON_ERROR_NONE)		//validating JSONObject
		die(json_encode(array("error" => "Invalid JSON object.")));

	$user_name = $login->user_name;
	$password = $login->password;

	$con = mysqli_connect("127.0.0.1","Test_user","","jamhub");
	$sql = "SELECT * FROM `users` WHERE `user_name` LIKE '$user_name'";

	$user = NULL;
	$result = mysqli_query($con, $sql);			//searching for username entered and retrieving if found
	if (mysqli_num_rows($result) > 0){
		$row = mysqli_fetch_assoc($result);
		$user = array("user_id" => $row["user_id"], "user_name" => $row["user_name"]
			, "password" => $row["password"], "first_name" => $row["first_name"]
			, "last_name" => $row["last_name"]);
	}
	else{
 		die(json_encode(array("status" => "fail", "error" => "wrong username!")));
	}

 	if($password == $user["password"]){					//validating password
 		echo json_encode(array("status" => "success", "user" => $user));
 	}
 	else{
 		echo json_encode(array("status" => "fail", "error" => "wrong password!"));
 	}

	mysqli_close($con);
?>