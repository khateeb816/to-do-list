<?php
include 'db.php';

session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task = $_POST['task'];
    $user_id = $_SESSION['id'];
    $sql = "INSERT INTO tasks (task, user_id) VALUES ('$task', '$user_id')";
    if ($conn->query($sql) === TRUE) {
        echo '<script>window.location.href = "index.php?msg=Task Added Successfully"</script>';
    }
}
$sqlGet = "SELECT * FROM `tasks` WHERE `user_id` = '{$_SESSION['id']}'";
if (isset($_GET['date'])) {
    $date = $_GET['date'];
    $sqlGet = "SELECT * FROM `tasks` WHERE `user_id` = '{$_SESSION['id']}' AND DATE(`created_at`) = '$date'";    
} else{
    $sqlGet = "SELECT * FROM `tasks` WHERE `user_id` = '{$_SESSION['id']}'";

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <?php
        if (isset($_GET['msg'])) {
            echo "<div class='alert alert-success position-fixed w-75'>{$_GET['msg']}</div>
            <script>
                setTimeout(() => {
                    document.querySelector('.alert').style.display = 'none';
                }, 3000);
                </script>
            ";
        }
        ?>
        <div class="row">
            <h4 class="col-12 mt-5">Welcome back <?php echo $_SESSION['email']; ?></h4>
        </div>

        <div class="row">
            <h1 class="col-10 my-1">To Do List:</h1>
            <a href="logout.php" class="btn btn-primary h-75 col-2 mt-2 m-auto">Logout</a>
        </div>
        <form action="" method="POST">
            <input type="text" name="task" class="form-control" placeholder="Enter Task">
            <button type="submit" class="btn btn-primary mt-2">Add Task</button>
        </form>
        <form action="" method="GET" class="row">
            <label for="date" class="col-3 mt-3">Filter By Date:</label>
            <div class="col-4"></div>
            <input type="date" name="date" class="form-control col-3 h-75 mt-2">
            <button type="submit" class="btn btn-primary mt-2 col-2">Filter</button>
        </form>

        <div class="tasks my-2">
            <h3>Tasks:</h3>
            <ul class="row" style="text-decoration: none; list-style-type: none;">
                <?php
                $result = $conn->query($sqlGet);
                if ($result->num_rows == 0) {
                    echo "<div class='col-12 alert alert-danger'>No Tasks Found</div>";
                }
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='col-12 '>
                    <div class='row border p-2 rounded " . ($row['status'] == 'completed' ? 'alert-success' : '') . "'>
                        <div class='col-2 mt-2'>
                            <select name='status' id='status' class = 'form-control form-select' onchange='changeStatus({$row['id']}, this.value)'>
                                <option value='pending' " . ($row['status'] == 'pending' ? 'selected' : '') . ">pending</option>
                                <option value='completed' " . ($row['status'] == 'completed' ? 'selected' : '') . ">Completed</option>
                            </select>
                        </div>
                        <div class='col-8 mt-3' style = '" . ($row['status'] == 'completed' ? 'text-decoration: line-through;' : '') . "'>{$row['task']}</div>
                        <div class='col-2 mt-1'><a href='delete-task.php?id={$row['id']}' class='btn btn-danger'>Delete</a></div>
                    </div>
                </div>";
                }
                ?>

            </ul>
        </div>
    </div>
    <script>
        function changeStatus(id, value) {
            window.location.href = `change-status.php?id=${id}&value=${value}`;
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>