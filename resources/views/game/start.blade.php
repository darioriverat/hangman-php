@extends('layouts.game')

@section('content')

    <div class="container mt-5">

        <h1>Hangman Game</h1>

        <p>
            The secret word I'm thinking of has {{ $secret_word_length }} letters.
        </p>

        <form action="{{ route('guess') }}" method="post" class="form" autocomplete="off">
            @csrf
            <input type="hidden" name="id" value="{{ $id }}">

                <label for="letter" id="letter-label">Guess a letter</label><br />
                <input
                    type="text"
                    class="form-control"
                    name="letter"
                    id="letter"
                    maxlength="1"
                    autofocus
                    required>

            <button type="submit" class="btn btn-primary btn-lg mb-2" id="btn-guess">Guess</button>
        </form>

        @isset($guessed_word)
            <div id="guessed_word" class="alert alert-info">
                {{ $guessed_word }}
            </div>
        @endisset
        <div>
            You have {{ $remaining_attempts }} guesses left
        </div>
    </div>
@endsection
