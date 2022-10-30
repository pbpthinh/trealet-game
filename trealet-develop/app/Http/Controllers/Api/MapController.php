<?php

namespace Vanguard\Http\Controllers\Api;
use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Trealets;
use Vanguard\User;
use Vanguard\UserToTrealet;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    public function __construct()
    {
		// $this->middleware('auth:api');
    }
	  public function index($id)
    {
    	$trealet = Trealets::where('id','=',$id)->first();
        return response() -> json($trealet);
    }
	
	public function store(Request $request){
	

		$tr = new Trealets;
		$tr -> title = $request->input('title');
		$tr -> user_id = $request->input('user_id');
		$tr -> type = $request->input('type');
		$tr -> published = $request->input('published');
		$tr -> pass = $request->input('pass');
		// $tr -> state = $request->input('state');
		$tr -> json = json_encode($request->input('trealet'));
		$tr -> id_str = rand(10000000000000000,99999999999999999);
		$tr -> save();

		// Trealets:: create($request->all());
		// return response()-> json("ahihi");
		return response()-> json(200);
	}

	public function update(Request $request,$id){
		$tr = Trealets::where('id','=',$id)->first();
		$tr -> title = $request->input('title');
		$tr -> user_id = $request->input('user_id');
		$tr -> type = $request->input('type');
		$tr -> published = $request->input('published');
		$tr -> pass = $request->input('pass');
		// $tr -> state = $request->input('state');
		$tr -> json = json_encode($request->input('trealet'));
		$tr -> save();
	}

	
}
