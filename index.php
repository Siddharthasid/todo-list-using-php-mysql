<?php

    $errors = "";

    //Connect to the database
    $db = mysqli_connect('localhost', 'root', '', 'todo');

    if(isset($_POST['submit'])){
        $task = $_POST['task'];
        //if the input field is empty we cannot submit or add task to the database.
        if(empty($task)){
            $errors = "You must fill the task";
        }else{

        mysqli_query($db, "INSERT INTO tasks (task) VALUE ('$task')");
        header("location:index.php");
        }
    }

    //Delete task
    if(isset($_GET['del_task'])){
        $id = $_GET['del_task'];

        mysqli_query($db, "DELETE FROM tasks WHERE id = $id");
        header('location:index.php');
    }

    $tasks = mysqli_query($db, "SELECT * FROM tasks");
    



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo List Application using PHP and MySQL</title>
    <link rel="stylesheet" href="style.css">
    <!---font awesome cdn--->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
    
    <div class="heading">
        <h2>ToDo List Application using PHP and MySQL</h2>
    </div>

    <form method="POST" action="index.php">

        <?php
        
            if(isset($errors)){
        ?>
            <p><?php echo $errors; ?></p>
        <?php
            }
        
        ?>

        <input type="text" name="task" class="task_input">
        <button type="submit" class="add_btn" name="submit">Add Task</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Task</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $i = 1; //This $i is the index number variable
            while($row = mysqli_fetch_array($tasks)){
            ?>
            
            <tr>
                <td><?php echo $i; ?></td>
                <td class="task"><?php echo $row['task']; ?></td>
                <td class="delete">
                    <a href="index.php?del_task=<?php echo $row['id']; ?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                </td>
            </tr>

            <?php
                $i++;

                }
            ?>
           
        </tbody>
    </table>

</body>
</html>