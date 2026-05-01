<?php

require 'calculator_capilot.php';

$a = readline("Введите первое число: ");
$b = readline("Введите второе число: ");
$operation = readline("Выберите операцию (+, -, *, /, ^, sqrt): ");

if ($operation == "+") {
    echo $a + $b;
} elseif ($operation == "-") {
    echo $a - $b;
} elseif ($operation == "*") {
    echo $a * $b;
} elseif ($operation == "/") {
    if ($b == 0) {
        echo "Деление на ноль невозможно";
    } else {
        echo $a / $b;
    }
} elseif ($operation == "^") {
    echo pow($a, $b);
} elseif ($operation == "sqrt") {
    if ($a < 0) {
        echo "Невозможно извлечь корень из отрицательного числа";
    } else {
        echo sqrt($a);
    }
} else {
    echo "Неизвестная операция";
}