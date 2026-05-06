<?php

$arr = [3, 7, 2, 4, 9];
$target = 9;

$index = -1;

foreach ($arr as $i => $num) {
    if ($num == $target) {
        $index = $i;
        break;
    }
}

if ($index != -1) {
    echo "Индекс: " . $index . "\n";
} else {
    echo "Не найдено" . "\n";
}