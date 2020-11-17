<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Method: DELETE');
header('Access-Control-Allow-Header: Access-Control-Allow-Header, Content-Type, Access-Control-Allow-Method, Authorization, X-Requested-With');

$api_request = file_get_contents('php://input');
$api_data = json_decode($api_request, true);

$id = $api_data['cid'];

include ('Config.php');

$sql = "DELETE FROM `categories` WHERE `id`= {$id}";
$query = $connection->prepare($sql);
$query->execute();

$rowNumber = $query->rowCount();

//$lastInsertId = $connection->lastInsertId();

if($rowNumber > 0){
	
	echo json_encode(array("Message" => 'Categories Deleted Successfully', 'Status' => true));
}
else{
	
	echo json_encode(array("Message" => 'Deleted Operation Failed', 'status' => false));
}


?>