<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Type;
use PhpParser\Node\Expr\Cast\Array_;
use Symfony\Component\Console\Output\ConsoleOutput;
use Vanguard\Http\Controllers\Controller;
use Vanguard\QrData;
use Vanguard\UserToTrealet;
use Vanguard\Trealets;
use Vanguard\User;
use Illuminate\Support\Facades\DB;
use function MongoDB\BSON\toJSON;

class EditTrealetController extends Controller
{
    public function index($id)
    {
        //Fetch trealet info
        $tr = Trealets::where('id','=',$id)->first();

        

        if(!$tr) return 'Cannot find the trealet';

        if($tr->type == "streamline"){
            //Fetch the info of trealet's creator
            $creator = User::where('id','=',$tr['user_id'])->first();
            //Get current user info (if authenticated)
            $user = NULL;
            if(auth()->id()) $user = User::where('id','=',auth()->id())->first();

        //Fetch score info
            $d = $this->parseTrealetJSON($tr->json,'streamline');

            if(is_string($d)) return $d;	//A string return means parse error

            $ni = sizeof($d['items']);
            $iu = array($ni);
            $items = [];
            for($i=0;$i<$ni;$i++)
                {
                    $itemid = $d['items'][$i];
                    $items[$i] = $this->fetchItemData($itemid);
                }
            $name = $d['title'];
            $json = $tr->json;
            $id = $tr->id;
            $desc = $d['desc'];
            return view('trealets.edit-old-streamline', compact('user','tr', 'id', 'd','items','creator', 'name', 'desc', 'json'));
        }    
        if($tr->type == "qrmedia"){
            $id = $tr->id;
            return view('trealets.edit-old-qrmedia', compact('tr', 'id'));
        }
        if($tr->type == "stepquest"){
            $data = Trealets::findOrFail($id);
            $stepquest = json_decode($data->json, true)['trealet'];
            return view('trealets.my-stepquest-edit', compact('id', 'stepquest'));
        }
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
    function parseTrealetJSON($json_string,$exec)
    {
        $d = json_decode($json_string, true);
        if(!$d) die('Cannot parse the trealet content!');
        if(!isset($d['trealet'])) die('It is not a trealet!');
        // if($d['trealet']['exec']!=$exec) die('Wrong executable name!');
        return $d['trealet'];
    }
    public function update( Request $req, $id)
    {

        $trealet= Trealets::find($id);
        $trealet-> title= $req->input('title');
        $trealet-> state= $req->input('state');

        $trealet-> published= $req->input('published');
        $trealet-> pass= $req->input('key');
        $trealet->save();

        return redirect(("/my-trealets"))->withSuccess('Đã lưu thông tin update !!!' );

    }
    public  function upload_new_trealet(Request $request){
        $tr = new Trealets();
        $tr->user_id = auth()->id();
        $tr->type = $request -> get("type");
        $tr->title = $request -> get("title");
        $tr->json = $request -> get("json");
        // $tr->save();

        if($request -> get("type") == "qrmedia"){
            self::save_qr_data($request -> get("items"), $request->get("lang"));
        }
        DB::insert(
            'insert into au_trealets(id_str, user_id, title, type, json) value(UUID_SHORT(), ?, ?, ?, ?)',
            [
                auth()->id(),   
                $tr->title,
                $tr->type,
                $tr->json,
            ]
        );
        return redirect(("/my-trealets"))->withSuccess('Tạo trealet thành công !!!' );
    }

    function save_qr_data(Array $items, String $lang){
        if($lang == "en"){
            $lang = "en_US";
        }
        if($lang == "vn"){
            $lang = "vi_IN";
        }
        if($lang == "fr"){
            $lang = "fr_IN";
        }
        foreach ($items as $item) {
            $data = QrData::where('qr_code', $item["id"])->where('language', $lang)->first();
            if($data){
                $data ->url_data = $item["src"] ;
                $data ->type = $item["type"] ;
            }
            else{
                $data = new QrData();
                $data ->url_data = $item["src"] ;
                $data ->qr_code = $item["id"];
                $data ->language = $lang;
                $data ->type = $item["type"] ;
                $data ->user_id = auth()->id() ;
                
            }
            $data ->save();
        };

    }

    public  function edit_trealet(Request $request){
        $tr= Trealets::find($request->get("id"));
        $tr->type = $request -> get("type");
        $tr->title = $request -> get("title");
        $tr->json = $request -> get("json");
        $tr->pass = $request -> get("key");
        $tr->save();
        if($request -> get("type") == "qrmedia"){
            self::save_qr_data($request -> get("items"), $request -> get("lang"));
        }
    }

}
