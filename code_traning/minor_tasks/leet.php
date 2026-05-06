<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function twoSum($nums, $target) {
        $temp = [];
        foreach ($nums as $key => $value) {
            if ($value >= $target) continue;

            $temp[] = ['key' => $key, 'value' => $value];
        }

        for ($i = 0; $i < count($temp) - 1; $i++) {
            for ($j = $i + 1; $j < count($temp); $j++) {
                if (($temp[$i]['value'] + $temp[$j]['value']) === $target) {
                    return [
                        $temp[$i]['key'],
                        $temp[$j]['key']
                    ];
                }
            }
        }
    }

}

$class = new Solution();
print_r($class->twoSum([2, 7, 11, 15], 9));
print_r($class->twoSum([2, 7, 11, 15, 225, 200, 25], 225));