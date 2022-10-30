<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Vanguard\UserToTrealet;
use Vanguard\Http\Controllers\Controller;
use Vanguard\User;
use Vanguard\Trealets;
use Exception;

class MapPlayerApiController extends Controller
{
    public function maps()
    {
        return Trealets::where("type", "=", "maps")->get();
    }


    public function mapDetail(Request $request)
    {
        return UserToTrealet::join('trealets', 'user_to_trealet.trealet_id_str', 'trealets.id_str')
            ->select('trealets.id_str', 'trealets.title', 'user_to_trealet.user_id', 'user_to_trealet.no_in_json', 'user_to_trealet.type', 'user_to_trealet.data')
            ->where('user_to_trealet.user_id', '=', $request->input('user_id'))
            ->where('trealets.id_str', '=', $request->input('trealet_id'))
            ->get();
    }

    public function login(Request $request)
    {
        $user = User::where("email", "=", $request->input('email'))
            ->first();
        if (Hash::check($request->input('password'), $user->password)) {
            return $user;
        }

        return response()->json(['message' => "Wrong username or password"], 401)
            ->header("Access-Control-Allow-Origin",  "*");
    }

    public function register(Request $request)
    {
        $user = User::where('email', '=', $request->get('email'))->first();
        if ($user) {
            return response()->json(['message' => 'Email is exist'], 400)->header("Access-Control-Allow-Origin",  "*");
        }
        $user = User::where('username', '=', $request->get('username'))->first();
        if ($user) {
            return response()->json(['message' => 'Username is exist'], 400)->header("Access-Control-Allow-Origin",  "*");
        }
        try {
            $user = User::create([
                'email' => $request->input('email'),
                'username' => $request->input('username'),
                'password' => $request->input('password'),
            ]);
            $user->save();
            return response()->json(['message' => "Created"], 201)->header("Access-Control-Allow-Origin",  "*");
        } catch (Exception $e) {
            return response()->json(['message' => 'Fail'], 400)->header("Access-Control-Allow-Origin",  "*");
        }
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');
        $tmpPath = $file->getRealPath();
        $newPath = request()->server('DOCUMENT_ROOT') . '/upload/trealet-data/' . $file->getClientOriginalName();
        move_uploaded_file($tmpPath, $newPath);

        return response()->json(['data' => $file->getClientOriginalName()]);
    }

    public function getInput(Request $request)
    {
        $trealet_id = $request->get('trealet_id');
        $user_id = $request->get('user_id');
        $nij = $request->get('nij');
        $current = UserToTrealet::where([
            ['user_id', '=', $user_id],
            ['trealet_id_str', '=', $trealet_id], ['no_in_json', '=', $nij]
        ])->first();
        if ($current) {
            return response()->json(['data' => $current->data]);
        } else {
            return response()->json(['data' => 'error'], 404);
        }
    }

    public function socialLogin(Request $request)
    {
        $email = $request->get('email');
        $name = $request->get('name');
        $avatar = $request->get('avatar');

        $user = User::where('email', '=', $email)->first();
        if ($user) {
            return $user;
        } else {
            $user = User::create([
                'email' => $email,
                'username' => $name,
                'avatar' => $avatar,
                'password' => '12345678',
            ]);
            $user->save();
            return $user;
        }
    }

    public function saveInput(Request $request)
    {
        $trealet_id = $request->get('trealet_id');
        $user_id = $request->get('user_id');
        $nij = $request->get('nij');
        $type = $request->get('type');
        $data = $request->get('data');
        $current = UserToTrealet::where([
            ['user_id', '=', $user_id],
            ['trealet_id_str', '=', $trealet_id], ['no_in_json', '=', $nij]
        ])->first();

        if ($current) {
            $current->data = $data;
            $current->save();
        } else {
            UserToTrealet::create([
                'user_id' => $user_id,
                'trealet_id_str' => $trealet_id,
                'no_in_json' => $nij,
                'type' => $type,
                'data' => $data
            ]);
        }
    }
}
