<?php

namespace BrainGames\Engine;

use Error;

use function cli\line;
use function cli\prompt;

/**
 * init
 */
function playGame(string $name, int $answers, array $config): void
{
    try {
        validateConfig($config);
        greetings($name);
        answer($config);
        getQuestion($answers, $name, $config);
    } catch (\RuntimeException | Error $e) {
        sendLine($e->getMessage());
    }
}

/**
 * Валидация конфигурации
 */
function validateConfig($config): void
{
    foreach ($config as $key => $value) {
        if (
            !in_array($key, ['answer', 'questionFunc', 'validate']) &&
            !is_callable($config['validate']) &&
            !is_callable($config['questionFunc'])
        ) {
            close('bad config');
        }
    }
}

/**
 * Приветствие
 */
function greetings(&$name): void
{
    line('Welcome to the Brain Game!');
    $name = prompt('May I have your name?');
    line("Hello, %s!", $name);
}

/**
 * Создание вопроса
 */
function answer($config): void
{
    line($config['answer']);
}

/**
 * Запрос вопроса
 */
function getQuestion(&$answers, $name, $config): bool
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
 * Валидация
 */
function validateAnswer(string $answer): void
{
    if (!array_key_exists($answer, VARIANTS)) {
        close("'$answer' is wrong answer ;(.");
    }
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
        "Let's try again, $name";
    close($message);
}

function addSuccessAnswer(int &$answers, string $name)
{
    $answers++;
    if ($answers >= COUNT_ALLOW) {
        close("Congratulations, $name!");
    }
}

function success(&$answers, $name, $config): void
{
    line("Correct!");
    addSuccessAnswer($answers, $name);
    getQuestion($answers, $name, $config);
}

function close(string $message = "Error")
{
    throw new \RuntimeException($message);
}
