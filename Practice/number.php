<?php
    if($_SERVER['REQUEST_METHOD'] ==='POST') {

        $name = $_POST['name'];

        echo "post로 받은 이름: ".htmlspecialchars($name);
    }else{

        echo"이 페이지는 post요청만 처리합니다.";
    }

?>