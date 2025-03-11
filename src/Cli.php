<?php

namespace BrainGames;

use Bitrix\Location\Exception\RuntimeException;
use function cli\line;
use function cli\prompt;

class Cli
{
    const COUNT_ALLOW = 3;
    const VARIANTS = [
        'yes' => true,
        'no'  => false
    ];
    private array $answers = [];
    private string $name = 'Member';

    /**
     * init
     */
    public function init(): void
    {
        try {
            $this->greetings();
            $this->answer();
            $this->getQuestion();
        } catch (\RuntimeException $e) {
            $this->sendLine($e->getMessage());
        }
    }

    /**
     * Приветствие
     */
    public function greetings(): void
    {
        line('Welcome to the Brain Game!');
        $this->name = prompt('May I have your name?');
        line("Hello, %s!", $this->name);
    }

    /**
     * Создание вопроса
     */
    public function answer(): void
    {
        line('Answer "yes" if the number is even, otherwise answer "no".');
    }

    /**
     * Запрос вопроса
     */
    public function getQuestion(): bool
    {
        $numberQuestion = rand(1, 99);
        $resultQuestion = $numberQuestion % 2 === 0;
        $answer = prompt("Question: " . $numberQuestion);
        $this->sendLine("Your answer: $answer");
        $this->validateAnswer($answer);
        if ($resultQuestion === self::VARIANTS[$answer]) {
            $this->success();
            return false;
        }
        $this->bad($answer);
        return true;
    }

    /**
     * Валидация
     */
    public function validateAnswer($answer): void
    {
        if (!array_key_exists($answer, self::VARIANTS)) {
            $this->close("'$answer' is wrong answer ;(.");
        }
    }

    /**
     * Отправка сообщения
     */
    public function sendLine($text = ""): void
    {
        line($text);
    }

    /**
     * Отправка сообщения
     */
    public function bad($answer): void
    {
        $answerCorrect = $answer !== 'yes' ? 'yes' : 'no';
        $message = "'{$answer}' is wrong answer ;(. Correct answer was '{$answerCorrect}'." . PHP_EOL .
            "Let's try again, $this->name";
//        $this->sendLine($message);
        $this->close($message);
    }

    public function addSuccessAnswer(string $answer,int $question)
    {
        $this->answers[] = [
            $answer=>$question
        ];
        if(count($this->answers)>=self::COUNT_ALLOW){
            $this->close("Congratulations, {$this->name}!");
        }
    }

    public function checkValidateAnswer()
    {

    }

    public function success(): void
    {
        line("Correct!");
        $this->getQuestion();
    }

    public function close(string $message = "Error"): RuntimeException
    {
        throw new \RuntimeException($message);
    }
}
