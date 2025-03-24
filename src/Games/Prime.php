<?php

namespace Brain\Games\Prime;

use function BrainGames\Engine\playGame;
use function cli\line;

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

function startPrime()
{
    $config = [
        'answer'       => 'Answer "yes" if given number is prime. Otherwise answer "no".',
        'questionFunc' => function () {

            $numberQuestion = rand(1, 99);
            $resultQuestion = isPrime($numberQuestion);
            return [
                'question'  => $numberQuestion,
                'resultOk'  => $resultQuestion ? 'yes' : 'no',
                'resultBad' => $resultQuestion ? 'no' : 'yes'
            ];
        },
        'validate'     => function ($answer = '') {
            if ($answer !== 'yes' && $answer !== 'no') {
                line(";'$answer' is wrong answer ;(.");
            }
        }
    ];
    playGame($config);
}
