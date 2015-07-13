<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] !== 'GET'){ 	//Validating request method.
	die(json_encode(array("error" => "Only GET requests are allowed.")));
}

if(!isset($_GET["name"]) || empty(trim($_GET["name"])) )
	die(json_encode(array("error" => "Missing request paramters.")));

$name = trim($_GET["name"]);

$sql = "SELECT * FROM `tracks` WHERE `track_name` LIKE '%$name%'";
$con = mysqli_connect("127.0.0.1","Test_user","","jamhub");

$result = mysqli_query($con, $sql);
$results_array = array();

if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		$results_array[] = array("track_id" => $row["track_id"], "track_name" => $row["track_name"]
				, "user_name" => $row["user_name"], "band_name" => $row["band_name"]
				, "duration" => $row["duration"], "ancestor_id" => $row["ancestor_id"]
				, "upload_date" => $row["upload_date"], "instrument" => $row["instrument"]
				, "likes" => $row["likes"], "rating" => $row["rating"], "tags" => $row["tags"]
				, "img_url" => $row["img_url"], "track_url" => $row["track_url"]);
	}
}else
		die(json_encode(array("status" => "fail", "results" => array())));

echo json_encode(array("status" => "success", "results" => $results_array));

mysqli_close($con);
?>