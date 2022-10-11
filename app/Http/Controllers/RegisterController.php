<?php

namespace App\Http\Controllers;

use App\Models\server_credentials;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function save(Request $request) {
        if(Auth::check()) {
            return redirect(route('user.private'));
        }

        $validateFields = $request->validate([
            'login' => 'required|min:2|max:25',
            'password' => 'required|min:8|max:16',
        ]);
        if(User::where('login', $validateFields['login'])->exists()) {
            return redirect(route('user.registration'))->withErrors([
               'login' => 'Come up with another login!'
            ]);
        }

        $user = User::create($validateFields);
        if($user){
            Auth::login($user);
            $userId = Auth::id();
            $post = User::find($userId);
            $post->remember_token = bin2hex(random_bytes(10));
            $post->save();
            $cookie = cookie('Authorization', $post->remember_token, 50);
            return redirect()->to(route('user.private'))->cookie($cookie);
        }

        return redirect(route('user.login'))->withErrors([
        'formErrors'=> 'An error occurred while saving the user'
        ]);
    }
}
