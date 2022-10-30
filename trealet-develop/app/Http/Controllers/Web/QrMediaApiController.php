<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Vanguard\Trealets;
use Vanguard\User;
use Vanguard\Http\Controllers\Controller;
use Symfony\Component\Console\Output\ConsoleOutput;
use Vanguard\QrData;

class QrMediaApiController extends Controller
{
    public function index(Request $request)
    {
        $token = $request->bearerToken();
        $user = User::where('token','=', $token)->first();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $data = collect([]);
        $trs = Trealets::where('type','=', 'qrmedia' )->whereNull('active')->get();
        foreach ($trs as $tr) {
            $user = User::where('id',$tr->user_id)->first();

            if($user){
                $tr->creator = $user->username;
            }
            else{
                $tr->creator = "";
            }
            $responseTr = collect([]);
            $responseTr->put("id", $tr->id);
            $responseTr->put("name", $tr->title);
            $responseTr->put("creator", $tr->creator);
            $data->push($responseTr);
        };
        if ($trs) {
            return response()->json(['data' => $data], 200)->header("Access-Control-Allow-Origin",  "*");
        } else {
        return response()->json(['message' => 'Fail'], 400)->header("Access-Control-Allow-Origin",  "*");
        }
       
    }

    public function getByUserId(Request $request)
    {
        $token = $request->bearerToken();
        $user = User::where('token','=', $token)->first();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401)->header("Access-Control-Allow-Origin",  "*");
        }
        $trs = Trealets::where('type','=', 'qrmedia' )->whereNull('active')->where('user_id','=', $request->input('user_id') )->get();
        if ($trs) {
            return response()->json(['data' => $trs], 200)->header("Access-Control-Allow-Origin",  "*");
           } else {
        return response()->json(['message' => 'Fail'], 400)->header("Access-Control-Allow-Origin",  "*");
        }
    }

    public function getByTrealetId(Request $request)
    {
        $token = $request->bearerToken();
        $user = User::where('token','=', $token)->first();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401)->header("Access-Control-Allow-Origin",  "*");
        }
        $tr = Trealets::where('id','=', $request->input('id'))->first();
        if ($tr) {
            return response()->json(['data' => $tr], 200)->header("Access-Control-Allow-Origin",  "*");
           } else {
            
        return response()->json(['message' => 'Fail'], 400)->header("Access-Control-Allow-Origin",  "*");
        }
        
    }

    public function getMediaById(Request $request){
        $qrData = QrData::where('qr_code','=', $request->input('qr_code'))->where('language','=', $request->input('lang'))->first();
        if ($qrData) {
            return response()->json(['data' => $qrData -> url_data, 'type'=> $qrData -> type], 200)->header("Access-Control-Allow-Origin",  "*");
        }
        {   
            return response()->json(['message' => 'Fail'], 400)->header("Access-Control-Allow-Origin",  "*");
        }
    }
}