<?php
header('Content-Type: application/json');

if(!isset($_FILES["image"])){
	die(json_encode(array("status" => "fail", "error" => "Image file was not submitted.")));
}

$target_dir = "images/";
$file_type = pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION);
$temp_name = basename($_FILES["image"]["tmp_name"]);
$target_file = $target_dir ."$temp_name.$file_type";

if (file_exists($target_file))
    die(json_encode(array("status" => "fail", "error" => "File already exists on the server.")));


if ($_FILES["image"]["size"] > 500000)
    die(json_encode(array("status" => "fail", "error" => "Image is too large.")));

if($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg" && $file_type != "gif" ) 
    die(json_encode(array("status" => "fail", "error" => "Unsupported file extension $file_type.")));

if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
	echo json_encode(array("status" => "success", "url" => $target_file));
} else 
	die(json_encode(array("status" => "fail", "error" => "Could not upload the submitted file.")));

?>