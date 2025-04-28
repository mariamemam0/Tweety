<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    public function store(Request $request,User $user)
    {
        $request->validate([
            'avatar' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $path = $request->file('avatar')->store('avatars', 'public');
        $user->update([
            'avatar' => $path,
        ]);
        return back()->with('success', 'Profile photo uploaded successfully!');
    }

   
}
