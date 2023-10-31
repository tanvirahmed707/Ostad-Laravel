<?php
session_start();

$usersFile = 'users.json';
$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

if (!isset($_SESSION['email']) || !isset($users[$_SESSION['email']]) || $users[$_SESSION['email']]['role'] !== 'user') {
    header("Location: login.php");
    exit();
}


$username = $users[$_SESSION['email']]['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home - Use Role Management App</title>
    <?php include 'bootstrap.php'; ?>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3>Welcome, <?php echo $username; ?></h3>
                    </div>
                    <div class="card-body">
                        
                        <p>You are logged in as a user.</p>
                        <a href="logout.php" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
