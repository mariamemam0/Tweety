<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\UserFollowed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function followers(User $user)
    {
        return view('profiles.followers',[
            'user'=>$user,
            'followers' => $user->followers,
        ]);
    }


    public function followings(User $user)
    {
        
        return view('profiles.following',[
            'user'=>$user,
            'followings' => $user->following,
        ]);
    }

    


    public function follow(User $user)
{
    $currentUser = Auth::user();

    // Prevent following self
    if ($currentUser->id === $user->id) {
        return back()->with('error', 'You cannot follow yourself.');
    }

    // Check if not already following
    if (!$currentUser->following->contains($user->id)) {
        $currentUser->following()->attach($user->id);
        $user->notify(new UserFollowed($currentUser)); // Send notification
    } else {
        // Optional: Unfollow if already followed
        $currentUser->following()->detach($user->id);
    }

    return back()->with('success', 'Follow action completed.');
}

}
