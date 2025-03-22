<?php
$height = 170;
$weight = 40;
$s = ($height - 100) * 0.9;

echo("키:$height<br>");
echo("몸무게:$weight<br>");

if($weight >$s)
    echo("다이어트 필요");
else
    echo("다이어트 불필요")
?>