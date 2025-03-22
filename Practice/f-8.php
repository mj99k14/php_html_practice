<?php
    $tel="010-2777-3333";

    $num_tel=strlen($tel);

    echo "strlen() 함수 사용 :$num_tel<br>";

    $tel1 =substr($tel,0,3);
    $tel2 =substr($tel,4,4);
    $tel3 =substr($tel,9,4);

    echo "substr() 함수사용: $tel1 $tel2 $tel3<br>";

    $phone=explode("-",$tel);

    echo "explode()함수사용: $phone[0] $phone[1] $phone[2] <br>";
    ?>