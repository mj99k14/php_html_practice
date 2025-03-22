<?php
session_start();
include 'dp.php';

// 🚀 JSON 응답 헤더 설정
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["error" => "잘못된 요청입니다."]);
    exit();
}

// 🔥 POST 데이터 가져오기
$data = json_decode(file_get_contents("php://input"), true);
$postId = intval($data['id']);

// 🚀 게시글 삭제 실행
$stmt = $conn->prepare("DELETE FROM kmj2_board WHERE id = ?");
$stmt->bind_param("i", $postId);
if ($stmt->execute()) {
    // 🔥 순번 재정렬
    $conn->query("SET @new_rank = 0;");
    $conn->query("UPDATE kmj2_board SET 순번 = (@new_rank := @new_rank + 1) ORDER BY id ASC;");
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => "삭제 실패: " . $conn->error]);
}
$stmt->close();
$conn->close();
?>
