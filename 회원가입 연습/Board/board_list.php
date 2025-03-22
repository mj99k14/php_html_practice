<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 목록</title>
</head>
<body>

<h2>게시판 목록</h2>

<!-- 🔥 검색 기능 추가 -->
<form id="searchForm">
    <input type="text" id="searchInput" placeholder="제목 검색...">
    <button type="submit">검색</button>
</form>

<table border="1">
    <thead>
        <tr>
            <th>순번</th> <!-- 🔥 순번 추가 -->
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
    fetchBoardData();

    // 🔥 검색 기능 추가
    document.getElementById("searchForm").addEventListener("submit", function(event) {
        event.preventDefault();
        const searchQuery = document.getElementById("searchInput").value;
        fetchBoardData(searchQuery);
    });
});

// 🔥 게시글 데이터를 불러오는 함수 (검색 가능)
function fetchBoardData(search = "") {
    let url = "board_list.php";
    if (search) {
        url += "?search=" + encodeURIComponent(search);
    }

    fetch(url)
        .then(response => response.json())
        .then(posts => {
            const tableBody = document.getElementById("boardTableBody");
            tableBody.innerHTML = "";

            if (posts.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="5">등록된 글이 없습니다</td></tr>`;
                return;
            }

            posts.forEach(post => {
                let writer = post.writer ? post.writer : "익명";

                const row = `
                    <tr id="post-${post.id}">
                        <td>${post.순번}</td> <!-- 🔥 순번 표시 -->
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
}

// 🔥 게시글 삭제 기능 (순번 재정렬)
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
            fetchBoardData(); // 🔥 삭제 후 목록 새로고침
        } else {
            alert("삭제 실패: " + data.error);
        }
    })
    .catch(error => console.error("에러 발생:", error));
}
</script>

</body>
</html>
