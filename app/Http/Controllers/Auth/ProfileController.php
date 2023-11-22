<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('auth.profile');
    }

    public function store(Request $request){

        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'name' => ['required','min:5','string'],
            'username' => ['required','min:5','max:20','unique:users,username,'.auth()->user()->id, 'not_in:edit-profile,twitter'],
            'email' => ['required','min:5','max:100','email','unique:users,email,'.auth()->user()->id],
        ]);

        if($request->password){
            $this->validate($request, [
                'password' => ['required','min:6',],
                'new_password' => ['required','confirmed','min:6']
            ]);

            if(!auth()->attempt($request->only('email', 'password'))){
                return back()->with('message', 'Credenciales Incorrectas');
            }
        }

        if($request->image){
            $image = $request->file('image');

            $name_file = Str::uuid() . "." . $image->extension();

            $imageServer = Image::make($image);
            $imageServer->fit(1000, 1000);

            $imagePath = public_path('profiles') . '/' . $name_file;
            $imageServer->save($imagePath);
        }

        $user = User::find(auth()->user()->id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->new_password ? Hash::make($request->new_password) : auth()->user()->password;
        $user->image = $name_file ?? auth()->user()->image ?? null;
        $user->save();

        return redirect()->route('posts.index', $user->username);
    }
}
