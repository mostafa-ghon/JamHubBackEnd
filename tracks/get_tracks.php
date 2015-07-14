<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] !== 'GET'){ 	//Validating request method.
	die(json_encode(array("error" => "Only GET requests are allowed.")));
}

if(!isset($_GET["uname"]) || empty(trim($_GET["uname"])) )
	die(json_encode(array("error" => "Missing request paramters.")));

$uname = trim($_GET["uname"]);

$sql_tracks = "SELECT COUNT(*) FROM `tracks` WHERE `user_name` = '$uname' AND 'ancestor_id' = 0";
$sql_jams = "SELECT COUNT(*) FROM `tracks` WHERE `user_name` = '$uname' AND 'ancestor_id' > 0";
$con = mysqli_connect("127.0.0.1","Test_user","","jamhub");
$tracks=0;
$jams=0;

$result = mysqli_query($con, $sql_tracks);
if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$tracks = $row["COUNT(*)"];
}else
	die(json_encode(array("status" => "fail")));

$result = mysqli_query($con, $sql_jams);
if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$jams = $row["COUNT(*)"];
}else
	die(json_encode(array("status" => "fail")));

echo json_encode(array("status" => "success", "tracks" => "$tracks", "jams" => $jams));

mysqli_close($con);
?>