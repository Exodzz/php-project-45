<?php

namespace BrainGames\Engine;

use Error;

use function cli\line;
use function cli\prompt;

const COUNT_ROUND = 3;
function playGame(array $config): void
{
    $answers = 0;
    $name = '';

    try {
        line('Welcome to the Brain Game!');
        $name = prompt('May I have your name?');
        line("Hello, %s!", $name);
        line($config['description']);

        while ($answers < COUNT_ROUND) {
            $configQuestion = $config['questionFunc']();
            $question = $configQuestion['question'];
            $answer = prompt("Question: " . $question);
            line("Your answer: $answer");

            if ($configQuestion['resultOk'] != $answer) {
                $message = "'$answer' is wrong answer ;(. Correct answer was '{$configQuestion['resultOk']}'.";
                throw new \RuntimeException($message);
            }
            line("Correct!");
            $answers++;
        }
        line("Congratulations, $name!");
    } catch (\RuntimeException | Error $e) {
        line($e->getMessage());
        line("Let's try again, $name!");
    }
}
