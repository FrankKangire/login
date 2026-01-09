<?php
include "connection.php";
if(isset($_POST["submit"])){
    $username = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = $_POST["pass"];
    $cpassword = $_POST["cpass"];

    $check = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' OR email = '$email'");
    if(mysqli_num_rows($check) == 0){
        if($password == $cpassword){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            mysqli_query($conn, "INSERT INTO users(username, email, password) VALUES('$username', '$email', '$hash')");
            
            // LOG IN AUTOMATICALLY
            $new_user_res = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
            $user_data = mysqli_fetch_assoc($new_user_res);
            
            session_start();
            $_SESSION["user_id"] = $user_data["id"];
            $_SESSION["username"] = $user_data["username"];
            
            header("Location: welcome.php");
            exit();
        } else { echo '<script>alert("Passwords do not match");</script>'; }
    } else { echo '<script>alert("User already exists");</script>'; }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SignUp - Jungle Professor</title>
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <style>
        body { background: #121212; color: white; }
        .auth-card { background: white; color: #333; border-radius: 15px; padding: 30px; margin-top: 50px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
    </style>
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="auth-card">
                    <h2 class="text-center mb-4">Register</h2>
                    <form method="post" action="signup.php">
                        <div class="mb-3"><label class="form-label">Username</label><input type="text" name="name" class="form-control" required></div>
                        <div class="mb-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control" required></div>
                        <div class="mb-3"><label class="form-label">Password</label><input type="password" name="pass" class="form-control" required></div>
                        <div class="mb-3"><label class="form-label">Confirm Password</label><input type="password" name="cpass" class="form-control" required></div>
                        <button type="submit" name="submit" class="btn btn-primary w-100">Create Account & Play</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="bootstrap-5.3.3-dist/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>