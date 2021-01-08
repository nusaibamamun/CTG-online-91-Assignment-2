<?php

class Database{
    public $connection;
    public $hostName="localhost";
    public $dbName="ctg_todo";
    public $dbUserName="root";
    public $dbPassword="";

    //connection with database
    public function __construct()
    {
        $this->connection = new PDO("mysql:host=$this->hostName;dbname=$this->dbName", $this->dbUserName, $this->dbPassword);
            if($this->connection){
                // echo 'Connected!';
            }else{
                echo 'Error!';
            }
    }

    //master save data to database
    public function saveTask($title,$description,$imgName)
    {
        
        $userId = $_SESSION['id'];
        $query = "INSERT INTO tasks (user_id,title,description,images,status) VALUES ($userId,:title,:description,'$imgName',:status)";
        $statement = $this->connection->prepare($query);
        $statement->execute(array(
            ':title'=>$title,
            ':description'=>$description,
            ':status'=>'Active'

        ));
        
    }

    //fetch data
    public function getTasks(){
        $userId = $_SESSION['id'];
        $query = "SELECT * FROM tasks WHERE user_id=$userId";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $result= $statement->fetchAll();
        return $result;
    }

    //register a user
    public function userSave($username,$password)
    {
        $query = "INSERT INTO users (username,password,joining_date) VALUES (:username,:password,:joining_date)";
        $statement = $this->connection->prepare($query);
        $statement->execute(array(
            ':username' => $username,
            ':password' => md5($password),
            ':joining_date' => date('Y-m-d')
        ));

        //create profiles data
        $generatedId = $this->connection->lastInsertId();
        $query = "INSERT INTO profiles (user_id) VALUES ($generatedId)";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        
    }
    //fetch a user
    public function fetchUserTask($id){
        $query = "SELECT * FROM tasks WHERE id=".$id;
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $result= $statement->fetchAll();
        return $result;
    }

    //update a task
    public function updateTask($id,$title,$description){
        $query = "UPDATE tasks SET title='$title', description='$description' WHERE id='$id'";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return 'success';
    }

    //delete a task
    public function delete($id){
        $query = "DELETE FROM tasks WHERE id= '$id'";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return 'success';
    }

    //mark as complete
    public function complete($id){
        $query = "UPDATE tasks SET status='Complete' WHERE id='$id'";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return 'success';
    }

    //login
    public function login($username,$password){
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
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

    

    //master save profile data to database
    public function saveProfile($full_name,$email,$address)
    {
        
        $userId = $_SESSION['id'];
        $query = "INSERT INTO profiles (user_id,full_name,email,address) VALUES ($userId,:full_name,:email,:address)";
        $statement = $this->connection->prepare($query);
        $statement->execute(array(
            ':full_name'=>$full_name,
            ':email'=>$email,
            ':address'=>$address

        ));
        
    }

    //fetch data of profile
    public function getProfileInfo(){
        $userId = $_SESSION['id'];
        $query = "SELECT * FROM profiles WHERE user_id=$userId";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $result= $statement->fetchAll();
        return $result;
    }

    //fetch a user for profile
    public function fetchUserProfile($id){
        $query = "SELECT * FROM profiles WHERE id=".$id;
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $result= $statement->fetchAll();
        return $result;
    }

    //update a profile
    public function updateProfile($full_name,$email,$address){
        $query = "UPDATE profiles SET full_name='$full_name', email='$email', address='$address' WHERE id='$id'";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return 'success';
    }


}

?>