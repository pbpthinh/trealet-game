<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;
use Vanguard\UserToTrealet;
use Vanguard\Trealets;
use Vanguard\User;

class TrealetPlayDetails extends Controller
{
    public function __construct()
    {
        // Allow access to authenticated users only.
        $this->middleware('auth');
    }
	
	public function score()
	{
		$data = request()->get('data');
		$d = json_decode($data, true);	
		if(!$d) return "Error on post data";
		
		if(!isset($d['scored'])) return "Error on post data";
		
		$user_id = $d['user_id'];
		$tr_id = $d['trealet_id'];
		
		//Only the creator of the trealet is allowed to give score
		$tr = Trealets::where('id_str','=',$tr_id)->first();
		if($tr['user_id']!=auth()->id()) return 'You are not allowed to give scores on this trealet.'.$tr['user_id'].' '.auth()->id();
		
		if(!$d['scored']){//Clear scores
			$affected = UserToTrealet::where([['user_id','=',$user_id],
											  ['trealet_id_str','=',$tr_id],
											  ['no_in_json','=',0]])->delete();
			if($affected)
				return "Scores cleared";
			else
				return "Error";
		}	
		else//Update scores
		{	
			$affected = UserToTrealet::updateOrInsert(['user_id'=>$user_id,'trealet_id_str'=>$tr_id,'no_in_json'=>0],
											  ['type'=>'score','data'=>$data]);
			if($affected) 
				return 'Scores updated';
			else
				return 'Error';
		}
	}

    public function index()
    {
		$tr_id = request()->get('tr');
		$pl_id = request()->get('pl');
		
		$tr = Trealets::where('id_str','=',$tr_id)->first();
		
		if(auth()->id()==$tr['user_id'])
		{
			if(!$pl_id) $pl_id = auth()->id();
		}
		else
		{
			$pl_id = auth()->id();
		}
		
		$utts = UserToTrealet::where([['user_id','=',$pl_id],
									  ['trealet_id_str','=',$tr_id]])
							->orderBy('no_in_json')
							->get();
		$creator = User::where('id','=',$tr['user_id'])->first();
		
		$players = NULL;
		
		//Trealet creator wants to see the details of the trealet
		if(auth()->id()==$tr['user_id'])
		{
			$player_ids = UserToTrealet::select('user_id')
										->where('trealet_id_str','=',$tr_id)
										->groupBy('user_id')
										->get();
			$ids = [];
			foreach($player_ids as $player_id)
			{
				array_push($ids,$player_id['user_id']);
			}
			$players = User::whereIn('id',$ids)->get();
		}
							
		return view('trealets.trealet-play-details', compact('utts','tr','creator','players','pl_id'));   
    }
}
