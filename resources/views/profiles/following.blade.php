@extends('layouts.app')

@section('content')
    <h1>{{ $user->name }} is Following</h1>

    @forelse ($followings as $followedUser)
        <div class="p-2 border-b">
            <a href="{{ route('profile', $followedUser->username) }}">{{ $followedUser->name }}</a>
        </div>
    @empty
        <p>Not following anyone yet.</p>
    @endforelse
@endsection
