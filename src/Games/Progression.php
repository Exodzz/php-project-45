<?php

namespace Brain\Games\Progression;

use function BrainGames\Engine\playGame;
use function cli\line;

function getProgression(int $length, int $start, int $difference): array
{
    $progression = [];
    for ($i = 0; $i < $length; $i++) {
        $progression[] = $start + $i * $difference;
    }
    return $progression;
}

function startProgression(): void
{
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
    ];
    playGame($config);
}
