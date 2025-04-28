@extends('layouts.app')

@section('content')
    <h1>{{ $user->name }}'s Profile</h1>

    <style>
        /* Hover effect for profile image */
        .avatar:hover {
            transform: scale(1.1); /* Slightly increases the size of the image */
            transition: transform 0.3s ease-in-out; /* Smooth transition */
        }

        /* Hover effect for upload button */
        .upload-btn:hover {
            background-color: #4CAF50; /* Green color on hover */
            border-color: #388E3C; /* Darker green border on hover */
        }

        /* Image size and rounded corners */
        .avatar {
            width: 150px;
            height: 150px;
        }
    </style>

    <!-- Display the profile picture -->
    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}'s avatar" class="avatar mb-4 rounded-full object-cover">

    <!-- Form to upload new profile photo -->
    @if (Auth::id() == $user->id)
    <form method="POST" action="{{ route('profile.avatar', $user) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="avatar">Upload New Profile Photo:</label>
        <input type="file" name="avatar" id="avatar" required>

        <button type="submit" class="upload-btn mt-2 bg-blue-500 text-white px-4 py-2 rounded">
            Upload Photo
        </button>
    </form>
    @endif

    <!-- Display user's tweets -->
    <h2 class="text-xl mt-4 mb-2">Tweets</h2>

    @foreach ($user->tweets as $tweet)
        <div class="mb-4 p-4 border rounded">
            {{ $tweet->body }}
        </div>
    @endforeach

    <!-- Follow/Unfollow button -->
    <form method="POST" action="{{ route('follow', $user) }}">
        @csrf
        <button type="submit" style="background-color: blue; color: white; padding: 10px 20px; border-radius: 5px; font-size: 16px;">
            {{ auth()->user()->following->contains($user) ? 'Unfollow' : 'Follow' }}
        </button>
    </form>
@endsection
