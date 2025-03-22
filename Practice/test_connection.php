<?php
// 데이터베이스 연결 정보
$servername = "localhost";  // 서버 이름
$username = "root";         // 사용자 이름
$password = "";             // 기본 root 계정은 비밀번호 없음
$dbname = "sample";         // 데이터베이스 이름 (사용자가 생성한 데이터베이스로 변경)

// MySQL 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
