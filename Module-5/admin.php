<?php
session_start();

$usersFile = 'users.json';
$users = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

function saveUsers($users, $file)
{
    file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
}

if (!isset($_SESSION['email']) || !isset($users[$_SESSION['email']]) || $users[$_SESSION['email']]['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_POST['update_role'])) {
    $emailToUpdate = $_POST['emailToUpdate'];
    $newRole = $_POST['newRole'];

    if (isset($users[$emailToUpdate])) {
        $users[$emailToUpdate]['role'] = $newRole;
        saveUsers($users, $usersFile);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Use Role Management App</title>
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

        .btn-custom {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
        }

        .btn-custom:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .btn-custom-alt {
            background-color: #28a745;
            border-color: #28a745;
            color: #fff;
        }

        .btn-custom-alt:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .btn-custom-blue {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }

        .btn-custom-blue:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header text-center">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3>Use Role Management App</h3>
                            <a href="logout.php" class="btn btn-custom">Logout</a>
                        </div>
                    </div>

                    <div class="card-body text-center">
                        <p>Welcome to the Admin Home Page.</p>
                        <a href="update.php" class="btn btn-custom-alt">Update Role</a>
                        <a href="delete_role.php" class="btn btn-custom">Delete Role</a>
                        <a href="view_user.php" class="btn btn-custom-blue">View Users</a>
                        <a href="edit_user.php" class="btn btn-success btn-custom">Edit User</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
