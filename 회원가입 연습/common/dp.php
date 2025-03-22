<?php
// db 연결
$servername = "localhost";
$username = "kmj2";
$password = "12";
$database = "yarimasu";

// 연결
$conn = mysqli_connect($servername, $username, $password, $database);

// 연결 체크
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);  // ← 세미콜론 추가!
}

// 한글 깨짐 방지
$conn->set_charset("utf8mb4");
