@extends('layouts.app')


@section('content')

<!-- Notification Icon (Bell Icon) -->
<div class="flex items-center justify-end">
    <a href="{{ route('notifications.index') }}" class="relative">
        <!-- Notification Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A9.971 9.971 0 0016 12V8a4 4 0 00-8 0v4a9.977 9.977 0 00-6.595 3.595L4 17h5m6 0v1a3 3 0 01-6 0v-1" />
        </svg>

        <!-- Display the count of unread notifications -->
        @if(auth()->user()->unreadNotifications->count() > 0)
            <span class="absolute top-0 right-0 inline-block w-5 h-5 text-xs text-white bg-red-600 rounded-full flex items-center justify-center">
                {{ auth()->user()->unreadNotifications->count() }}
            </span>
        @endif
    </a>
</div>
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
