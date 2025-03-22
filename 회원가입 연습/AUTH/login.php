<?php
// 세션 시작
session_start();

// MySQL 연결
include 'dp.php'; 

// 로그인 요청 처리
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 회원번호 입력 여부 확인
    if (!isset($_POST['memberNumber']) || empty($_POST['memberNumber'])) {
        echo "<script>alert('회원번호를 입력하세요.'); location.href='login.html';</script>";
        exit();
    }

    // 사용자가 입력한 회원번호 가져오기
    $memberNumber = $_POST['memberNumber'];

    // 회원번호가 숫자인지 확인 (잘못된 if 문 수정)
    if (!ctype_digit($memberNumber)) { 
        echo "<script>alert('회원번호는 숫자로만 입력하세요.'); location.href='login.html';</script>";
        exit();
    }

    // MySQL에서 회원번호 조회
    $stmt = $conn->prepare("SELECT 이름 FROM kmj2_user_table WHERE 회원번호 = ?"); // SQL 준비
    $stmt->bind_param("i", $memberNumber); // SQL 바인딩
    $stmt->execute(); // SQL 실행
    $stmt->bind_result($userName); // 결과 저장

    if ($stmt->fetch()) { // 회원번호가 존재하면 로그인 성공
        session_regenerate_id(true); // 보안 강화를 위해 세션 ID 재생성
        $_SESSION['memberNumber'] = $memberNumber;
        $_SESSION['userName'] = $userName;
        
        // 로그인 성공 후 프로필 페이지로 이동
        header("Location: profile.html");
        exit();
    } else {
        // 로그인 실패 시 알림창 표시 후 로그인 페이지로 이동
        echo "<script>alert('회원번호가 올바르지 않습니다.'); location.href='login.html';</script>";
        exit();
    }

    $stmt->close(); // SQL 문 종료
}

$conn->close(); // MySQL 연결 종료
?>
