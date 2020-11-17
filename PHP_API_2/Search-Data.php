<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');


$api_request = file_get_contents('php://input');
$api_data = json_decode($api_request, true);

$search = $api_data['search'];

#if we want to search/get data from searchbar 
#$search = isset($_GET['search']) ? $_GET['search'] : die();

include ('Config.php');

$query = $connection->prepare("SELECT * FROM `categories` WHERE `name` LIKE '%{$search}%' ");
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