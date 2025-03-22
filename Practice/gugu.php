<?php
$string ="";
$string.="<table border='1'>";
    for($i =2; $i<=10; $i++){
        $string.="<tr>";
        for($j=1; $j<=10; $j++){
            $string.= "<td>". $i ."*". $j."=".$i * $j."</td>";
        }

       $string.="</tr>";
    }

    $string.="</table>";

    echo $string;
?>