<?php
session_start();

// 오류 출력 활성화
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'dp.php';

if (!isset($_SESSION['memberNumber'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 목록</title>
</head>
<body>

<h2>게시판 목록</h2>

<table border="1">
    <thead>
        <tr>
            <th>번호</th>
            <th>제목</th>
            <th>작성자</th>
            <th>작성일</th>
            <th>관리</th>
        </tr>
    </thead>
    <tbody id="boardTableBody">
        <tr><td colspan="5">데이터를 불러오는 중...</td></tr>
    </tbody>
</table>

<a href="write.html"><button>새 글 작성</button></a>
<a href="profile.html"><button>내 프로필</button></a>
<a href="logout.php"><button>로그아웃</button></a>

<script>
document.addEventListener("DOMContentLoaded", function() {
    fetch("board_list.php") // 🔥 get_posts.php → board_list.php로 변경
        .then(response => response.json())
        .then(posts => {
            const tableBody = document.getElementById("boardTableBody");
            tableBody.innerHTML = ""; // 기존 내용 삭제

            if (posts.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="5">등록된 글이 없습니다</td></tr>`;
                return;
            }

            posts.forEach(post => {
                let writer = post.writer ? post.writer : "익명"; // 작성자가 없으면 '익명'

                const row = `
                    <tr id="post-${post.id}">
                        <td>${post.id}</td>
                        <td><a href="board_view.php?id=${post.id}">${post.title}</a></td>
                        <td>${writer}</td>
                        <td>${post.created_at}</td>
                        <td>
                            <a href="edit.php?id=${post.id}">수정</a>
                            <button onclick="deletePost(${post.id})">삭제</button>
                        </td>
                    </tr>
                `;
                tableBody.innerHTML += row;
            });
        })
        .catch(error => {
            console.error("🚨 데이터 불러오기 실패:", error);
            document.getElementById("boardTableBody").innerHTML = `<tr><td colspan="5">데이터를 불러오지 못했습니다</td></tr>`;
        });
});


function deletePost(postId) {
    if (!confirm("정말 삭제하시겠습니까?")) return;

    fetch("delete.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id: postId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById(`post-${postId}`).remove();
        } else {
            alert("삭제 실패: " + data.error);
        }
    })
    .catch(error => console.error("에러 발생:", error));
}
</script>

</body>
</html>
