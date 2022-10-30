<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Output\ConsoleOutput;
use Vanguard\Http\Controllers\Controller;
use Vanguard\UserToTrealet;
use Vanguard\Trealets;
use Vanguard\User;

class UploadController extends Controller
{
    public function upload_to_nextcloud($w_output, $namefile){
        $nombre_fichero = $w_output;
        $gestor = fopen($nombre_fichero, "rb");
        $contenido = fread($gestor, filesize($nombre_fichero));
        fclose($gestor);
            
        $login = 'nextcloud';
        $password = 'Bund7zXeVz7YnFknLGcnUjHtk';
        $url = 'http://194.233.94.93:8888//remote.php/dav/files/nextcloud/'.$namefile;
        
        $options = array(
        CURLOPT_SAFE_UPLOAD => true,
        CURLOPT_HEADER => true,
        CURLOPT_CUSTOMREQUEST => "PUT",
        CURLOPT_URL => $url,
        CURLOPT_POSTFIELDS => $contenido,
        CURLOPT_SSL_VERIFYPEER=> false,
        CURLOPT_RETURNTRANSFER=> 1,
        CURLOPT_HTTPAUTH=>CURLAUTH_BASIC,
        CURLOPT_USERPWD=> $login.':'.$password,
        CURLOPT_HTTPHEADER=>array('OCS-APIRequest: true')
        );
        
        $curl = curl_init();
        curl_setopt_array($curl, $options);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
        
    }
    function PNG2JPG($png, $jpg)
    {
        $image = imagecreatefrompng((String)$png);
        $bg = imagecreatetruecolor(imagesx($image), imagesy($image));
        imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
        imagealphablending($bg, TRUE);
        imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
        imagedestroy($image);
        $quality = 100; // 0 = low / smaller file, 100 = better / bigger file
        imagejpeg($bg, $jpg, $quality);
        imagedestroy($bg);
    }

    // function insert_new_picture($from, $name)
    // {
    //     $oid  = uniqid();
    //     $type = 'picture';
    //     $output_png = request()->server('DOCUMENT_ROOT').'/upload/trealet-data/'.$name.'.png';
    //     $output_jpg = request()->server('DOCUMENT_ROOT').'/upload/trealet-data/'.$name.'.jpg';
    //     move_uploaded_file($from, $output_png);
    //     $this->PNG2JPG($output_png, $output_jpg);
    //     unlink($output_jpg);
    //     $w_output = '../upload/trealet-data/'.$name.'.png';
    //     return $w_output;

    // }
    public function image_upload(Request $request)
    {
        if(!request()->hasFile('picture_file')) return response()->json(['message' => 'No audio file uploaded'],400);
        $file = request()->file('picture_file');

        $realpath = $file->getRealPath();
    
        $name = date('YmdHis').random_int(10, 99);
        $path = $this->insert_new_picture($realpath, $name); //date('YmdHis') );
        // return response()->json(['data' => $path], 200);
        return $path;
    }

    public function image_upload_api(Request $request)
    {
        if(!request()->hasFile('picture_file')) return response()->json(['message' => 'No audio file uploaded'],400);
        $file = request()->file('picture_file');

        $realpath = $file->getRealPath();
    
        $name = date('YmdHis').random_int(10, 99);
        $path = $this->insert_new_picture($realpath, $name); //date('YmdHis') );
        return response()->json(['data' => $path], 200);
    }
    public function video_upload(Request $request){
        if(!request()->hasFile('video_file')) return response()->json(['message' => 'No audio file uploaded'],400);
        $file = request()->file('video_file');       
        $realpath = $file->getRealPath();
        
        $name = date('YmdHis').random_int(10, 99);
        $path = $this->insert_new_video($realpath, $name );
        return $path;
        // return response()->json(['data' => $path], 200);
    }

    public function video_upload_api(Request $request){
        if(!request()->hasFile('video_file')) return response()->json(['message' => 'No audio file uploaded'],400);
        $file = request()->file('video_file');       
        $realpath = $file->getRealPath();
        
        $name = date('YmdHis').random_int(10, 99);
        $path = $this->insert_new_video($realpath, $name );
        return response()->json(['data' => $path], 200);
    }

    function insert_new_video($from, $name)
    {
        $output_mp4 = request()->server('DOCUMENT_ROOT').'/upload/trealet-data/'.$name.'.mp4';
        move_uploaded_file($from, $output_mp4);
        $w_output = '../upload/trealet-data/'.$name.'.mp4';
        $namefile = $name.'.mp4';
        $this->upload_to_nextcloud($output_mp4, $namefile);
        return $w_output;
    }

    function insert_new_picture($from, $name)
    {
        $output_png = request()->server('DOCUMENT_ROOT').'/upload/trealet-data/'.$name.'.png';
        //$output_jpg = request()->server('DOCUMENT_ROOT').'/upload/trealet-data/'.$name.'.jpg';
        move_uploaded_file($from, $output_png);
        //unlink($output_jpg);
        $w_output = '../upload/trealet-data/'.$name.'.png';
        $namefile = $name.'.png';
        $this->upload_to_nextcloud($output_png, $namefile);
        return $w_output;
    }

    public function audio_upload(Request $request){
        
   
        if(!request()->hasFile('audio_file')) return response()->json(['message' => 'No audio file uploaded'],400);
        $file = request()->file('audio_file');
        $realpath = $file->getRealPath();
        $name = date('YmdHis').random_int(10, 99);
        $path = $this->insert_new_audio($realpath, $name);
        // return response()->json(['data' => $path], 200);
        return $path;
    }

    public function audio_upload_api(Request $request){
        
   
        if(!request()->hasFile('audio_file')) return response()->json(['message' => 'No audio file uploaded'],400);
        $file = request()->file('audio_file');
        $realpath = $file->getRealPath();
        $name = date('YmdHis').random_int(10, 99);
        $path = $this->insert_new_audio($realpath, $name);
        return response()->json(['data' => $path], 200);
    }

    function insert_new_audio($from, $name)
    {
        $output_mp3 = request()->server('DOCUMENT_ROOT').'/upload/trealet-data/'.$name.'.mp3';
        move_uploaded_file($from, $output_mp3);
        $w_output = '../upload/trealet-data/'.$name.'.mp3';
        $namefile = $name.'.mp3';
        $this->upload_to_nextcloud($output_mp3, $namefile);
        return $w_output;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function imageUploadPost(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        $request->image->move(public_path('images'), $imageName);

        return back()
            ->with('success','You have successfully upload image.')
            ->with('image',$imageName);
    }

    

}
