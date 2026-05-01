<?php

$arr = [1, 3, 14, 7, 6];

$max = $arr[0];
$second = null;

foreach ($arr as $value) {
    if ($value > $max) {
        $second = $max;
        $max = $value;
    } elseif ($value > $second && $value < $max) {
        $second = $value;
    }
}
echo "Максимальное значение: " . $max . "\n";
echo "Второе максимальное значение: " . $second . "\n";