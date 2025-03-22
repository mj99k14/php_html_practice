<?php
session_start(); // 세션 시작

// 오류 출력 활성화
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'dp.php'; // MySQL 연결

// 폼에서 전송된 데이터 가져오기
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);  // 이름
    $age = intval($_POST['age']);  // 나이
    $gender = trim($_POST['gender']);  // 성별
    $height = floatval($_POST['height']);  // 키

    // 🚀 1️⃣ 입력값 검증
    if (empty($name) || empty($age) || empty($gender) || empty($height)) {
        echo "<script>alert('모든 항목을 입력하세요.'); location.href='signup.html';</script>";
        exit();
    }

    // 🚀 2️⃣ 성별 값 검증 (MySQL ENUM과 일치하도록 강제)
    $allowed_genders = ['남자', '여자', '기타'];
    if (!in_array($gender, $allowed_genders)) {
        echo "<script>alert('성별은 남자, 여자, 기타 중 하나만 입력 가능합니다.'); location.href='signup.html';</script>";
        exit();
    }

    // 🚀 3️⃣ 회원 정보 데이터베이스에 저장
    $sql = "INSERT INTO kmj2_user_table (`이름`, `나이`, `성별`, `키`) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        die("SQL 준비 실패: " . $conn->error);
    }

    // 🚀 4️⃣ 데이터 바인딩
    $stmt->bind_param("sisd", $name, $age, $gender, $height);

    if ($stmt->execute()) {
        // 🔥 5️⃣ 새로 생성된 회원번호 가져오기
        $newMemberId = $stmt->insert_id;

        // 🚀 6️⃣ 회원번호를 세션에 저장
        $_SESSION['memberNumber'] = $newMemberId;

        // 🔥 7️⃣ 성공 메시지 및 리디렉션
        header("Refresh: 3; url=login.html");
        echo "회원가입 성공! 3초 뒤에 로그인 화면으로 이동합니다.";
        exit();
    } else {
        echo "회원가입 실패: " . $conn->error;
    }

    $stmt->close();
}
$conn->close();
?>