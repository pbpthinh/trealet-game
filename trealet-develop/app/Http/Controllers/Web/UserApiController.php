<?php

namespace Vanguard\Http\Controllers\Web;
use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Vanguard\User;
use Exception;
use Illuminate\Support\Str;
use Symfony\Component\Console\Output\ConsoleOutput;
class UserApiController extends Controller
{
    public function registerUser(Request $request)
    {
        $user = User::where('email','=', $request->get('email'))->first();
        if($user){
            return response()->json(['message' => 'Email is exist'], 400)->header("Access-Control-Allow-Origin",  "*");
        }
        $user = User::where('username','=', $request->get('username'))->first();
        if($user){
            return response()->json(['message' => 'Username is exist'], 400)->header("Access-Control-Allow-Origin",  "*");
        }
        try {
            $token = Str::random(64);
            $user = User::create([
                'email' => $request->get('email'),
                'username' => $request->get('username'),
                'password' => Hash::make($request->get('password')),
                'token' => $token
            ]);
            $user->save();
            return response()->json(['message' => 'Created', 'token' => $token], 201)->header("Access-Control-Allow-Origin",  "*");
        } catch (Exception $e) {  
            return response()->json(['message' => 'Fail'], 400)->header("Access-Control-Allow-Origin",  "*");    
        }
    }
}
