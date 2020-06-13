@extends('layouts.game')

@section('content')

    <div class="container mt-5">

        <h1>Hangman Game</h1>

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
                    autofocus>

            <button type="submit" class="btn btn-primary btn-lg mb-2" id="btn-guess">Guess</button>
        </form>

        <div id="guessed_word">
            {{ $guessed_word ?? '' }}
        </div>
    </div>

    <style>
        #guessed_word {
            color: #3c9850;
            font-size: 25px;
            letter-spacing: 10px;
            background: #d1ffcb;
            padding: 20px;
        }
        #letter-label {
            margin-right: 10px; font-size: 20px;
        }
        #letter {
            display: inline-block;
            width: 65px;
            border: solid 2px #58b796;
            padding: 25px 20px;
            font-size: 20px;
        }
        #btn-guess {
            padding: 13px 20px;
        }
    </style>
@endsection
