<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] !== 'GET'){ 	//Validating request method.
	die(json_encode(array("error" => "Only GET requests are allowed.")));
}

if(!isset($_GET["id"]) || empty(trim($_GET["id"])) )
	die(json_encode(array("error" => "Missing request paramters.")));

$id = trim($_GET["id"]);

$sql = "UPDATE `tracks` SET `likes`= tracks.likes + 1 WHERE `track_id` = $id";
$con = mysqli_connect("127.0.0.1","Test_user","","jamhub");

$status = "";
$error = "";

if(mysqli_query($con, $sql))
	$status = "success";
else{
	$status = "fail";
	$error = mysqli_error($con);
}

echo json_encode(array("status" => $status, "error" => $error));

mysqli_close($con);
?>