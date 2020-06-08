<?php

if ($argc != 2) {
    echo 'Wrong parameters count';
}

// get the first command line parameter
$secret_word = $argv[1];

echo 'Welcome to the hangman game' . PHP_EOL;
echo 'The secret word I\'m thinking of has ' . mb_strlen($secret_word) . ' letters' . PHP_EOL;

const MAX_ATTEMPTS = 7;

$attempts = 0;

do {
    echo "Please guess a letter: " . PHP_EOL;
    $letter = trim(fgets(STDIN));

    $attempts++;
} while ($attempts < MAX_ATTEMPTS);
