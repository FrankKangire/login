<?php
session_start();
include "connection.php";
$data = json_decode(file_get_contents('php://input'), true);

if(isset($_SESSION['user_id']) && !empty($data)){
    $uid = $_SESSION['user_id'];
    foreach($data as $res){
        $qText = mysqli_real_escape_string($conn, $res['question']);
        $uAns = mysqli_real_escape_string($conn, $res['user_answer']);
        $cAns = mysqli_real_escape_string($conn, $res['correct_answer']);
        $isCor = $res['is_correct'] ? 1 : 0;

        mysqli_query($conn, "INSERT INTO permanent_results (user_id, question_text, user_answer, correct_answer, is_correct) 
                             VALUES ('$uid', '$qText', '$uAns', '$cAns', '$isCor')");
    }
    echo json_encode(["status" => "success"]);
}
?>