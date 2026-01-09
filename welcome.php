<?php
session_start();
if(!isset($_SESSION["user_id"])){ header("Location: login.php"); exit(); }
require "connection.php";

$user_id = $_SESSION["user_id"];

// Ensure uploads folder exists
if(!is_dir("uploads")) mkdir("uploads", 0777, true);

// Fetch files specifically for this logged-in user
$result = mysqli_query($conn, "SELECT * FROM documents WHERE user_id = '$user_id'");
$documents = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Dashboard - Jungle Professor</title>
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <style>
        body { background: #f4f7f6; }
        .dashboard-header { background: #2c3e50; color: white; padding: 40px 0; margin-bottom: 30px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
    </style>
</head>
<body>
    <?php include "navbar.php"; ?>

    <div class="dashboard-header text-center">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <p>Manage your files or start a new adventure.</p>
        <a href="server.php" class="btn btn-warning fw-bold px-4 mt-2">GO TO GAME ROOM</a>
        <a href="view_history.php" class="btn btn-info fw-bold px-4 mt-2 ms-2">VIEW GAME HISTORY</a>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card p-4">
                    <h5>Upload Document</h5>
                    <form action="upload_logic.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input type="file" name="document" class="form-control" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary w-100">Upload Now</button>
                    </form>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card p-4">
                    <h5>Your Documents</h5>
                    <table class="table table-hover mt-3">
                        <thead class="table-light">
                            <tr><th>File Name</th><th>Action</th></tr>
                        </thead>
                        <tbody>
                            <?php if(empty($documents)): ?>
                                <tr><td colspan="2" class="text-center">No documents uploaded yet.</td></tr>
                            <?php else: ?>
                                <?php foreach ($documents as $doc): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($doc['document_name']); ?></td>
                                    <td><a href="<?php echo $doc['document_path']; ?>" class="btn btn-sm btn-outline-primary" target="_blank">Open File</a></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="bootstrap-5.3.3-dist/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>