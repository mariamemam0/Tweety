@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Notifications</h1>

    @if($notifications->isEmpty())
        <p>No new notifications.</p>
    @else
        <ul>
            @foreach ($notifications as $notification)
                <li class="mb-4 p-4 border rounded">
                    <div>
                        <!-- Display the notification message -->
                        <strong>{{ $notification->data['message'] }}</strong>
                    </div>
                    <div>
                        <!-- Display the timestamp of the notification -->
                        <small class="text-gray-500">{{ $notification->created_at->diffForHumans() }}</small>
                    </div>

                    <!-- If the notification is unread, add a class or style to highlight it -->
                    @if (is_null($notification->read_at))
                        <div class="text-blue-500 font-bold">New</div>
                        <!-- Mark as read form -->
                        <form action="{{ route('notifications.read', $notification->id) }}" method="POST" class="mt-2">
                            @csrf
                            <button type="submit" class="text-blue-500">Mark as Read</button>
                        </form>
                    @else
                        <div class="text-gray-500">Read</div>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
@endsection
