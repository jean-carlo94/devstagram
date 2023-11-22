<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function __invoke(){

        $followers_id = auth()->user()->followingTo->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $followers_id)->latest()->paginate(20);

        return view('home', [
            'posts' => $posts,
        ]);
    }
}
