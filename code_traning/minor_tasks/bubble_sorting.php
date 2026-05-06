<?php



// $arr = [5, 2, 9, 1, 7];

$arr = randarr(n: 100000, min:0, max:10000000000);

    
// for ($i = 0; $i < count($arr); $i++) {
//     for ($j = 0; $j < count($arr) - 1; $j++) {
//         if ($arr[$j] > $arr[$j + 1]) {
//             $temp = $arr[$j];
//             $arr[$j] = $arr[$j + 1];
//             $arr[$j + 1] = $temp;
//         }
//     }
// }


function randarr( $n = 1, $min = 0, $max = 100) {
    return array_map(
        function() use( $min, $max) {
            return rand( $min, $max);
        },
        array_pad( [], $n, 0)
    );
}

function bubbleSort(array $a): array
{
  for ($i = count($a) - 1; $i > 0; $i--) {
    for ($j = 0; $j < $i; $j++) {
      if ($a[$j] > $a[$j + 1]) { 
        $temp = $a[$j];
        $a[$j] = $a[$j+1];
        $a[$j+1] = $temp;
      }
    }
  }
  return $a;
}

// sort($arr);
$arr = bubbleSort($arr);
print_r($arr);


// for 

// foreach 

// while
// do 

// do 
// while



