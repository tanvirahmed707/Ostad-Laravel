<?php
session_start();
$users = json_decode(file_get_contents('users.json'), true);

if (!isset($_SESSION['email']) || !isset($users[$_SESSION['email']])) {
    header("Location: login.php");
    exit();
}

$update_message = "";

if (isset($_POST['edit_user'])) {
    $old_email = $_POST['email']; 
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];

    if (isset($users[$old_email])) {
        $new_email = $_POST['new_email'];
        $users[$new_email] = $users[$old_email];
        unset($users[$old_email]);
        $users[$new_email]['username'] = $new_username;
        $users[$new_email]['email'] = $new_email;
        $users[$new_email]['password'] = $new_password;
        file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));
        $update_message = "User details updated successfully.";
    }
}

function createNewEmail($old_email, $new_email, $new_username, $new_password) {
    global $users;

    if (isset($users[$old_email])) {
        $users[$new_email] = $users[$old_email];
        unset($users[$old_email]);
        $users[$new_email]['username'] = $new_username;
        $users[$new_email]['email'] = $new_email;
        $users[$new_email]['password'] = $new_password;
        file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));
    }
}

if (isset($_POST['create_new_email'])) {
    $old_email = $_POST['email'];
    $new_email = $_POST['new_email'];
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];

    createNewEmail($old_email, $new_email, $new_username, $new_password);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit User - Use Role Management App</title>
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
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between">
                        <h3>Edit User Details</h3>
                        <a href="admin.php" class="btn btn-danger">Back to Home</a>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($update_message)) : ?>
                            <div class="alert alert-success"><?php echo $update_message; ?></div>
                        <?php endif; ?>
                        <form class="form" method="POST">
                            <div class="form-group">
                                <label for="email">Select Email:</label>
                                <select class="form-control" id="email" name="email">
                                    <?php foreach ($users as $email => $userInfo) : ?>
                                        <option value="<?php echo $email; ?>"><?php echo $email; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="new_email">New Email:</label>
                                <input type="email" class="form-control" id="new_email" name="new_email" required>
                            </div>
                            <div class="form-group">
                                <label for="new_username">New Username:</label>
                                <input type="text" class="form-control" id="new_username" name="new_username" required>
                            </div>
                            <div class="form-group">
                                <label for="new_password">New Password:</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                            </div>
                            <input class="btn btn-primary" type="submit" name="edit_user" value="Update">
                        </form>
                        <hr>
                        
                                     <?php foreach ($users as $email => $userInfo) : ?>
                                        <option value="<?php echo $email; ?>"><?php echo $email; ?></option>
                                    <?php endforeach; ?> 



                                </select> 
                            </div>  

        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
