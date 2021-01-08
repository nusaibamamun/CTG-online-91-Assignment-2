<?php

class Database
{
	public $connection;
	public $hostName = "localhost";
	public $dbName = "book_database";
	public $dbUserName = "root";
	public $dbPassword = "";


	//connection to database
	public function __construct()
	{
		$this->connection = new PDO("mysql:host=$this->hostName;dbname=$this->dbName", $this->dbUserName, $this->dbPassword);
		if ($this->connection) {
			// echo 'Connected!';
		} else {
			echo 'Error!';
		}
	}

	//master save data to database
	public function saveList($language, $book_name, $author, $summary, $rating, $category, $buy_date)
	{
		$query = "INSERT INTO list_books (language,book_name,author,summary,rating,category,buy_date) VALUES (:language,:book_name,:author,:summary,:rating,:category,:buy_date)";
		$statement = $this->connection->prepare($query);
		$statement->execute(array(
			':language' => $language,
			':book_name' => $book_name,
			':author' => $author,
			':summary' => $summary,
			':rating' => $rating,
			':category' => $category,
			':buy_date' => $buy_date
		));
	}

	//fetch data 
	public function getList()
	{
		$query = "SELECT * FROM list_books";
		$statement = $this->connection->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		return $result;
	}

	//register a user
	public function saveUser($email, $username, $password)
	{
		$query = "INSERT INTO users (email,username,password) VALUES (:email,:username,:password)";
		$statement = $this->connection->prepare($query);
		$statement->execute(array(
			':email' => $email,
			':username' => $username,
			':password' => md5($password)

		));
	}

	//fetch a user
	public function fetchUserList($id)
	{
		$query = "SELECT * FROM list_books WHERE id=".$id;
		$statement = $this->connection->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		return $result;
	}

	//update a list
    public function updateList($id, $language, $book_name, $author, $summary, $rating, $category, $buy_date){
        $query = "UPDATE list_books SET language='$language', book_name='$book_name', author='$author', summary='$summary', rating='$rating', category='$category', buy_date='$buy_date'  WHERE id='$id'";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return 'success';
	}
	
	//delete a list
	public function delete($id){
		$query = "DELETE FROM list_books WHERE id= '$id'";
		$statement = $this->connection->prepare($query);
		$statement->execute();
		return 'success';
	}

	//login
    public function login($email,$username,$password){
        $password = md5($password);
        $query = "SELECT * FROM users WHERE email='$email' AND username='$username' AND password='$password'";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $result= $statement->fetchAll();
        return $result;
	}
	
	//check same username
    public function checkUsername($username){
        $query = "SELECT * FROM users WHERE username='$username'";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $result= $statement->fetchAll();
        return $result;
    }

}
?>