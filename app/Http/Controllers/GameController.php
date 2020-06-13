<?php

namespace App\Http\Controllers;

use App\Hangman\GameFlow;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function start()
    {
        $id = GameFlow::createGame();
        $game_flow = GameFlow::fromId($id);
        $remaining_attempts = $game_flow->get_game()->get_remaining_attempts();
        $secret_word_length = mb_strlen($game_flow->get_game()->get_secret_word());

        return view('game.start', compact('id', 'remaining_attempts', 'secret_word_length'));
    }

    public function guess(Request $request)
    {
        $id = $request->input('id');
        $letter = $request->input('letter') ?? '';

        $game_flow = GameFlow::fromId($id);
        $game = $game_flow->get_game();
        $game->guess($letter);

        $game_flow->update($game);

        $guessed_word = $game->get_guessed_word();
        $remaining_attempts = $game->get_remaining_attempts();
        $secret_word_length = mb_strlen($game->get_secret_word());

        if (!($game->has_remaining_attempts() && !$game->is_word_guessed())) {
            $guessed = $game->is_word_guessed();
            $word = $game->get_secret_word();
            return view('game.end', compact('id', 'guessed_word', 'remaining_attempts', 'secret_word_length', 'guessed', 'word'));
        }

        return view('game.start', compact('id', 'guessed_word', 'remaining_attempts', 'secret_word_length'));
    }
}
