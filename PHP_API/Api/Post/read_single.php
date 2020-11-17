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

//Get ID 
$post->id = isset($_GET['id']) ? $_GET['id'] : die();

//Get Post
$post->read_single();

//create array
$post_arr = array(

	'id' => $post->id,
	'title' =>$post->title,
	'body' => $post->body,
	'author' => $post->author,
	'category_id' => $post->category_id,
	'category_name' => $post->category_name
);

//Make JSON
print_r( json_encode($post_arr));
