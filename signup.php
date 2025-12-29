<?php
if(isset($_POST["submit"])){
    include "connection.php";

    $username = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["pass"];
    $cpassword = $_POST["cpass"];

    $sql = "select * from users where username = '$username' or email = '$email'";
    $result = mysqli_query($conn, $sql);
    $count_user_or_email = mysqli_num_rows($result);

    if($count_user_or_email == 0){
        if($password == $cpassword){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "insert into users(username, email, password) values('$username', '$email', '$hash')";
            $result = mysqli_query($conn, $sql);

            $sql = "select * from users where username = '$username' or email = '$email'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            session_start();
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["username"] = $username;
            header("Location: welcome.php");
        }
        else{
            echo '
            <script>
            alert("Password does not match");
            </script>
            ';
        }

    }
    else{
        echo '
        <script>
        alert("Username or Email already exist");
        </script>
        ';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/bootstrap-5.3.3-dist/css/bootstrap.min.css"/>
    <title>Document</title>
</head>
<body>
<?php
    include "navbar.php";
    ?>
    <form method="post" action="signup.php">
        Username:        <input type="text" name="name" placeholder="Enter your name"/><br><br>
        Email:           <input type="email" name="email" placeholder="Enter your email"/><br><br>
        Password :       <input type="password" name="pass" placeholder="Enter your password"/><br><br>
        Retype Password: <input type="password" name="cpass" placeholder="Re-enter your password"/><br><br>
        <button type="submit" name="submit">SignIn</button>
    </form>
</body>
</html>