<?php

namespace Brain\Games\GameEngine;

use function cli\line;
use function cli\prompt;

function runGameFlow($gameDescription, $roundsData, $isCorrectPlayerAnswer)
{
    line('Welcome to the Brain Games!');
    $playerName = prompt('May I have your name?');
    line("Hello, {$playerName}!");
    line($gameDescription);

    foreach ($roundsData as ['questionText' => $questionText, 'correctAnswer' => $correctAnswer]) {
        line("Question: {$questionText}");
        $playerAnswer = prompt('Your answer');

        if (!$isCorrectPlayerAnswer($playerAnswer, $correctAnswer)) {
            line("'{$playerAnswer}' is wrong answer ;(. Correct answer was '{$correctAnswer}'.");
            line("Let's try again, {$playerName}!");
            return;
        }
        line('Correct!');
    }

    line("Congratulations, {$playerName}!");
}

function getRoundsData($getRoundData, $roundsCount)
{
    return array_map($getRoundData, array_fill(0, 3, null));
}

function runGameEngine($gameDescription, $getRoundData, $roundsCount, $isCorrectPlayerAnswer)
{
    $roundsData = getRoundsData($getRoundData, $roundsCount);
    runGameFlow($gameDescription, $roundsData, $isCorrectPlayerAnswer);
}
