<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$api_request = file_get_contents('php://input');
$api_data = json_decode($api_request, true);

$cat_id = $api_data['cid'];

include ('Config.php');

$query = $connection->prepare("SELECT * FROM `categories` WHERE id= {$cat_id}");
$query->execute();
$result = $query->fetchAll();

if($result > 0){
	
echo json_encode($result);
}
else{
	
echo json_encode(array('Message' => 'Result Not Found', 'status' => false));
}

//echo "<pre>";

//print_r($result);

/* "<select>";

foreach($result AS $eachPerson)
{
	echo "<option>".$eachPerson['full_name']."</option>";
}

echo "</select>";*/
?>