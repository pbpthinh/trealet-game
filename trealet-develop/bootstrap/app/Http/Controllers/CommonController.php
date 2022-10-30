<?php

namespace Vanguard\Http\Controllers\Web;
use Illuminate\Http\Request;
use Vanguard\Trealets;
use Vanguard\User;
use Vanguard\Http\Controllers\Controller;
use Symfony\Component\Console\Output\ConsoleOutput;

class CommonController extends Controller
{


    public function autocompleteSearch(Request $request)
    {
        $out = array();
        $output = new ConsoleOutput();
        $filterResult = User::select('email')->where('email', 'LIKE', "%{$request->term}%")->get();
        foreach($filterResult as $value) {

            array_push($out, $value->email);

        };

        return response()->json($out);
    }
}
