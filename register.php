<?php
include 'db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['fname'] ." " . $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['Password'];
    $confirm_password = $_POST['confirm_password'];
    if($password == $confirm_password){
        $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$encrypted_password')";
        if($conn->query($sql) === TRUE){
            header('Location: login.php');
            exit();
        }
    }else{
        echo "Password and Confirm Password do not match";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="registration-box">
        <div class="image-part">
            <img src="./images/man.jpg" alt="Registration Logo">
        </div>
        <h1>Registration</h1>
        <form action="" method="post">
            <label for="name">Name : </label><br>
            <input type="text" name="fname" placeholder="First Name" required>
            <input type="text" name="lname" placeholder="Last Name"><br>
            <label for="name">Email : </label><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <label for="name">Password</label><br>
            <input type="password" name="Password" placeholder="Password" required><br>
            <label for="name">Confirm Password</label><br>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>
            <input type="checkbox" name="tac" required><span>I agree with terms and conditions</span>
            <input type="submit" class="btn" value="Register">
        </form>
        <p>Already have an account? <a href="./login.php">Login Here</a></p>
    </div>
</body>

</html>