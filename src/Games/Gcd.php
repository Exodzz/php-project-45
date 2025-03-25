<?php

namespace Brain\Games\Gcd;

use function BrainGames\Engine\playGame;
use function cli\line;

function gcd(int $a, int $b)
{
    while ($b != 0) {
        $temp = $b;
        $b = $a % $b;
        $a = $temp;
    }
    return $a;
}

function startGcd(): void
{
    $config = [
        'description'       => 'Find the greatest common divisor of given numbers.',
        'questionFunc' => function () {
            $numberQuestion1 = rand(23, 99);
            $numberQuestion2 = rand(10, 99);
            $resultQuestion = gcd($numberQuestion1, $numberQuestion2);
            $question = "$numberQuestion1 $numberQuestion2";


            return [
                'question' => $question,
                'resultOk' => $resultQuestion,
            ];
        }
    ];
    playGame($config);
}
