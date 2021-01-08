<?php
include 'Database.php';
$db = new Database();


//update a task
if(isset($_GET['msg'])){
    if($_GET['msg']==1){
        echo 'Data Updated!';
    }
}

//delete a list
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $db->delete($id);
    header('location:dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>
    <h2>This is your Dashboard!</h2>
    <table border="2" cellspacing="3">
        <thead>
            <th>No.</th>
            <th>Language</th>
            <th>Book's Name</th>
            <th>Author's Name</th>
            <th>Summary</th>
            <th>Rating</th>
            <th>Category</th>
            <th>Buying or Borrowing Date</th>
            <th colspan="3">Action</th>

        </thead>
        <tbody>
            <?php
            //fetch data
            $list = $db->getList();
            foreach ($list as $data) :
            ?>
                <tr>
                    <td><?= $data['id'];  ?></td>
                    <td><?= $data['language'];  ?></td>
                    <td><?= $data['book_name'];  ?></td>
                    <td><?= $data['author'];  ?></td>
                    <td><?= $data['summary'];  ?></td>
                    <td><?= $data['rating'];  ?></td>
                    <td><?= $data['category'];  ?></td>
                    <td><?= $data['buy_date'];  ?></td>
                    <td><a href="update.php?id=<?= $data['id']; ?>">Update</a><br><br>
                    <a onclick = "return confirm('Are you sure to delete?')" href="dashboard.php?delete=<?= $data['id']; ?>">Delete</a><br><br>
                    
                    </td>

                </tr>
            <?php
            endforeach
            ?>
        </tbody>
    </table>
</body>

</html>