<?php

namespace Brain\Games\Even;

use function BrainGames\Engine\playGame;
use function cli\line;

function startEven(): void
{

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
        }
    ];
    playGame($config);
}
