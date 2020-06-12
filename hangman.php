<?php

use App\Hangman\Game;

include('vendor/autoload.php');

if ($argc != 2) {
    echo 'Wrong parameters count!' . PHP_EOL;
    exit();
}

// get the first command line parameter
$secret_word = $argv[1];

echo 'Welcome to the hangman game' . PHP_EOL;
echo 'The secret word I\'m thinking of has ' . mb_strlen($secret_word) . ' letters' . PHP_EOL;

$game = new Game($secret_word);

do {
    echo "Please guess a letter: " . PHP_EOL;
    $letter = trim(fgets(STDIN));

    if ($game->guess($letter)) {
        echo 'Good guess: ' . $game->get_guessed_word() . PHP_EOL;
    } else {
        echo 'Oops!, that letter is not in the word: ' . $game->get_guessed_word() . PHP_EOL;
    }

    echo 'You have ' . $game->get_remaining_attempts() . ' guesses left' . PHP_EOL;
} while ($game->has_remaining_attempts() && !$game->is_word_guessed());

if ($game->is_word_guessed()) {
    echo 'Congratulations!, you guessed the word' . PHP_EOL;
} else {
    echo 'Game over, the word was ' . $secret_word . PHP_EOL;
}
