<?php
    // 1. MySQL 연결
    $host = 'localhost';
    $user = 'gsc'; // MariaDB 사용자
    $password = '1212'; // MariaDB 비밀번호
    $dbname = '회원관리';

    $conn = new mysqli($host, $user, $password, $dbname);

   
    if($conn->connect_error){
        die("연결에 실패했습니다. : " . $conn->connect_error);
    }

    // 2. 로그인 처리
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $회원번호 = $_POST['회원번호'];

    // 학번 확인
    $stmt = $conn->prepare("SELECT 이름 FROM 회원 WHERE 회원번호 = ?");
    $stmt->bind_param("i", $회원번호);
    $stmt->execute();
    $stmt->bind_result($이름);
    if ($stmt->fetch()) {
        echo "로그인 성공! 환영합니다, $이름.";
    } else {
        echo "회원번호가 유효하지 않습니다.";
    }
    $stmt->close();

}
$conn->close();

?>
