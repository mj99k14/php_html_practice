<?php
session_start();
include 'dp.php';

if (!isset($_SESSION['memberNumber'])) {
    header("Location: login.php");
    exit();
}

// 🔥 GET 요청으로 게시글 ID 가져오기
if (!isset($_GET['id'])) {
    echo "잘못된 접근입니다.";
    exit();
}

$post_id = intval($_GET['id']);

// 🚀 게시글 정보 가져오기
$sql = "SELECT title, content FROM kmj2_board WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$stmt->bind_result($title, $content);

if (!$stmt->fetch()) {
    echo "게시글을 찾을 수 없습니다.";
    exit();
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 수정</title>
</head>
<body>

<h2>게시글 수정</h2>

<form action="edit_process.php" method="post">
    <input type="hidden" name="id" value="<?= $post_id ?>">
    <label>제목:</label>
    <input type="text" name="title" value="<?= htmlspecialchars($title) ?>"><br>
    <label>내용:</label>
    <textarea name="content"><?= htmlspecialchars($content) ?></textarea><br>
    <button type="submit">수정 완료</button>
</form>

<a href="board.php"><button>목록으로</button></a>

</body>
</html>
