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

if (isset($_POST['delete_role'])) {
    $emailToDeleteRole = $_POST['emailToDeleteRole'];

    if (isset($users[$emailToDeleteRole])) {
        $users[$emailToDeleteRole]['role'] = '';
        saveUsers($users, $usersFile);
        $successMsg = "Role deleted successfully.";
    } else {
        $errorMsg = "Email not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Role - Use Role Management App</title>
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
                        <h3>Delete Role</h3> 
                        
                        
                    </div>
                    
                    <a href="admin.php" class="btn btn-success btn-sm btn-custom">Back to Home</a>

                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group">
                                <label for="emailToDeleteRole">Email:</label>
                                <input type="email" class="form-control" id="emailToDeleteRole" name="emailToDeleteRole" required>
                            </div>
                            <button type="submit" class="btn btn-danger" name="delete_role">Delete Role</button>
                        </form>

                        <h4 class="mt-4">Manager and User List</h4>
                        <ul>
                            <?php
                            foreach ($users as $email => $userInfo) {
                                if ($userInfo['role'] === 'manager' || $userInfo['role'] === 'user') {
                                    echo "<li>Email: $email, Role: {$userInfo['role']}</li>";
                                }
                            }
                            ?>
                        </ul>

                        <?php
                        if (isset($errorMsg)) {
                            echo "<div class='alert alert-danger mt-3' role='alert'>$errorMsg</div>";
                        } elseif (isset($successMsg)) {
                            echo "<div class='alert alert-success mt-3' role='alert'>$successMsg</div>";
                        }
                        ?>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
