<?php

namespace Brain\Games\Games\Progression;

use function Brain\Games\GameEngine\runGameEngine;

const GAME_DESCRIPTION = 'What number is missing in the progression?';
const ROUNDS_COUNT = 3;
const PROGRESSION_LENGTH = 10;
const MIN_START_VALUE = 1;
const MAX_START_VALUE = 100;
const MIN_STEP_VALUE = 2;
const MAX_STEP_VALUE = 10;

function getProgression($start, $step, $length)
{
    $progression = [];

    for ($i = 0; $i < $length; $i += 1) {
        $progression[] = $start + $i * $step;
    }

    return $progression;
}

function getProgressionWithSecretAsStr($progression, $secretIndex)
{
    if ($secretIndex < 0 || $secretIndex > count($progression) - 1) {
        throw new \Exception("Unknown index: {$secretIndex}");
    }

    $result = [];

    foreach ($progression as $index => $value) {
        $result[] = $index === $secretIndex ? '..' : $value;
    }

    return implode(' ', $result);
}

function isCorrectPlayerAnswer($playerAnswer, $correctAnswer)
{
    return (int) $playerAnswer === $correctAnswer;
}

function getRoundData()
{
    $start = rand(MIN_START_VALUE, MAX_START_VALUE);
    $step = rand(MIN_STEP_VALUE, MAX_STEP_VALUE);
    $progression = getProgression($start, $step, PROGRESSION_LENGTH);
    $secretIndex = rand(0, PROGRESSION_LENGTH - 1);

    $questionText = getProgressionWithSecretAsStr($progression, $secretIndex);
    $correctAnswer = $progression[$secretIndex];
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
