<?php
namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Method;
use Symfony\Component\Console\Output\ConsoleOutput;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Trealets;
use Vanguard\User;
use Vanguard\UserToTrealet;
use Vanguard\Http\Controllers\Web\StreamlineController;

class TrealetsSearch extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        //At this momment query all Trealets for mock searching where published is 1
        $trs = Trealets::where('active', "0" )->get();
        foreach ($trs as $tr) {
            $user = User::where('id',$tr->user_id)->first();
            $tr->creator = $user->username;
        };
        $user = NULL;

        //Get current user info (if authenticated)
        if(auth()->id()){
            $user = User::where('id','=',auth()->id())->first();
        }

        return view('trealets.trealets-search', compact('trs'));
    }
    public function check_key(Request $req, $id)
    {
        $tr = Trealets::where('id','=',$id) -> first();
        if($tr->pass != $req->key){
            return redirect()->back()->withSuccess('Bạn đã nhập sai key!!') ;
        }
        else {
            return redirect($tr->type."?tr=".$tr->id_str);
        }
    }
}
