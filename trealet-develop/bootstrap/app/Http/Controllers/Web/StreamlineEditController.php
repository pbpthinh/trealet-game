<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;

class StreamlineEditController extends Controller
{
	public function __construct()
    {
		$this->middleware('auth');
    }
	
    public function index()
    {
		//return "Streamline Editor";
		$tr = "";
		return view('trealets.streamline-edit', compact('tr'));
    }

}
