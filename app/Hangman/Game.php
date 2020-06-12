<?php

namespace App\Hangman;

use App\Hangman\Helpers\StringHelper;

class Game
{
    const MAX_FAILED_ATTEMPTS = 3;

    protected $secret_word;
    protected $letters_guessed;
    protected $attempts;

    public function __construct(string $secret_word)
    {
        $this->secret_word = $secret_word;
        $this->letters_guessed = [];
        $this->attempts = count(StringHelper::explode_unique($this->secret_word)) + self::MAX_FAILED_ATTEMPTS;
    }

    public function get_remaining_attempts(): int
    {
        return $this->attempts;
    }

    public function has_remaining_attempts(): bool
    {
        return $this->get_remaining_attempts() > 0;
    }

    public function is_word_guessed(): bool
    {
        return $this->secret_word === $this->get_guessed_word();
    }

    public function guess(string $letter): bool
    {
        $this->attempts = $this->attempts - 1;

        $letters = StringHelper::str_split_unicode($this->secret_word);

        if (in_array($letter, $letters)) {
            $this->letters_guessed[] = $letter;
            return true;
        } else {
            return false;
        }
    }

    public function get_guessed_word(): string
    {
        $letters = StringHelper::str_split_unicode($this->secret_word);
        $guessed_word = '';

        foreach ($letters as $letter) {
            if (!in_array($letter, $this->letters_guessed)) {
                $guessed_word .= "_";
            } else {
                $guessed_word .= $letter;
            }
        }

        return $guessed_word;
    }
}
