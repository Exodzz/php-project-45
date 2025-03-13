<?php

namespace BrainGames\Utils;

/***
 * Вычисление НОД
 * */
function gcd(int $a, int $b)
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
function getProgression(int $length, int $start, int $difference)
{
    $progression = [];
    for ($i = 0; $i < $length; $i++) {
        $progression[] = $start + $i * $difference;
    }
    return $progression;
}

/***
 * Простое ли число?
 * */
function isPrime(int $n)
{
    if ($n < 2) {
        return false;
    }

    if ($n == 2) {
        return true;
    }

    if ($n % 2 == 0) {
        return false;
    }

    $sqrtN = sqrt($n);
    for ($i = 3; $i <= $sqrtN; $i += 2) {
        if ($n % $i == 0) {
            return false;
        }
    }
    return true;
}
