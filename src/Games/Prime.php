<?php

namespace Brain\Games\Prime;

use function BrainGames\Engine\close;
use function BrainGames\Engine\playGame;
use function BrainGames\Utils\isPrime;

function startPrime()
{
    $answersCount = 0;
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
                close(";'$answer' is wrong answer ;(.");
            }
        }
    ];
    playGame($answersCount, $config);
}
