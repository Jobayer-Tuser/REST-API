<?php
//Header 
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

include_once '../../Config/Database.php';
include_once '../../Models/Post.php';

$database = new Database();
$db = $database->connect();

//Instantiate blog Post Object
$post = new Post($db);

//Blog Post query
$result = $post->read();

//Get Row count
$num = $result->rowCount();

//check if any objects
if($num > 0){
	$post_arr = array();
	$post_arr['data'] = array();
	
	while($row = $result->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		
		$post_item = array(
			'id' => $id,
			'title' => $title,
			'body' => html_entity_decode($body),
			'author' =>$author,
			'category_id' => $category_id,
			'category_name' => $category_name
		);
		
		//Push to data
		array_push($post_arr['data'], $post_item);
		
		//turn to json output
		echo json_encode($post_arr);
		
	}
}

else{
	//No posts
	echo json_encode(
		array('message' => 'No Post Found')
	);
}