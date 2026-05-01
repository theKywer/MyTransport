<?php

$arr = [5, 2, 9, 1, 7];

for ($i = 0; $i < count($arr); $i++) {
    for ($j = 0; $j < count($arr) - 1; $j++) {
        if ($arr[$j] > $arr[$j + 1]) {
            $temp = $arr[$j];
            $arr[$j] = $arr[$j + 1];
            $arr[$j + 1] = $temp;
        }
    }
}

print_r($arr);