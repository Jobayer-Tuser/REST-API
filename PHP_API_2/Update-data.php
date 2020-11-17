<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Method: PUT');
header('Access-Control-Allow-Header: Access-Control-Allow-Header, Content-Type, Access-Control-Allow-Method, Authorization, X-Requested-With');

$api_request = file_get_contents('php://input');
$api_data = json_decode($api_request, true);

$id = $api_data['cid'];
$cat_name = $api_data['cName'];

include ('Config.php');

$sql = "UPDATE `categories` SET `name`= '{$cat_name}' WHERE `id`= {$id}";
$query = $connection->prepare($sql);
$query->execute();

$rowNumber = $query->rowCount();

//$lastInsertId = $connection->lastInsertId();

if($rowNumber > 0){
	
	echo json_encode(array("Message" => 'Categories Updated Successfully', 'Status' => true));
}
else{
	
	echo json_encode(array("Message" => 'Update Operation Failed', 'status' => false));
}


?>