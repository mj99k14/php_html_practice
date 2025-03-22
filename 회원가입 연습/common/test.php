<?php
session_start();
include 'dp.php';

if(isset($_SESSION["memberNumber"])){
    header("Location:login.html");
    exit();
}
//1️⃣ 로그인 요청이 POST 방식으로 왔는지 확인


?>