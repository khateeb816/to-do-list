
<?php

    include 'db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $password = $_POST['Password'];
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if(password_verify($password, $row['password'])){
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['id'] = $row['id'];
            header('Location: index.php');
            exit();
        }else{
            echo "Invalid Password";
        }
    }else{
        echo "Invalid Email";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="registration-box">
        <div class="image-part">
            <img src="./images/man.jpg" alt="Login Logo">
        </div>
        <h1>Login</h1>
        <form action="" method="post">
            <label for="name">Email : </label><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <label for="name">Password</label><br>
            <input type="password" name="Password"  placeholder="Password" required><br>
            <input type="checkbox" name="tac" required><span>I agree with terms and conditions</span>
            <input type="submit" class="btn" value="Login">
        </form>
        <p>Don't have an account? <a href="./register.php">Register Here</a></p>
    </div>
</body>

</html>