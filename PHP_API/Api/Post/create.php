<?php
//Header 
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-type, Access-Control-Allow-Methods, Authorization, X-Requested-with');

include_once '../../Config/Database.php';
include_once '../../Models/Post.php';

$database = new Database();
$db = $database->connect();

//Instantiate blog Post Object
$post = new Post($db);

//Get New Posted data
$data = json_encode(file_get_contents("php://input"));

$post->title = $data->title;
$post->body = $data->body;
$post->auhtor = $data->author;
$post->category_id = $data->category_id;

//create Post
if($post->create()){
	echo json_encode(
		array('messeage' => 'Post Created')
	);
}
else{
		echo json_encode(
			array('message' => 'Post Not Created')
		);
	}
