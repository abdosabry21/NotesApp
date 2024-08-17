<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Registration Page</title>
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2980b9;
            --background-color: #ecf0f1;
            --text-color: #2c3e50;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--background-color);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: var(--text-color);
        }

        .register-container {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        input {
            width: 100%;
            padding: 10px;
            border: none;
            border-bottom: 2px solid #ddd;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input:focus {
            outline: none;
            border-bottom-color: var(--primary-color);
        }

        label {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 1rem;
            color: #999;
            transition: all 0.3s ease;
            pointer-events: none;
        }

        input:focus + label,
        input:not(:placeholder-shown) + label {
            top: -20px;
            left: 0;
            font-size: 0.8rem;
            color: var(--primary-color);
        }

        button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: var(--secondary-color);
        }

        .login-link {
            text-align: center;
            margin-top: 1rem;
        }

        .login-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Create Account</h2>
        <form method="post">
            <div class="input-group">
                <input type="text" id="fullname" required placeholder=" " name="fullname">
                <label for="fullname">Full Name</label>
            </div>
            <div class="input-group">
                <input type="email" id="email" required placeholder=" " name="email">
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <input type="text" id="username" required placeholder=" " name="username">
                <label for="username">Username</label>
            </div>
            <div class="input-group">
                <input type="password" id="password" required placeholder=" " name="password">
                <label for="password">Password</label>
            </div>
            <button type="submit" name="register">Register</button>
        </form>
        <div class="login-link">
            <a href="http://localhost/Nots_app/index.php">Already have an account? Login</a>
            
        </div>
    </div>
</body>
</html>


<?php 


if(isset($_POST['register'])){

    $fullname=$_POST['fullname'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    
    
// Creat the datbase

    $conn=mysqli_connect("localhost","root",'');
    $sql="CREATE DATABASE IF NOT EXISTS `mynotesapp`";
    $result=mysqli_query($conn,$sql);
    mysqli_close($conn);








// connect with database

    $conn=mysqli_connect('localhost','root','','mynotesapp');
    $sql1="SELECT  `username` FROM `users` WHERE `username`='$username'";
    $sql2="SELECT  `email` FROM `users` WHERE `email`='$email'";


// Check if the in the database or not  



    $result1=mysqli_query($conn,$sql1);
    $row1=mysqli_fetch_assoc($result1);


    $result2=mysqli_query($conn,$sql2);
    $row2=mysqli_fetch_assoc($result2);





    if( !empty($row1) || !empty($row2)){
        echo '<script>alert("email or username is taken")</script>';
    }else{
        $sql="INSERT INTO `users`(`full_name`, `username`, `email`, `password`) VALUES ('$fullname','$username','$email','$password')";
        $result=mysqli_query($conn,$sql);
        echo "the Account is creaated ";
        echo '<script> location.replace("http://localhost/Nots_app/index.php")</script>';
    
    }


}






?>