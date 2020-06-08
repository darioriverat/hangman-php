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
$letters_guessed = [];

do {
    echo "Please guess a letter: " . PHP_EOL;
    $guess = trim(fgets(STDIN));

    $letters = str_split_unicode($secret_word);

    if (in_array($guess, $letters)) {
        $letters_guessed[] = $guess;
        echo 'Good guess: ' . get_guessed_word($secret_word, $letters_guessed) . PHP_EOL;
    } else {
        echo 'Oops!, that letter is not in the word: ' . get_guessed_word($secret_word, $letters_guessed) . PHP_EOL;
    }

    echo 'You have ' . (MAX_ATTEMPTS - $attempts - 1) . ' guesses left' . PHP_EOL;

    $attempts++;
} while ($attempts < MAX_ATTEMPTS && !is_word_guessed($secret_word, $letters_guessed));

if (is_word_guessed($secret_word, $letters_guessed)) {
    echo 'Congratulations!, you guessed the word' . PHP_EOL;
} else {
    echo 'Game over, the word was ' . $secret_word . PHP_EOL;
}

function str_split_unicode($str) {
    return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
}

function get_guessed_word($secret_word, $letters_guessed) {
    $letters = str_split_unicode($secret_word);
    $guessed_word = '';

    foreach ($letters as $letter) {
        if (!in_array($letter, $letters_guessed)) {
            $guessed_word .= "_";
        } else {
            $guessed_word .= $letter;
        }
    }

    return $guessed_word;
}

function is_word_guessed($secret_word, $letters_guessed) {
    return $secret_word == get_guessed_word($secret_word, $letters_guessed);
}