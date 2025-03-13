<?php

namespace BrainGames\Utils;

/***
 * Вычисление НОД
 * */
function gcd($a, $b)
{
    while ($b != 0) {
        $temp = $b;
        $b = $a % $b;
        $a = $temp;
    }
    return $a;
}

/***
 * Прогрессия
 * */
function getProgression($length, $start, $difference)
{
    $progression = [];
    for ($i = 0; $i < $length; $i++) {
        $progression[] = $start + $i * $difference;
    }
    return $progression;
}
