<?php
session_start();

$usersFile = 'users.json';

$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

function saveUsers($users, $file)
{
    file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
}


if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

 
    if (empty($email) || empty($password)) {
        $errorMsg = "Please fill all the fields.";
    } else {
        if (isset($users[$email]) && $users[$email]['password'] == $password) {
            $_SESSION['email'] = $email;
            $role = $users[$email]['role'];

            if ($role == 'admin') {
                header("Location: admin.php"); 
            } elseif ($role == 'manager') {
                header("Location: manager_home.php");
            } elseif ($role == 'user') {
                header("Location: user_home.php"); 
            }

            exit();
        } else {
            $errorMsg = "Invalid email or password.";
        }

        saveUsers($users, $usersFile);
    }
}
?>







<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <?php
include 'bootstrap.php';
?>

<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            border-bottom: none;
            border-radius: 10px 10px 0 0;
        }

        .card-body {
            padding: 20px;
        }

        .btn-custom {
            margin: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 mx-auto">
                <h3 class="text-center mb-4">Use Role Management App</h3>
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between">
                        <h3>User Login</h3>
                        <a href="registration.php" class="btn btn-info text-white">
                            Create a New Account
                        </a>
                    </div>
                    <div class="card-body">
                        <?php

if ( isset( $errorMsg ) ) {
    echo "<p>$errorMsg</p>";
}

?>
                        <form class="form" method="POST">
                           
                            <input class="form-control" type="email" name="email" placeholder="Email"><br>
                            <input class="form-control" type="password" name="password" placeholder="Password"><br>
                            <input type="hidden" name="role" value="">
                            <input class="btn btn-primary" type="submit" name="register" value="Login">
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
</body>

</html>