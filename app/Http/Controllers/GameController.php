<?php

namespace App\Http\Controllers;

use App\Hangman\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GameController extends Controller
{
    public function start()
    {
        $id = uniqid();
        $this->generateWord($id);

        return view('game.start', compact('id'));
    }

    public function guess(Request $request)
    {
        $id = $request->input('id');
        $letter = $request->input('letter');
        $secret_word = Cache::get($this->tag($id));

        $game = new Game($secret_word);
        $game->guess($letter);

        if (!($game->has_remaining_attempts() && !$game->is_word_guessed())) {
            return back()->with([
                'id' => $id,
                'guessed_word' => $game->get_guessed_word(),
            ]);
        }

        $game->guess($letter);

        $guessed_word = $game->get_guessed_word();

        return view('game.start', compact('id', 'guessed_word'));
    }

    private function generateWord($id): string
    {
        if (!Cache::has($this->tag($id))) {
            $secret_word = 'Good';
            Cache::put($this->tag($id), $secret_word);
        } else {
            $secret_word = Cache::get($this->tag($id));
        }

        return $secret_word;
    }

    private function tag($id)
    {
        return 'secret_word_' . $id;
    }
}
