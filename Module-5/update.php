<?php
session_start();
$users = json_decode(file_get_contents('users.json'), true);

if (!isset($_SESSION['email']) || !isset($users[$_SESSION['email']])) {
    header("Location: login.php"); 
    exit();
}

$update_message = "";

if (isset($_POST['update_role'])) {
    $user_email = $_POST['email']; 
    $new_role   = $_POST['role'];

    if (isset($users[$user_email])) {
        $users[$user_email]['role'] = $new_role;
        file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));
        $update_message = "Role updated successfully.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>User Registration and Login</title>
    
    <?php include 'bootstrap.php'; ?>


    <style>
        
    </style>
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between">
                        <h3>Update Role</h3>
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
                                    <?php
                                        if(!empty($users)) {
                                            foreach ($users as $email => $userInfo) {
                                                echo '<option value="' . $email . '">' . $email . '</option>';
                                            }
                                        } else {
                                            echo '<option value="" disabled>No emails found</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="role">Select Role:</label>
                                <select class="form-control" id="role" name="role">
                                    <option value="admin">Admin</option>
                                    <option value="manager">Manager</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                            <input class="btn btn-primary" type="submit" name="update_role" value="Update">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
