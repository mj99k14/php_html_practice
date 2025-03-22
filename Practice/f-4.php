<?php
    for($i=0; $i<10;$i++)
    $a[$i]=$i+1;

    for($i=9;$i>=0;$i--)
    $b[9-$i]=$i+1;

    for($i=0;$i<10;$i++)
    $c[$i]=$a[$i]*$b[$i];

    for($i=0;$i<10;$i++)
    echo"$a[$i] * $b[$i] =$c[$i]<br>";
?>
