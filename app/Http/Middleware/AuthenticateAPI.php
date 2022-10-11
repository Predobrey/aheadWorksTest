<?php

    namespace App\Http\Middleware;

    use App\Models\User;
    use Illuminate\Auth\Middleware\Authenticate as Middleware;
    use Illuminate\Support\Facades\Auth;

    class AuthenticateAPI extends Middleware
    {
        protected function authenticate($request, array $guards) {
            if(empty($token)){
                $token = $request->bearerToken();
            }
            $tokenId = User::where('remember_token', $token)->value('id');
            $tokenHeader = User::where('id', $tokenId)->value('remember_token');

            if($token == $tokenHeader) return;

            $this->unauthenticated($request, $guards);
        }
    }

