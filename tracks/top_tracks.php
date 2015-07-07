<?php
	header('Content-Type: application/json');

	if ($_SERVER["REQUEST_METHOD"] !== 'POST'){ 	//Validating request method.
		die(json_encode(array("error" => "Only POST requests are allowed.")));
	}

	$con = mysqli_connect("127.0.0.1","Test_user","","jamhub");
	$sql = "SELECT * FROM `tracks` WHERE 1";

	$result = mysqli_query($con, $sql);
	$results_array = array();

	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$results_array[] = array("track_id" => $row["track_id"], "name" => $row["name"]
				, "band" => $row["band"], "user_id" => $row["user_id"], "band_id" => $row["band_id"]
				, "duration" => $row["duration"], "ancestor_id" => $row["ancestor_id"]
				, "upload_date" => $row["upload_date"], "instrument" => $row["instrument"]
				, "likes" => $row["likes"], "rating" => $row["rating"], "tags" => $row["tags"]
				, "img_url" => $row["img_url"], "track_url" => $row["track_url"]);
		}
	}else{
	 	die(json_encode(array("status" => "fail", "results" => array())));
	}

	echo json_encode(array("status" => "success", "results" => $results_array));

	mysqli_close($con);
?>