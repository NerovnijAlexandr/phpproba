<?php

// 7
$path = 'D:\WebServers\home\testsite\www\myfile.txt';
$extension = mb_substr($path, mb_strrpos($path, '.') + 1);
echo $extension.'<br>';

// 8
$date1 = '02-03-2020';
$date2 = '01-03-2020';
$delta = abs(strtotime($date1) - strtotime($date2))/(60*60*24);
echo $delta.'<br>';

// 9
$arr = [26, 17, 136, 12, 79, 15];
echo array_sum(
        array_map(function($item) { return pow($item, 2);},
                    $arr)
    ).'<br>';
$sum = 0;
foreach ($arr as $item) {
    $sum += pow($item, 2);
}
echo $sum.'<br>';

// 10
$sum = array_sum(range(1,112, 3));
echo $sum.'<br>';