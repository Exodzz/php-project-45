<?php

namespace Brain\Games\Even;

use function BrainGames\Engine\close;
use function BrainGames\Engine\playGame;

function startEven(): void
{

    $answersCount = 0;
    $config = [
        'answer'       => 'Answer "yes" if the number is even, otherwise answer "no".',
        'questionFunc' => function () {
            $numberQuestion = rand(1, 99);
            $resultQuestion = $numberQuestion % 2 === 0;
            return [
                'question'  => $numberQuestion,
                'resultOk'  => $resultQuestion ? 'yes' : 'no',
                'resultBad' => $resultQuestion ? 'no' : 'yes'
            ];
        },
        'validate'     => function ($answer) {
            if ($answer !== 'yes' && $answer !== 'no') {
                close("'$answer' is wrong answer ;(.");
            }
        }
    ];
    playGame($answersCount, $config);
}
