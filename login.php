<?php
include "connection.php";
session_start();

if(isset($_POST["submit"])){
    $username = mysqli_real_escape_string($conn, $_POST["name"]);
    $password = $_POST["pass"];

    $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if($row && password_verify($password, $row["password"])){
        $_SESSION["user_id"] = $row["id"];
        $_SESSION["username"] = $row["username"];
        header("Location: welcome.php");
    } else {
        echo '<script>alert("Invalid credentials");</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Jungle Professor</title>
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <style>
        body { background: #1a1a1a; color: white; }
        .auth-card { background: white; color: #333; border-radius: 15px; padding: 30px; margin-top: 100px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
    </style>
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="auth-card">
                    <h2 class="text-center mb-4">Login</h2>
                    <form action="login.php" method="post">
                        <div class="mb-3">
                            <label class="form-label">Username or Email</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="pass" class="form-control" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-success w-100">Sign In</button>
                    </form>
                    <p class="text-center mt-3 small">New here? <a href="signup.php">Create account</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>