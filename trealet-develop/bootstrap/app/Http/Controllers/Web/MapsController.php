<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;
use Vanguard\UserToTrealet;
use Vanguard\Trealets;

class MapsController extends Controller
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
      return view('trealets.maps', compact('utts'));   
  }


  public function maps_trealet()
    {
      $maps_play = UserToTrealet::join('trealets','user_to_trealet.trealet_id_str','trealets.id_str')
      ->select('trealets.id_str','trealets.title','user_to_trealet.user_id','user_to_trealet.no_in_json','user_to_trealet.type','user_to_trealet.data')
      ->where('user_to_trealet.user_id','=',auth()->id())
      ->get();

      $tr_id = request()->get('tr');
		
      //Fetch trealet info
      $tr = Trealets::where('id_str','=',$tr_id)->first();

      $played = array();

      foreach($maps_play AS $var=>$value){
        array_push( $played, $value );
      }

      $tr->played = $played;

      return $tr;   
    }
}
