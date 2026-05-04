<?php 

$arr = ['flower', 'flow', 'flight'];

function longestCommonPrefix($strs) {
    if (empty($strs)) {
        return '';
    }

    $prefix = $strs[0];

    for ($i = 1; $i < count($strs); $i++) {
        while (strpos($strs[$i], $prefix) !== 0) {
            $prefix = substr($prefix, 0, -1);
            if (empty($prefix)) {
                return '';
            }
        }
    }

    return $prefix;
}

echo longestCommonPrefix($arr) . PHP_EOL; 