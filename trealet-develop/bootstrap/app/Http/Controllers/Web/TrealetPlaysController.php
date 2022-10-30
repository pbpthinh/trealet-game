<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Trealets;
use Vanguard\User;
use Vanguard\UserToTrealet;

class TrealetPlaysController extends Controller
{
    public function __construct()
    {
        // Allow access to authenticated users only.
        $this->middleware('auth');

        // Allow access to users with 'users.manage' permission.
        //$this->middleware('permission:users.manage');
    }

    public function index()
    {
		$utts = UserToTrealet::join('trealets','user_to_trealet.trealet_id_str','trealets.id_str')
							->select('trealets.id_str','trealets.title','user_to_trealet.user_id')
							->where('user_to_trealet.user_id','=',auth()->id())
							->groupBy('trealets.id_str','trealets.title','user_to_trealet.user_id')
							->get();
		foreach($utts as &$utt)
		{
			$ut   = UserToTrealet::where([['trealet_id_str','=',$utt->id_str],
										  ['user_id','=',$utt->user_id]])->first();			
			$utt->played_at = $ut->created_at;
		}
        return view('trealets.trealet-plays', compact('utts'));   
    }
    public function play_a_trealet($id){
        $tr = Trealets::where('id','=',$id)->first();
        $creator = User::where('id','=',$tr['user_id'])->first();

        if(!$tr) return 'Cannot find the trealet';
        if($tr->type == "360view"){
            return view('trealets.360view');
        }
        else{
            return (new StreamlineController)->play_a_trealet($id);
        }
    }

}
