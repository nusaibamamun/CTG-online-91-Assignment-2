<?php
session_start();
include 'Database.php';
$db = new Database();


//check login user
if(!isset($_SESSION['id'])){
    header('location: index.php');
}

//save data to database
if(isset($_POST['submit'])){
    $userId = $_SESSION['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    
    //file upload
    $tmpname = $_FILES['images']['tmp_name'];
    $imgSize = $_FILES['images']['size'];
    if($imgSize < 556016){
         $imgName = uniqid().'.jpg';
        move_uploaded_file($tmpname, 'images/'.$imgName);
        $db->saveTask($title,$description,$imgName);

        echo 'Data Saved!';
    }else{
        echo 'Image size mismatch';
    }
   

}

//show update success message
if(isset($_GET['msg'])){
    if($_GET['msg']==1){
        echo 'Data Updated!';
    }
}

//delete a task
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $db->delete($id);
    header('location:dashboard.php');
}

//mark as complete
if(isset($_GET['complete'])){
    $id = $_GET['complete'];
    $db->complete($id);
    header('location:dashboard.php'); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
     label {
        display: block;
        width: 200px;
      }
    </style>
</head>
<body>
    <h2>This is Dashboard</h2>
    
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="title">Write your title here:</label><br>
        <input type="text" name="title" placeholder="Your title"><br><br>
        <label for="description" >Write your description here:</label><br>
        <textarea name="description"  cols="60" rows="10" placeholder="Description of task"></textarea><br><br>
        <input type="file" name="images"><br><br>
        <input type="submit" name="submit" value="Add task">
    </form>
    <hr>
    <hr>
    <a href="profiles.php">Profile</a>
    <table border="2" cellpadding="10">
        <thead>
            
                <th>Title</th>
            
                <th>Description</th>
            
                <th colspan="3">Action</th>

                <th>Images</th>
           
        </thead>
        <tbody>
            <?php

            //fetch data from table
                $tasks = $db->getTasks();
                foreach ($tasks as $data): 
                    
                
            ?>

            <tr>
                <td><?php echo $data['title'];  ?></td>
                <td><?= $data['description'];  ?></td>
                <?php if($data['status'] == 'Complete'): ?>
                    <td><button disabled>Completed</button></td>
                <?php else:  ?>
                    <td><a href="update.php?id=<?= $data['id']; ?>">Update</a></td>
                    <td><a onclick = "return confirm('Are you sure to delete?')" href="dashboard.php?delete=<?= $data['id']; ?>">Delete</a></td> 
                    <td><a onclick = "return confirm('Are you sure to complete?')" href="dashboard.php?complete=<?= $data['id']; ?>">Mark as complete</a></td>

                    <?php endif; ?>
                    <td><img src="images/<?= $data['images']; ?>" width="40%" ></td>
            
            </tr>
            <?php
                endforeach

            ?>
        </tbody>
    </table>
    <a href="logout.php">Logout ( <?php echo $_SESSION['username'];   ?>)</a>
</body>
</html>