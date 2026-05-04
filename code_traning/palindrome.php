<?php 
declare(strict_types=1);

class Solution
{
    public static function isPalindrome(int $x): bool
    {
        if ($x < 0) {
            return false;
        }

        $original = $x;
        $reversed = 0;

        while ($x > 0) {
            $reversed = $reversed * 10 + $x % 10;
            $x = intdiv($x, 10);
        }

        return $original === $reversed;
    }
}

$values = [121, -121, 10, 12321, 0];

foreach ($values as $value) {
    $result = Solution::isPalindrome($value);
    echo $value . ' => ' . ($result ? 'Палиндром' : 'Не палиндром') . PHP_EOL;
}
