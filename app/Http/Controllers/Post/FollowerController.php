<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user){
        $user->followersMe()->attach( auth()->user()->id );
        return back();
    }

    public function destroy(User $user){
        $user->followersMe()->detach( auth()->user()->id );
        return back();
    }
}
