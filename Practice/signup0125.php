<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // 1. 폼 데이터 받기
    $usernumber = $_POST['학번']; // 학번
    $username = $_POST['이름'];  // 이름
    $age = $_POST['나이'];      // 나이
    $gender = $_POST['gender']; // 성별
    $tall = $_POST['키'];       // 키

    // 2. 데이터베이스 연결
    $servername = "localhost"; // 데이터베이스 서버 (로컬호스트)
    $db_username = "gsc";     // 데이터베이스 사용자명
    $db_password = "12";         // 데이터베이스 비밀번호
    $dbname = "users"; // 사용할 데이터베이스 이름

    // MySQL 연결
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // 연결 확인
    if ($conn->connect_error) {
        die("데이터베이스 연결 실패: " . $conn->connect_error);
    }

    // 3. 데이터 삽입
    $sql = "INSERT INTO users (usernumber, username, age, gender, tall) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiss", $usernumber, $username, $age, $gender, $tall);

    if ($stmt->execute()) {
        // 4. 성공 메시지 출력
        echo "<h1>회원가입 성공!</h1>";
        echo "<p>학번: $usernumber</p>";
        echo "<p>이름: $username</p>";
        echo "<p>나이: $age</p>";
        echo "<p>성별: " . ($gender === "male" ? "남성" : "여성") . "</p>";
        echo "<p>키: $tall</p>";
    } else {
        echo "회원가입에 실패했습니다: " . $stmt->error;
    }

    // 5. 연결 종료
    $stmt->close();
    $conn->close();
} else {
    echo "잘못된 접근입니다.";
}
?>
