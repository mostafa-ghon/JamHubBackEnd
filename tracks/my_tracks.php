<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] !== 'GET'){ 	//Validating request method.
	die(json_encode(array("error" => "Only GET requests are allowed.")));
}

if(!isset($_GET["uname"]) || empty(trim($_GET["uname"])) )
	die(json_encode(array("error" => "Missing request paramters.")));

$uname = trim($_GET["uname"]);

$sql = "SELECT COUNT(*) FROM `tracks` WHERE `user_name` = '$uname'";
$con = mysqli_connect("127.0.0.1","Test_user","","jamhub");

$result = mysqli_query($con, $sql);
$results_array = array();

if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	echo json_encode(array("status" => "success", "count" => $row["COUNT(*)"]));
}else
		die(json_encode(array("status" => "fail")));

mysqli_close($con);
?>