<?php

namespace Brain\Games\Calc;

use function BrainGames\Engine\close;
use function BrainGames\Engine\playGame;

function startCalc(): void
{
    $answersCount = 0;
    $config = [
        'answer'       => 'What is the result of the expression?',
        'questionFunc' => function () {
            $operators = ['-', '+', '*'];
            $numberQuestion1 = rand(1, 99);
            $numberQuestion2 = rand(1, 99);
            $operator = $operators[rand(0, count($operators) - 1)];
            $question = "$numberQuestion1 {$operator} $numberQuestion2";

            switch ($operator) {
                case '+':
                    $resultQuestion = $numberQuestion1 + $numberQuestion2;
                    break;
                case '-':
                    $resultQuestion = $numberQuestion1 - $numberQuestion2;
                    break;
                case '*':
                    $resultQuestion = $numberQuestion1 * $numberQuestion2;
                    break;
            }

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
