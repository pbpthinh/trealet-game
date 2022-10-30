<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Vanguard\Trealets;
use Vanguard\User;
use Vanguard\UserToTrealet;
use Vanguard\Http\Controllers\Controller;
use Symfony\Component\Console\Output\ConsoleOutput;

class InputDataApiController extends Controller
{

    public function uploadData(Request $request)
    {
        $token = $request->bearerToken();
        $user = User::where('token','=', $token)->first();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $tr = Trealets::where('id','=', $request->input('trealet_id'))->first();
        if($tr){
        $utt = UserToTrealet::create([
            'user_id' => $user -> id,
            'trealet_id_str' => $tr-> id_str,
            'no_in_json' => $request->get('no_in_json'),
            'type' => $request->get('type'),
            'data' => $request->get('data')
        ]);
        $utt->save();
        }
        else{
            return response()->json(['message' => 'Fail'], 400);
        }
        $utt->save();
        return response()->json(['message' => 'Created'], 201);
    }
}