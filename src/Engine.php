<?php

namespace BrainGames\Engine;

use Error;

use function cli\line;
use function cli\prompt;

const COUNT_ALLOW = 3;
/**
 * init
 */
function playGame(string $name, int $answers, array $config): void
{
    try {
        greetings($name);
        answer($config);
        getQuestion($answers, $name, $config);
    } catch (\RuntimeException | Error $e) {
        sendLine($e->getMessage());
    }
}



/**
 * Приветствие
 */
function greetings(string &$name): void
{
    line('Welcome to the Brain Game!');
    $name = prompt('May I have your name?');
    line("Hello, %s!", $name);
}

/**
 * Создание вопроса
 */
function answer(array $config): void
{
    line($config['answer']);
}

/**
 * Запрос вопроса
 */
function getQuestion(int &$answers, string $name, array $config): bool
{
    $configQuestion = $config['questionFunc']();
    $question = $configQuestion['question'];
    $answer = prompt("Question: " . $question);
    sendLine("Your answer: $answer");
    $config['validate']($answer, $configQuestion['resultOk']);
    if ($configQuestion['resultOk'] == $answer) {
        success($answers, $name, $config);
        return false;
    }
    bad($answer, $name, $configQuestion);
    return true;
}



/**
 * Отправка сообщения
 */
function sendLine(string $text = ""): void
{
    line($text);
}

/**
 * Отправка сообщения
 */
function bad(string $answer, string $name, array $configQuestion): void
{
    $message = "'$answer' is wrong answer ;(. Correct answer was '{$configQuestion['resultOk']}'." . PHP_EOL .
        "Let's try again, $name!";
    close($message);
}

function addSuccessAnswer(int &$answers, string $name)
{
    $answers++;
    if ($answers >= COUNT_ALLOW) {
        close("Congratulations, $name!");
    }
}

function success(int &$answers, string $name, array $config): void
{
    line("Correct!");
    addSuccessAnswer($answers, $name);
    getQuestion($answers, $name, $config);
}

function close(string $message = "Error")
{
    throw new \RuntimeException($message);
}
