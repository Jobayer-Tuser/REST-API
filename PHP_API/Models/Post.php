<?php

class Post{
	
	private $conn;
	private $table= 'posts';
	
	//Post Properties
	public $id;
	public $category_id;
	public $category_name;
	public $title;
	public $body;
	public $author;
	public $created_at;
	
	//Constructor with DB
	public function __construct($db){
		$this->conn = $db;
	}
	
	public function read(){
		$query = 'SELECT
				c.name as category_name,
				p.id,
				p.category_id,
				p.title,
				p.body,
				p.author,
				p.created_at
			FROM
			  '. $this->table .' p
			LEFT JOIN
				categories c ON p.category_id = c.id
			ORDER BY
				p.created_at DESC' ;
			
		//Prepare Satement
		$stmt = $this->conn->prepare($query);
		
		//Execute Query
		$stmt->execute();
		
		return $stmt;
	}
	
	public function read_single(){
		//create Query
		$query = 'SELECT
				c.name as category_name,
				p.id,
				p.category_id,
				p.title,
				p.body,
				p.author,
				p.created_at
			FROM
			  '. $this->table .' p
			LEFT JOIN
				categories c ON p.category_id = c.id
			WHERE
				p.id = ? 
				LIMIT 0, 1 ' ;
			//Prepare Statement
			$stmt = $this->conn->prepare($query);
			
			//Bind ID
			$stmt->bindParam(1, $this->id);
			
			//Execute COmmand
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			
			//set Properties
			$this->title = $row['title'];
			$this->body = $row['body'];
			$this->author = $row['author'];
			$this->category_id = $row['category_id'];
			$this->category_name = $row['category_name'];	
	}
	
	public function create(){
		//create query
		$query = 'INSERT INTO ' . $this->table . 'SET `title`= :title, `body`= :body, `author`= :author, `category_id`';
		
		$stmt = $this->conn->prepare($query);
		
		//clean/ filter data 
		$this->title = htmlspecialchars(strip_tags($this->title));
		$this->body = htmlspecialchars(strip_tags($this->body));
		$this->author = htmlspecialchars(strip_tags($this->author));
		$this->category_id = htmlspecialchars(strip_tags($this->category_id));
		$this->category_id = htmlspecialchars(strip_tags($this->category_id));
		
		//Bind value
		$stmt->bindParam(':title', $this->title);
		$stmt->bindParam(':body', $this->body);
		$stmt->bindParam(':auhtor', $this->author);
		$stmt->bindParam(':category_id', $this->category_id);
		
		//Execute Query
		if($stmt>execute()){
			return true;
		}
		
		//Print error if somethinf wrong
		printf("Error: %s. \n", $stmt->error);
		
		return false;
	}
	
	
}