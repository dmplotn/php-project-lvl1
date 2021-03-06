<?php

namespace Brain\Games\Games\Even;

use function Brain\Games\GameEngine\runGameEngine;

const GAME_DESCRIPTION = 'Answer "yes" if the number is even, otherwise answer "no".';
const ROUNDS_COUNT = 3;
const MIN_NUMBER_VALUE = 1;
const MAX_NUMBER_VALUE = 100;

function isEven(int $num): bool
{
    return $num % 2 === 0;
}

function isCorrectPlayerAnswer(string $playerAnswer, string $correctAnswer): bool
{
    return $playerAnswer === $correctAnswer;
}

function getRoundData(): array
{
    $num = rand(MIN_NUMBER_VALUE, MAX_NUMBER_VALUE);
    $questionText = $num;
    $correctAnswer = isEven($num) ? 'yes' : 'no';
    return [
        'questionText' => $questionText,
        'correctAnswer' => $correctAnswer,
    ];
}

function run(): void
{
    runGameEngine(
        GAME_DESCRIPTION,
        fn() => getRoundData(),
        ROUNDS_COUNT,
        fn($playerAnswer, $correctAnswer) => isCorrectPlayerAnswer($playerAnswer, $correctAnswer)
    );
}
