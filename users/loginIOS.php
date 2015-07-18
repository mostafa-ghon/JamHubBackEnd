<?php
// Read request parameters

if ($_SERVER["REQUEST_METHOD"] !== 'POST'){ //Validating request method.
	die(json_encode(array("error" => "Only POST requests are allowed.")));
}

$request_body = file_get_contents('php://input');
if(empty($request_body))				//checking parameters
	die(json_encode(array("error" => "Missing request paramters.")));


$user_name= $_REQUEST["user_name"];
$password = $_REQUEST["password"];

$con = mysqli_connect("127.0.0.1","Test_user","","jamhub");
$sql = "SELECT * FROM `users` WHERE `user_name` LIKE '$user_name'";


// Store values in an array
$user = NULL;
$result = mysqli_query($con, $sql);			//searching for username entered and retrieving if found
if (mysqli_num_rows($result) > 0){
	$row = mysqli_fetch_assoc($result);
	$user = array("user_name" => $row["user_name"], "password" => $row["password"]
		, "first_name" => $row["first_name"], "last_name" => $row["last_name"], "email" => $row["email"]
		, "img_url" => $row["img_url"]);
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