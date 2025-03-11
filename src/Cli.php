<?php

namespace BrainGames;

use function cli\line;
use function cli\prompt;

class Cli
{
    public function init()
    {

        $this->greetings();
    }


    public function greetings()
    {
        line('Welcome to the Brain Game!');
        $name = prompt('May I have your name?');
        line("Hello, %s!", $name);
    }
}
