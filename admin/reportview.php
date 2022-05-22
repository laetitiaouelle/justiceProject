<?php


$date = '2019-05-13';
    $hours = 23;
    $min = 59;
    $sec = 59;
	echo "$date<br>"; 
    $date2 =date('Y-m-d H:i:s',strtotime("+$hours hours +$min min +$sec sec", strtotime($date))) . '<br>';
    echo $date2;
?>
