<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\server_credentials;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function submitLogin(LoginRequest $req) {
//        $validation = $req->validate([
//            'login' => 'required|min:2|max:25',
//            'password' => 'required|min:8|max:16',
//        ]);

        $server_credentials = new server_credentials();
        $server_credentials->ftp_login = $req->input('login');
        $server_credentials->ftp_password = $req->input('password');
        $server_credentials->token_user = '123';
        $server_credentials->save();
        return redirect()->route('tickets')->with('success','Сообщение было добавлено');
    }

    public function login(Request $request){
        if(Auth::check()) {
            return redirect()->intended(route('user.private'));
        }
        $formFields = $request->only(['login','password']);

        if(Auth::attempt($formFields)){
            $userId = Auth::id();
            $post = User::find($userId);
            $post->remember_token = bin2hex(random_bytes(10));
            $post->save();
            $cookie = cookie('Authorization', $post->remember_token, 50);
            return redirect()->intended(route('user.private'))->cookie($cookie);
        }

        return redirect(route('user.login'))->withErrors([
            'login'=> 'Failed to log in!'
        ]);
    }
}
