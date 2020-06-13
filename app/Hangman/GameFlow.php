<?php

namespace App\Hangman;

use App\Hangman\Helpers\StringHelper;
use Illuminate\Support\Facades\Cache;

class GameFlow
{
    /**
     * @var Game
     */
    protected $game;

    /**
     * @var string
     */
    protected $id;

    public function __construct(Game $game, string $id)
    {
        $this->game = $game;
        $this->id = $id;
    }

    public function get_game(): Game
    {
        return $this->game;
    }

    public static function word_tag(string $id): string
    {
        return 'secret_word_' . $id;
    }

    public static function attempts_tag(string $id): string
    {
        return 'attempts_' . $id;
    }

    public static function letters_guessed_tag(string $id): string
    {
        return 'letters_guessed_' . $id;
    }

    public static function createGame(): string
    {
        $id = uniqid() . time();
        $secret_word = self::generateWord($id);
        $game = new Game($secret_word);

        self::store_attempts($id, $game->get_remaining_attempts());
        self::store_letters($id, $game->get_letters_guessed());

        return $id;
    }

    public static function fromId(string $id): self
    {
        $secret_word = Cache::get(self::word_tag($id));
        $attempts = Cache::get(self::attempts_tag($id));
        $letters_guessed = Cache::get(self::letters_guessed_tag($id), '');

        $game = new Game($secret_word);
        $game->set_attempts($attempts);
        $game->set_letters_guessed(StringHelper::str_split_unicode($letters_guessed));

        return new self($game, $id);
    }

    public function update(Game $game): void
    {
        $this->store_attempts($this->id, $game->get_remaining_attempts());
        $this->store_letters($this->id, $game->get_letters_guessed());
    }

    private static function generateWord(string $id): string
    {
        if (!Cache::has(self::word_tag($id))) {
            $secret_word = 'Good';
            Cache::put(self::word_tag($id), $secret_word);
        } else {
            $secret_word = Cache::get(self::word_tag($id));
        }

        return $secret_word;
    }

    public static function store_attempts(string $id, int $attempts)
    {
        if (Cache::has(self::attempts_tag($id))) {
            Cache::forget(self::attempts_tag($id));
        }

        Cache::put(self::attempts_tag($id), $attempts);
    }

    public static function store_letters(string $id, array $letters)
    {
        $letters = implode('', $letters);

        if (Cache::has(self::letters_guessed_tag($id))) {
            Cache::forget(self::letters_guessed_tag($id));
        }

        Cache::put(self::letters_guessed_tag($id), $letters);
    }
}
