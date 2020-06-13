@extends('layouts.game')

@section('content')

    <div class="container mt-5">

        <h1>Hangman Game</h1>

        <div id="guessed_word" class="alert {{ $guessed ? 'alert-success' : 'alert-danger' }}">
            {{ $guessed_word ?? '' }}
        </div>
        @if($guessed)
            <p class="text-success mt-3">
                Congratulations!, you guessed the word
            </p>
        @else
            <p class="text-danger mt-3">
                Game over, the word was <strong>{{ $word }}</strong>
            </p>
        @endif

        <a href="{{ route('start') }}" class="btn btn-success">Start Game</a>
    </div>
@endsection
