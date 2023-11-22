<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index(User $user){

        $posts = Post::where('user_id', $user->id)->paginate(20);

        return view('posts.dashboard', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => ['required'],
            'description' => ['required'],
            'image' => ['required'],
        ]);

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post){
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function destroy(Post $post){
        if($post->user_id === auth()->user()->id){
            $this->authorize('delete', $post);
            $post->delete();

            $image_path = public_path('uploads/' . $post->image);

            if(File::exists($image_path)){
                unlink($image_path);
            }

            return redirect()->route('posts.index', auth()->user()->username);
        }
    }
}
