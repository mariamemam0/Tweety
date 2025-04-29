@extends('layouts.app')

@section('content')
    <form method="POST" action="/tweets" class="mb-6">
        @csrf
        <textarea name="body" class="w-full p-3 border rounded-lg" placeholder="What's on your mind?" required></textarea>
        <button type="submit" style="background:blue; color:white; padding:10px; border-radius:5px;">
            Tweet
        </button>
    </form>

    @foreach ($tweets as $tweet)
        <div class="bg-white p-4 rounded-lg shadow mb-4 flex items-start space-x-4">
            <!-- Profile Image with Inline Style -->
            <a href="{{ route('profile', $tweet->user->username) }}">
                <img src="{{ asset('storage/' . ($tweet->user->avatar ?? 'avatars/default.jpg')) }}"
                     alt="{{ $tweet->user->name }}'s avatar"
                     style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
            </a>

            <!-- Tweet Content -->
            <div>
                <p class="text-gray-800 font-bold">
                    <a href="{{ route('profile', $tweet->user->username) }}">
                        {{ $tweet->user->name }}
                    </a>
                </p>
                <p class="text-gray-600">{{ $tweet->body }}</p>
                <p class="text-sm text-gray-400">{{ $tweet->created_at->diffForHumans() }}</p>
            </div>
        </div>
    @endforeach
@endsection
