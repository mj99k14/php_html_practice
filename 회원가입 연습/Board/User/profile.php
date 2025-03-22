<?php
session_start();  // 

header('Content-Type: application/json'); // JSON 응답 설정

// 🚀 세션에서 로그인 상태 확인
if (!isset($_SESSION['memberNumber'])) { 
    echo json_encode(["error" => "로그인이 필요합니다."]);
    exit();
}

include 'dp.php';

// 🚀 세션에서 회원번호 가져오기
$memberNumber = $_SESSION['memberNumber'];

// 🚀 사용자 정보 가져오기
$stmt = $conn->prepare("SELECT 이름, 나이, 성별, 키 FROM kmj2_user_table WHERE 회원번호 = ?");
if (!$stmt) {
    echo json_encode(["error" => "SQL 준비 실패: " . $conn->error]);
    exit();
}

$stmt->bind_param("i", $memberNumber);

if (!$stmt->execute()) {
    echo json_encode(["error" => "데이터 조회 실패: " . $stmt->error]); // 🚀 오류 메시지 출력
    $stmt->close();
    $conn->close();
    exit();
}

$stmt->bind_result($name, $age, $gender, $height);

if (!$stmt->fetch()) {
    echo json_encode(["error" => "회원 정보를 찾을 수 없습니다."]);
    $stmt->close();
    $conn->close();
    exit();
}

// 🚀 정상적으로 데이터를 가져왔을 때 JSON으로 응답
echo json_encode([
    "name" => $name ?? "정보 없음",
    "age" => $age ?? "정보 없음",
    "gender" => $gender ?? "정보 없음",
    "height" => $height ?? "정보 없음"
]);

$stmt->close();
$conn->close();
exit();
?>
