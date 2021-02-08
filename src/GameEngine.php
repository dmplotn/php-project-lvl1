<?php

namespace Brain\Games\GameEngine;

use function cli\line;
use function cli\prompt;

function runGameFlow(
    string $gameDescription,
    array $roundsData,
    callable $isCorrectPlayerAnswer
): void {
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

function getRoundsData(callable $getRoundData, int $roundsCount): array
{
    return array_map($getRoundData, array_fill(0, $roundsCount, null));
}

function runGameEngine(
    string $gameDescription,
    callable $getRoundData,
    int $roundsCount,
    callable $isCorrectPlayerAnswer
): void {
    $roundsData = getRoundsData($getRoundData, $roundsCount);
    runGameFlow($gameDescription, $roundsData, $isCorrectPlayerAnswer);
}
