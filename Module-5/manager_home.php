<?php
session_start();

$usersFile = 'users.json';
$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

if (!isset($_SESSION['email']) || !isset($users[$_SESSION['email']]) || $users[$_SESSION['email']]['role'] !== 'manager') {
    header("Location: login.php");
    exit();
}


$managerName = $users[$_SESSION['email']]['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Home - Use Role Management App</title>
    <?php include 'bootstrap.php'; ?>
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
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3>Welcome, <?php echo $managerName; ?></h3>
                    </div>
                    <div class="card-body">
                        <p>You are logged in as a manager.</p>
                        <a href="logout.php" class="btn btn-danger">Logout</a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
