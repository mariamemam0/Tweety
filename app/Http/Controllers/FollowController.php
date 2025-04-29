<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}
