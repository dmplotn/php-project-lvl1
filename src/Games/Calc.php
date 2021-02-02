<?php

namespace Brain\Games\Games\Calc;

use function Brain\Games\GameEngine\runGameEngine;

const GAME_DESCRIPTION = 'What is the result of the expression?';
const ROUNDS_COUNT = 3;
const MIN_NUMBER_VALUE = 1;
const MAX_NUMBER_VALUE = 100;

function calc($operation, $operand1, $operand2)
{
    switch ($operation) {
        case '+':
            $result = $operand1 + $operand2;
            break;
        case '-':
            $result = $operand1 - $operand2;
            break;
        case '*':
            $result = $operand1 * $operand2;
            break;
        default:
            throw new \Exception("Unknown operation: {$operation}");
    }

    return $result;
}

function isCorrectPlayerAnswer($playerAnswer, $correctAnswer)
{
    return (int) $playerAnswer === $correctAnswer;
}

function getRoundData()
{
    $num1 = rand(MIN_NUMBER_VALUE, MAX_NUMBER_VALUE);
    $num2 = rand(MIN_NUMBER_VALUE, MAX_NUMBER_VALUE);
    $operations = ['+', '-', '*'];
    $operation = $operations[array_rand($operations)];

    $result = calc($operation, $num1, $num2);
    $questionText = "{$num1} {$operation} {$num2}";
    $correctAnswer = $result;
    return [
        'questionText' => $questionText,
        'correctAnswer' => $correctAnswer,
    ];
}

function run()
{
    runGameEngine(
        GAME_DESCRIPTION,
        fn() => getRoundData(),
        ROUNDS_COUNT,
        fn($playerAnswer, $correctAnswer) => isCorrectPlayerAnswer($playerAnswer, $correctAnswer)
    );
}
