<?php

$arr = [3, 7, 2, 4, 9];

function sum($arr) {
    $total = 0;

    foreach ($arr as $num) {
        $total += $num;
    }

    return $total;
}

function average($arr) {
    if (count($arr) == 0) {
        return 0;
    }
    
    $total = sum($arr);
    return $total / count($arr);
}

echo "Массив: ";
print_r($arr);
echo "Сумма: " . sum($arr) . "\n";
echo "Среднее: " . average($arr) . "\n";