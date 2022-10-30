<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Vanguard\Trealets;
use Vanguard\User;
use Vanguard\Http\Controllers\Controller;
use Symfony\Component\Console\Output\ConsoleOutput;

class StreamlineApiController extends Controller
{
    public function index(Request $request)
    {
        $token = $request->bearerToken();
        $user = User::where('token','=', $token)->first();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $trs = Trealets::where('type','=', 'streamline' )->whereNull('active')->get();
        foreach ($trs as $tr) {
            $user = User::where('id',$tr->user_id)->first();

            if($user){
                $tr->creator = $user->username;
            }
            else{
                $tr->creator = "";
            }
        };
        if ($trs) {
            return response()->json(['data' => $trs], 200);
        } else {
        return response()->json(['message' => 'Fail'], 400);
        }
       
    }

    public function getByUserId(Request $request)
    {
        $token = $request->bearerToken();
        $user = User::where('token','=', $token)->first();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $trs = Trealets::where('type','=', 'streamline' )->whereNull('active')->where('user_id','=', $request->input('user_id') )->get();
        if ($trs) {
            return response()->json(['data' => $trs], 200);
           } else {
        return response()->json(['message' => 'Fail'], 400);
        }
    }

    public function getByTrealetId(Request $request)
    {
        $token = $request->bearerToken();
        $user = User::where('token','=', $token)->first();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $tr = Trealets::where('id','=', $request->input('id'))->first();
        if ($tr) {
            return response()->json(['data' => $tr], 200);
           } else {
            
        return response()->json(['message' => 'Fail'], 400);
        }
        
    }

    
}