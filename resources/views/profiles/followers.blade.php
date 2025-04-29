@extends('layouts.app')

@section('content')
    <h1>{{ $user->name }}'s Followers</h1>

    @forelse ($followers as $follower)
        <div class="p-2 border-b">
            <a href="{{ route('profile', $follower->username) }}">{{ $follower->name }}</a>
        </div>
    @empty
        <p>No followers yet.</p>
    @endforelse
@endsection
