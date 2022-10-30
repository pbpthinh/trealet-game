<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;
use Vanguard\Trealets;
use Vanguard\User;
use Vanguard\UserToTrealet;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class apiQrController extends Controller
{
    public function __construct()
    {
		//$this->middleware('auth');
    }


	function parseTrealetJSON($json_string,$exec)
	{
		$d = json_decode($json_string, true);
		if(!$d) die('Cannot parse the trealet content!');
		if(!isset($d['trealet'])) die('It is not a trealet!');
		if(isset($d['trealet']['exec']) && $d['trealet']['exec']!=$exec) die('Wrong executable name!');
		return $d['trealet'];
	}

	function fetchItemData($item_url)
	{
		if(is_numeric($item_url))
		{
			$item_url = 'https://hcloud.trealet.com/tiny'.$item_url.'/?json';
			$json_string = file_get_contents($item_url);
			if(!$json_string) return;
			$d = json_decode($json_string, true);
			return $d['image'];
		}
		else
		{
			return $item_url;
		}
}

    public function index()
    {
        return view('trealets.qr-question-play');

    }
    public function play_a_trealet($id)
    {

    $tr = Trealets::where('id','=',$id)->first();

        //Fetch the info of trealet's creator
        $creator = User::where('id','=',$tr['user_id'])->first();

        if(!$tr) return 'Cannot find the trealet';

        //Get current user info (if authenticated)
        $user = NULL;
        if(auth()->id()) $user = User::where('id','=',auth()->id())->first();
        $tr_id = $tr->str_id;
        //Fetch score info
        $scored = UserToTrealet::where([['trealet_id_str','=',$tr_id],
            ['user_id','=',auth()->id()],
            ['no_in_json','=',0]])
            ->first();

        $d = $this->parseTrealetJSON($tr->json,'stepquest');

        if(is_string($d)) return $d;	//A string return means parse error

        $ni = sizeof($d['items']);
        $iu = array($ni);
        $items = [];
        for($i=0;$i<$ni;$i++)
        {
            $itemid = $d['items'][$i];
            $items[$i] = $this->fetchItemData($itemid);

        }

        return compact('user','tr','d','items','scored','creator');
    }
    public function qr($id)
    {
        $data = Trealets::findOrFail($id);
        $qrQuestion = json_decode($data->json, true)['trealet'];
        $ni = sizeof($qrQuestion['items']);
        $iu = array($ni);
        $items = [];
        for($i=0;$i<$ni;$i++)
        {
            $itemid = $qrQuestion['items'][$i];
            $items[$i] = $this->fetchItemData($itemid);

        }

        return view('trealets.qr-generator', compact('id', 'items'));
        // return QrCode::format('png')->generate('Embed me into an e-mail!');
        // return QrCode::format('png')->mergeString("abc")->generate();
        // return QrCode::format('png')->size(500)->generate('Welcome to kerneldev.com!');
    }
}
