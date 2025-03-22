<?php
session_start();
include 'dp.php';

// 🔥 GET 요청으로 게시글 ID 가져오기
if (!isset($_GET['id'])) {
    echo "잘못된 접근입니다.";
    exit();
}

$post_id = intval($_GET['id']);

// 🚀 게시글 정보 가져오기
$sql = "SELECT title, writer, content, created_at FROM kmj2_board WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$stmt->bind_result($title, $writer, $content, $created_at);

if (!$stmt->fetch()) {
    echo "게시글을 찾을 수 없습니다.";
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?> - 게시글 보기</title>
</head>
<body>

<h2><?= htmlspecialchars($title) ?></h2>
<p>작성자: <?= htmlspecialchars($writer) ?></p>
<p>작성일: <?= htmlspecialchars($created_at) ?></p>
<hr>
<p><?= nl2br(htmlspecialchars($content)) ?></p>
<hr>
<a href="board.php"><button>목록으로</button></a>

</body>
</html>
