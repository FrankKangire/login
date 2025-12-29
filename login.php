<?php
include "connection.php";

if(isset($_POST["submit"])){
    $username = $_POST["name"];
    $password = $_POST["pass"];

    $sql = "select * from users where username = '$username' or email = '$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if($row){
        if(password_verify($password, $row["password"])){
            session_start();
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["username"] = $row["username"];
            header("Location: welcome.php");
        }
        else{
            echo '
            <script>
            alert("Wrong password");
            </script>';
        }
    }
    else{
        echo '
        <script>
        alert("Username or email does not exist");
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
    <form action="login.php" method="post">
        Username/ Email: <input type="text" name="name" placeholder="Enter your name or email"/><br><br>
        Password : <input type="password" name="pass" placeholder="Enter your password"/><br><br>
        <button type="submit" name="submit">SignIn</button>
    </form>
</body>
</html>