<?php
session_start();  // ← 세미콜론 추가!

include 'dp.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $writer = $_SESSION['name']; // 로그인한 사용자 이름 사용

    $stmt = $conn->prepare("INSERT INTO kmj2_board (title, content, writer, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sss", $title, $content, $writer);

    if ($stmt->execute()) {
        echo "<script>alert('글이 작성되었습니다.'); location.href='board.php';</script>";
    } else {
        echo "<script>alert('글 작성에 실패했습니다. 다시 시도해주세요.'); location.href='write.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
