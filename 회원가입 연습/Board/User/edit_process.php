<?php
session_start();
include 'dp.php';

// 🚀 로그인 여부 확인
if (!isset($_SESSION['memberNumber'])) {
    header("Location: login.php");
    exit();
}

// 🚀 POST 요청 확인 (🔥 오타 수정: 'REQUESST_METHOD' → 'REQUEST_METHOD')
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postId = intval($_POST['id']);
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    // 🚀 기존 글의 작성자 확인 (🔥 오타 수정: 'FORM' → 'FROM')
    $stmt = $conn->prepare("SELECT writer FROM kmj2_board WHERE id = ?");
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    $stmt->bind_result($writer);
    $stmt->fetch();
    $stmt->close();

    // 🚀 수정 권한 확인
    if ($writer !== $_SESSION['memberNumber']) { // 🔥 세션 key 수정
        echo "<script>alert('수정 권한이 없습니다.'); location.href='board.php';</script>";
        exit();
    }

    // 🚀 게시글 수정 실행
    $stmt = $conn->prepare("UPDATE kmj2_board SET title = ?, content = ? WHERE id = ?");
    $stmt->bind_param("ssi", $title, $content, $postId);

    if ($stmt->execute()) {
        echo "<script>alert('게시글이 수정되었습니다.'); location.href='board.php';</script>";
    } else {
        echo "<script>alert('수정 실패했습니다. 다시 시도해주세요.'); location.href='edit.php?id=" . $postId . "';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
