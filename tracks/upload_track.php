<?php

header('Content-Type: application/json');

if(!isset($_FILES["track"])){
	die(json_encode(array("status" => "fail", "error" => "track file was not submitted.")));
}

$target_dir = "uploads/";
$file_type = pathinfo(basename($_FILES["track"]["name"]), PATHINFO_EXTENSION);
$temp_name = basename($_FILES["track"]["tmp_name"]);
$target_file = $target_dir ."$temp_name.$file_type";

if (file_exists($target_file))
    die(json_encode(array("status" => "fail", "error" => "File already exists on the server.")));


//if ($_FILES["track"]["size"] > 500000)
  //  die(json_encode(array("status" => "fail", "error" => "track is too large.")));

if (move_uploaded_file($_FILES["track"]["tmp_name"], $target_file))
	echo json_encode(array("status" => "success", "url" => $target_file));
else 
	die(json_encode(array("status" => "fail", "error" => "Could not upload the submitted file.")));
?>