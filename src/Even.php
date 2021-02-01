<?php

namespace Brain\Games\Even;

use function cli\line;
use function cli\prompt;

const ROUNDS_COUNT = 3;
const MIN_VALUE = 1;
const MAX_VALUE = 100;

function isEven($num)
{
    return $num % 2 === 0;
}

function run()
{
    line('Welcome to the Brain Games!');
    $playerName = prompt('May I have your name?');
    line("Hello, {$playerName}!");
    line('Answer "yes" if the number is even, otherwise answer "no".');

    for ($i = 0; $i < ROUNDS_COUNT; $i += 1) {
        $num = rand(MIN_VALUE, MAX_VALUE);
        $correctAnswer = isEven($num) ? 'yes' : 'no';
        line("Question: {$num}");
        $playerAnswer = prompt('Your answer');

        if ($playerAnswer !== $correctAnswer) {
            line("'{$playerAnswer}' is wrong answer ;(. Correct answer was '{$correctAnswer}'.");
            line("Let's try again, {$playerName}!");
            return;
        }

        line('Correct!');
    }

    line("Congratulations, {$playerName}!");
}
