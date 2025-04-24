<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tweety</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="container mx-auto p-4">
        @auth
            <div class="mb-4 flex justify-between items-center">
                <div>
                    <a href="/" class="text-xl font-bold text-blue-500">Tweety</a>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-gray-700">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-red-500">Logout</button>
                    </form>
                </div>
            </div>
        @endauth

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
