<form method="post" action="N.php">
    <label for="number">숫자입력: </label>
        <input type="text" name="number" id="number" placehoder="주민등록번호">
        <input type="submit" value="버튼">
</form>

<?php

$number = $_POST["number"];

//$number="990113-2692310";
echo "주민번호를 입력하세요: <br>";
$a = strlen($number);

if($a ===14){
    echo"주민등록번호가 입력되었습니다";
}else{
    echo"재입력해주세요";
}
$x=array(2,3,4,5,6,7,8,9,2,3,4,5);

$part= str_replace("-","",$number);
$sum = 0;
for($i = 0; $i < 12; $i++)

    $sum += $part[$i] * $x[$i];

    echo $sum;

    $nanugi = $sum % 11;
    $last = 11-$nanugi;
    $last = (string)$last;
    $a = 0;
    
    if(strlen($last)>1){ 

        $a = $last[1];
    }else{
        $a = $last;
    }

    

    if((int)$a == (int)$part[11]){

        echo "주민등록번호가 일치합니다";

    }else{

        echo "주주민등록번호가 안맞습니다";
         
    }













?>