<?php
session_start();
if(!isset($_SESSION["user_id"])){
    header("Location:login.php");
    close();
}

require "connection.php";
$username = $_SESSION["username"];
$user_id = $_SESSION["user_id"];
$documents = [];

$sql = "select * from documents where user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
$documents = mysqli_fetch_all($result, MYSQLI_ASSOC);

if(!is_dir("uploads")){
    mkdir("uploads", 0777, true);
}

if(isset($_POST["submit"])){
    $document_name = $_FILES["document"]["name"];
    $document_tmp_name = $_FILES["document"]["tmp_name"];
    $document_path = "uploads/".$document_name;

    if(move_uploaded_file($document_tmp_name, $document_path)){
        $sql = "insert into documents(user_id, document_name, document_path) values('$user_id', '$document_name', '$document_path')";
        $result = mysqli_query($conn, $sql);
        header("Location:welcome.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Document</title>
</head>
<body>
    <?php 
    include "navbar.php";
    ?>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <form action="welcome.php" method="post" enctype="multipart/form-data">
    <input type="file" name="document" required>
    <button type="submit" name="submit" id="submit">Upload Document</button>
    </form>
    <h3>Your Documents</h3>
    <ul>
            <?php foreach ($documents as $document): ?>
                <li><a href="<?php echo $document['document_path']; ?>"><?php echo $document['document_name']; ?></a></li>
                <?php endforeach; ?>
    </ul>
    <a href="logout.php">Logout</a>
    <script src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
</body>
</html>