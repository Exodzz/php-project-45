<?php

namespace Brain\Games\Progression;

use function BrainGames\Engine\close;
use function BrainGames\Engine\playGame;
use function BrainGames\Utils\getProgression;

function startProgression(): void
{
    $name = 'Mr';
    $answersCount = 0;
    $config = [
        'answer'       => 'What number is missing in the progression?',
        'questionFunc' => function () {
            $length = rand(5, 10);
            $progression = getProgression($length, rand(1, 20), rand(1, 5));

            $hiddenIndex = rand(0, $length - 1);
            $resultQuestion = $progression[$hiddenIndex];
            $progression[$hiddenIndex] = '..';
            $question = implode(' ', $progression);

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
    playGame($name, $answersCount, $config);
}
