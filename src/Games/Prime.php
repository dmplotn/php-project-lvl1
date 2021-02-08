<?php

namespace Brain\Games\Games\Prime;

use function Brain\Games\GameEngine\runGameEngine;

const GAME_DESCRIPTION = 'Answer "yes" if given number is prime. Otherwise answer "no".';
const ROUNDS_COUNT = 3;
const MIN_NUMBER_VALUE = 1;
const MAX_NUMBER_VALUE = 100;

function isPrime(int $num): bool
{
    if ($num < 2) {
        return false;
    }

    for ($i = 2; $i <= $num / 2; $i += 1) {
        if ($num % $i === 0) {
            return false;
        }
    }

    return true;
}

function isCorrectPlayerAnswer(string $playerAnswer, string $correctAnswer): bool
{
    return $playerAnswer === $correctAnswer;
}

function getRoundData(): array
{
    $num = rand(MIN_NUMBER_VALUE, MAX_NUMBER_VALUE);

    $questionText = $num;
    $correctAnswer = isPrime($num) ? 'yes' : 'no';
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
