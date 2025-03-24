<?php

namespace Brain\Games\Gcd;

use function BrainGames\Engine\close;
use function BrainGames\Engine\playGame;

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
    $answersCount = 0;
    $config = [
        'answer'       => 'Find the greatest common divisor of given numbers.',
        'questionFunc' => function () {
            $numberQuestion1 = rand(23, 99);
            $numberQuestion2 = rand(10, 99);
            $resultQuestion = gcd($numberQuestion1, $numberQuestion2);
            $question = "$numberQuestion1 $numberQuestion2";


            return [
                'question' => $question,
                'resultOk' => $resultQuestion,
            ];
        },
        'validate'     => function ($answer, $resultQuestion) {
            if (!is_int($resultQuestion)) {
                close(";'$answer' is wrong answer ;(.");
            }
        }
    ];
    playGame($answersCount, $config);
}
