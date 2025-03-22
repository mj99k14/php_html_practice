<?php
include 'dp.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = trim($_POST['user_id']);

    $stmt = $conn->prepare("SELECT COUNT(*) FROM kmj2_user_table WHERE 사용자아이디 = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    $conn->close();

    echo json_encode(["exists" => $count > 0]);
}
?>

