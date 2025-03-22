<?php
//세션 시작
session_start();
include 'dp.php';

//로그인 여부확인
if (!isset($_SESSION['memberNumber'])) {
    echo "<script>alert('로그인이 필요합니다'); location.href='login.html';</script>";
    exit();
}

//세션폼 회원번호 가져오기
$memberNumber = $_SESSION['memberNumber'];

//데이터베이스 회원정보가져오기
$stmt = $conn->prepare("SELECT 이름,나이,성별,키 FORM kmj2_user_table WHERE 회원번호 =?");
$stmt->bind_param("i", $memberNumber);
$stmt->execute();
$stmt->bind_result($name, $age, $gender, $height);
$stmt->fetch();
$stmt->close();
$conn->close();
?>


//html
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <title>마이페이지</title>
</head>

<body>
    <h2>마이페이지</h2>
    <p>이름:<?php echo htmlspecialchars($name ?? "정보 없음"); ?></p>
    <p>나이:<?php echo htmlspecialchars($age ?? "정보 없음"); ?></p>
    <p>성별:<?php echo htmlspecialchars($age ?? "정보 없음"); ?></p>
    <p>키:<?php echo htmlspecialchars($height ?? "정보 없음"); ?></p>

    <a href="logout.php"><button>로그아웃</button></a>
</body>

</html>