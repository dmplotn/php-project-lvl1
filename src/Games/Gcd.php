<?php

namespace Brain\Games\Games\Gcd;

use function Brain\Games\GameEngine\runGameEngine;

const GAME_DESCRIPTION = 'Find the greatest common divisor of given numbers.';
const ROUNDS_COUNT = 3;
const MIN_NUMBER_VALUE = 1;
const MAX_NUMBER_VALUE = 100;

function getGcd(int $num1, int $num2): int
{
    return $num2 === 0 ? $num1 : getGcd($num2, $num1 % $num2);
}

function isCorrectPlayerAnswer(string $playerAnswer, int $correctAnswer): bool
{
    return (int) $playerAnswer === $correctAnswer;
}

function getRoundData(): array
{
    $num1 = rand(MIN_NUMBER_VALUE, MAX_NUMBER_VALUE);
    $num2 = rand(MIN_NUMBER_VALUE, MAX_NUMBER_VALUE);

    $gcd = getGcd($num1, $num2);
    $questionText = "{$num1} {$num2}";
    $correctAnswer = $gcd;
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
