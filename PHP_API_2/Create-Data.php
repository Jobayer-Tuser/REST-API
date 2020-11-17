<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Header: Access-Control-Allow-Header, Content-Type, Access-Control-Allow-Method, Authorization, X-Requested-With');

$api_request = file_get_contents('php://input');
$api_data = json_decode($api_request, true);

$cat_name = $api_data['cName'];

include ('Config.php');

$query = "INSERT INTO `categories`(name) VALUES ('{$cat_name}')";
$query = $connection->prepare($query);
$query->execute();

$rowNumber = $query->rowCount();

$lastInsertId = $connection->lastInsertId();

if($rowNumber > 0){
	
	echo json_encode(array("Message" => 'Categories Created Successfully', 'Status' => true));
}
else{
	
	echo json_encode(array("Message" => 'Insert Operation Failed', 'status' => false));
}


?>