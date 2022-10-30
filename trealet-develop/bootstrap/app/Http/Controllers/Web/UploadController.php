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
    function insert_new_picture($from, $name)
    {
        $oid  = uniqid();
        $type = 'picture';
        $output_png = request()->server('DOCUMENT_ROOT').'/upload/trealet-data/'.$name.'.png';
        $output_jpg = request()->server('DOCUMENT_ROOT').'/upload/trealet-data/'.$name.'.jpg';
        move_uploaded_file($from, $output_png);
        $this->PNG2JPG($output_png, $output_jpg);
        unlink($output_jpg);
        $w_output = '../upload/trealet-data/'.$name.'.png';
        return $w_output;

    }
    public function image_upload(Request $request)
    {
        if(!request()->hasFile('picture_file')) return "No picture file uploaded";
        $file = request()->file('picture_file');

        $filename = $file->getClientOriginalName();
        $realpath = $file->getRealPath();
        $path = $this->insert_new_picture($realpath, date('YmdHis') );
        return $path;
    }
    public function video_upload(Request $request){
        if(!request()->hasFile('video_file')) return "No video file uploaded";
        $file = request()->file('video_file');
        $filename = $file->getClientOriginalName();
        $realpath = $file->getRealPath();
        $output = new ConsoleOutput();
        $output->writeln($realpath);
        $path = $this->insert_new_video($realpath, date('YmdHis') );
        return $path;
    }

    function insert_new_video($from, $name)
    {
        $output_mp4 = request()->server('DOCUMENT_ROOT').'/upload/trealet-data/'.$name.'.mp4';
        move_uploaded_file($from, $output_mp4);
        $w_output = '../upload/trealet-data/'.$name.'.mp4';
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
