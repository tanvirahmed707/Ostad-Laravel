<?php
session_start();

$usersFile = 'users.json';

$users = file_exists( $usersFile ) ? json_decode( file_get_contents( $usersFile ), true ) : [];

function saveUsers( $users, $file )
{
    file_put_contents( $file, json_encode( $users, JSON_PRETTY_PRINT ) );
}


if ( isset( $_POST['register'] ) ) {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $role     = $_POST['role']; 

    // Validation
    if ( empty( $username ) || empty( $email ) || empty( $password ) || empty( $role ) ) {
        $errorMsg = "Please fill all the fields.";
    } else {
        if ( isset( $users[$email] ) ) {
            $errorMsg = "Email already exists.";
        } else {
            $users[$email] = [
                'username' => $username,
                'password' => $password,
                'role'     => $role, 
            ];

            saveUsers( $users, $usersFile );
            $_SESSION['email'] = $email;
            $successMsg = "Registration successful!";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>User Registration and Login</title>
    <?php
        include 'bootstrap.php';
    ?>

    <style>
        
    </style>
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 mx-auto">
                <h3 class="text-center mb-4">Use Role Management App</h3>
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between">
                        <h3>User Registration</h3>
                        <a href="login.php" class="btn btn-info text-white">
                            Already have an account?
                        </a>
                    </div>
                    <div class="card-body">
                        <?php
                            if ( isset( $errorMsg ) ) {
                                echo "<p>$errorMsg</p>";
                            } elseif ( isset( $successMsg ) ) {
                                echo "<p>$successMsg</p>";
                            }
                        ?>
                        <form class="form" method="POST">
                            <input class="form-control" type="text" name="username" placeholder="Username"><br>
                            <input class="form-control" type="email" name="email" placeholder="Email"><br>
                            <input class="form-control" type="password" name="password" placeholder="Password"><br>
                            <select class="form-control" name="role"> 
                                <option value="user">User</option>
                            </select><br>
                            <input class="btn btn-primary" type="submit" name="register" value="Register">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
