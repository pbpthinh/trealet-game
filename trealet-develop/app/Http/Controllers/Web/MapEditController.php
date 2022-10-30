<?php

namespace Vanguard\Http\Controllers\Web;
use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Trealets;
use Vanguard\User;
use Vanguard\UserToTrealet;

class MapEditController extends Controller
{
	public function __construct()
    {
		$this->middleware('auth');
    }
	
    public function index()
    {
        $map_trealet = new Trealets;
        //Get current user info (if authenticated)
        $user = NULL;   
        $mapId = NULL;
        if(auth()->id()) $user = User::where('id','=',auth()->id())->first();

		return view('trealets.map-edit', compact('map_trealet','user','mapId'));
    }
    public function getMap($id){
        $map_trealet = Trealets::where('id','=',$id)->first();
        $user = NULL;   
        $mapId = $id;
        if(auth()->id()) $user = User::where('id','=',auth()->id())->first();

    	if($user->id == $map_trealet->user_id) return view('trealets.map-edit', compact('map_trealet','user','mapId')) ;
        else return redirect(("/my-trealets"));
    }
}
