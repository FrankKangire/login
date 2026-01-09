<?php
session_start();
include "connection.php";
if(!isset($_SESSION["user_id"])){ header("Location: login.php"); exit(); }

$uid = $_SESSION['user_id'];
// Fetch results for this user, newest first
$res = mysqli_query($conn, "SELECT * FROM permanent_results WHERE user_id = '$uid' ORDER BY game_date DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Result History</title>
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <style>
        body { background: #121212; color: white; }
        .table-dark { background: #1e1e1e; }
        .status-icon { font-size: 1.2rem; }
    </style>
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container mt-5">
        <h2 class="mb-4 text-success">My Answer History</h2>
        <div class="card bg-dark text-white p-3 shadow">
            <table class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Question</th>
                        <th>Your Answer</th>
                        <th>Correct Answer</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($res)): ?>
                    <tr>
                        <td class="small text-muted"><?php echo $row['game_date']; ?></td>
                        <td><?php echo htmlspecialchars($row['question_text']); ?></td>
                        <td><?php echo htmlspecialchars($row['user_answer']); ?></td>
                        <td class="text-info"><?php echo htmlspecialchars($row['correct_answer']); ?></td>
                        <td class="text-center">
                            <?php echo $row['is_correct'] ? '<span class="text-success">✅</span>' : '<span class="text-danger">❌</span>'; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>