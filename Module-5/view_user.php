<?php
session_start();

$usersFile = 'users.json';
$allUsers = file_exists($usersFile) ? json_decode(file_get_contents($usersFile), true) : [];

function getUsersByRole($role)
{
    global $allUsers;
    $filteredUsers = [];
    foreach ($allUsers as $email => $userInfo) {
        if ($userInfo['role'] === $role) {
            $filteredUsers[$email] = $userInfo;
        }
    }
    return $filteredUsers;
}

function deleteUser($email)
{
    global $allUsers;
    if (isset($allUsers[$email])) {
        unset($allUsers[$email]);
        saveUsers($allUsers, 'users.json');
    }
}

function saveUsers($users, $file)
{
    file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT));
}

if (isset($_POST['delete'])) {
    $emailToDelete = $_POST['emailToDelete'];
    deleteUser($emailToDelete);
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
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
                    <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>All Users</h3>
                    <a href="admin.php" class="btn btn-danger">Back to Home</a>
                    </div>

                    <div class="card-body">
                        <h4>Admins</h4>
                        <ul>
                            <?php
                            $admins = getUsersByRole('admin');
                            foreach ($admins as $email => $userInfo) {
                                echo "<li>Email: $email, Username: {$userInfo['username']} 
                                <form method='POST' style='display:inline;'>
                                    <input type='hidden' name='emailToDelete' value='$email'>
                                    <button type='submit' class='btn btn-link' name='delete'>Delete</button>
                                </form>
                                </li>";
                            }
                            ?>
                        </ul>

                        <h4>Managers</h4>
                        <ul>
                            <?php
                            $managers = getUsersByRole('manager');
                            foreach ($managers as $email => $userInfo) {
                                echo "<li>Email: $email, Username: {$userInfo['username']} 
                                <form method='POST' style='display:inline;'>
                                    <input type='hidden' name='emailToDelete' value='$email'>
                                    <button type='submit' class='btn btn-link' name='delete'>Delete</button>
                                </form>
                                </li>";
                            }
                            ?>
                        </ul>

                        <h4>Users</h4>
                        <ul>
                            <?php
                            $users = getUsersByRole('user');
                            foreach ($users as $email => $userInfo) {
                                echo "<li>Email: $email, Username: {$userInfo['username']} 
                                <form method='POST' style='display:inline;'>
                                    <input type='hidden' name='emailToDelete' value='$email'>
                                    <button type='submit' class='btn btn-link' name='delete'>Delete</button>
                                </form>
                                </li>";
                            }
                            ?>
                           
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>