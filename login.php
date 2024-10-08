<?php
session_start();
include("db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $gmail = $_POST['mail'];
    $password = $_POST['pass'];

    if (!empty($gmail) && !empty($password) && !is_numeric($gmail)){
        $query= "SELECT * FROM form WHERE email = '$gmail' LIMIT 1 ";
        $result= mysqli_query($conn,$query);

        if($result){
            if($result && mysqli_num_rows($result) > 0){
                $user_data = mysqli_fetch_assoc($result);

                if($user_data['pass']==$password){
                    header('location: index.php');
                    die;
                }
            }
        }
        echo "<script type='text/javascript'> alert('Wrong Username or Password'); </script>";
    }
    else{
        echo "<script type='text/javascript'> alert('Wrong Username or Password'); </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login and Register</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="login">
        <h1>Login</h1>
        
        <form action="" method="POST">
            <label for="Email">Email</label>
            <input type="email" name="mail" id="Email" required>
            <label for="Password">Password</label>
            <input type="password" name="pass" id="Password">
            <input type="submit" name="" value="Submit">
        </form>
        <p>Not have an Account? <a href="./signup.php">Sign Up Here</a></p>
    </div>
</body>
</html>