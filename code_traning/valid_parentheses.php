<?php

class Solution {

    /**
     * @param String $s
     * @return Boolean
     */
    function isValid($s) {
        for ($i = 0; $i < strlen($s) - 1; $i++) {
            if (
                ($s[$i] === '(' && $s[$i + 1] === ')') ||
                ($s[$i] === '{' && $s[$i + 1] === '}') ||
                ($s[$i] === '[' && $s[$i + 1] === ']')
            ) {
                $s = substr_replace($s, '', $i, 2);
                $i -= 2;
            }
        }
        return empty($s);
    }
}

echo (new Solution())->isValid('()') ? 'true' : 'false';
echo "\n";