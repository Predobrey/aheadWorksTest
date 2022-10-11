<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function getPost() {
        $userToken = Crypt::decryptString(request()->cookie('Authorization'));
        $getTokenUser= explode("|", $userToken);
        $userId = User::where('remember_token', $getTokenUser[1])->value('id');
        $userLogin = User::where('remember_token', $getTokenUser[1])->value('login');
        //        $per = ticket::where("uid", 'HTX-' . $userId)->get()->first();

        $allPost = ticket::where("uid", 'HTX-' . $userId)->get();
        $headerToken = array('token'=>$getTokenUser[1], 'login'=>$userLogin);
        $headerToken[] = $allPost;
        return $headerToken;
    }
    public function sendPost(Request $request) {
        $userToken = Crypt::decryptString(request()->cookie('Authorization'));
        $getTokenUser = explode("|", $userToken);
        $userId = User::where('remember_token', $getTokenUser[1])->value('id');
        $ticket = new ticket();
        $ticket->uid = 'HTX-' . $userId;
        $ticket->subject = $request->input('subject');
        $ticket->user_name = $request->input('user_name');
        $ticket->user_email = $request->input('user_email');
        $ticket->save();
        $name = $request->input('user_name');
        $subject = $request->input('subject');
        Mail::to($request->input('user_email'))->send(new SendMail($name,$subject));
        Log::info('Add new ticket: ' . $name);
        $allPost = ticket::where("uid", 'HTX-' . $userId)->get();
        $headerToken = ['token' => $getTokenUser[1]];
        $headerToken[] = $allPost;

        return $headerToken;
    }
}
