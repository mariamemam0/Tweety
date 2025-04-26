@extends('layouts.app')

@section('content')
    <h1>{{ $user->name }}'s Profile</h1>

    <h2 class="text-xl mt-4 mb-2">Tweets</h2>

    @foreach ($user->tweets as $tweet)
        <div class="mb-4 p-4 border rounded">
            {{ $tweet->body }}
        </div>
    @endforeach
@endsection
