<?php

namespace BrainGames\Engine;

use Error;

use function cli\line;
use function cli\prompt;

const COUNT_ALLOW = 3;
function playGame($config): void
{
    $answers = 0;
    $name = '';

    try {
        line('Welcome to the Brain Game!');
        $name = prompt('May I have your name?');
        line("Hello, %s!", $name);

        while ($answers < COUNT_ALLOW) {
            $configQuestion = $config['questionFunc']();
            $question = $configQuestion['question'];
            $answer = prompt("Question: " . $question);
            line("Your answer: $answer");

            $config['validate']($answer, $configQuestion['resultOk']);

            line("Correct!");
            $answers++;

            if ($answers >= COUNT_ALLOW) {
                throw new \RuntimeException("Congratulations, $name!");
            }
        }
    } catch (\RuntimeException | Error $e) {
        line($e->getMessage());
    }
}
