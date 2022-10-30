<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Symfony\Component\Console\Output\ConsoleOutput;
use Vanguard\Http\Controllers\Controller;
use Vanguard\UserToTrealet;

class InputController extends Controller
{
	public function __construct()
    {
        //$this->middleware('auth');
    }
	
	function delete_prev($user_id, $tr_id, $type)
	{
		$utts = UserToTrealet::where([['user_id','=',$user_id],
									  ['trealet_id_str','=',$tr_id],
									  ['type','=',$type]])->get();

		foreach($utts as $utt)
		{
			$w_output = request()->server('DOCUMENT_ROOT').$utt->data;
			
			//Delete the file if exists
			@unlink($w_output);
		}
		
		$utts = UserToTrealet::where([['user_id','=',$user_id],
									  ['trealet_id_str','=',$tr_id],
									  ['type','=',$type]])->delete();
	}
	
	function insert_new_audio($from, $user_id, $tr_id, $nij)
	{
		$oid  = uniqid();
		$ext  = '.mp3';
		$type = 'audio';
		
		$output = request()->server('DOCUMENT_ROOT').'upload/trealet-data/'.$user_id.'_'.$tr_id.'_'.$oid.$ext;
		$w_output = 'upload/trealet-data/'.$user_id.'_'.$tr_id.'_'.$oid.$ext;
		move_uploaded_file($from, $output);
		$affected = UserToTrealet::insert(
						array(	'user_id' 			=> $user_id,
								'trealet_id_str' 	=> $tr_id,
								'no_in_json'	 	=> $nij,
								'type'				=> $type,
								'data'				=> $w_output)
					);
		return $affected;
	}
	
	public function audio_upload()
	{
		if(!auth()->check()) return false;
		
		if(!request()->hasFile('audio_data')) return "No audio file uploaded";
		$file = request()->file('audio_data');
		
		$filename = $file->getClientOriginalName();
		$realpath = $file->getRealPath();
		
		//Extract user_id and tr_id from input filename
		list($user_id, $tr_id, $nij, $name) = sscanf($filename, '%d %s %d %s');
		
		$this->delete_prev($user_id, $tr_id,'audio');
		
		if($this->insert_new_audio($realpath, $user_id, $tr_id, $nij))
			return 'Done';
		
		return 'Có lỗi';
	}
	
    public function audio()
	{
		// if(!auth()->check())
		// 	return "Bạn phải đăng nhập để sử dụng chức năng này";
		
		$trealet_id = request()->get('tr_id');
		$nij 		= request()->get('nij');
		$user_id	= auth()->id();
		
		return view('trealets.input-audio', compact('user_id','trealet_id','nij'));
	}
	
	function PNG2JPG($png, $jpg)
	{
		$image = imagecreatefrompng($png);
		$bg = imagecreatetruecolor(imagesx($image), imagesy($image));
		imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
		imagealphablending($bg, TRUE);
		imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
		imagedestroy($image);
		$quality = 100; // 0 = low / smaller file, 100 = better / bigger file 
		imagejpeg($bg, $jpg, $quality);
		imagedestroy($bg);
	}
	
	function insert_new_picture($from, $user_id, $tr_id, $nij)
	{
		$oid  = uniqid();
		$type = 'picture';
		
		$output_png = request()->server('DOCUMENT_ROOT').'upload/trealet-data/'.$user_id.'_'.$tr_id.'_'.$oid.'.png';
		$output_jpg = request()->server('DOCUMENT_ROOT').'upload/trealet-data/'.$user_id.'_'.$tr_id.'_'.$oid.'.jpg';
		
		move_uploaded_file($from, $output_png);
		$this->PNG2JPG($output_png, $output_jpg);
		unlink($output_png);
		
		$w_output = 'upload/trealet-data/'.$user_id.'_'.$tr_id.'_'.$oid.'.jpg';

		$affected = UserToTrealet::insert(
						array(	'user_id' 			=> $user_id,
								'trealet_id_str' 	=> $tr_id,
								'no_in_json'	 	=> $nij,
								'type'				=> $type,
								'data'				=> $w_output)
					);
		return $affected;
	}
	
	public function picture_upload()
	{
		if(!auth()->check()) return false;
		
		if(!request()->hasFile('picture_file')) return "No picture file uploaded";
		$file = request()->file('picture_file');
		
		$filename = $file->getClientOriginalName();
		$realpath = $file->getRealPath();
	
		list($user_id, $tr_id, $nij, $name) = sscanf($filename, '%d %s %d %s');

		$this->delete_prev($user_id, $tr_id,'picture');

		if($this->insert_new_picture($realpath, $user_id, $tr_id, $nij))
			return 'Done';
		
		return "Có lỗi";
	}
	
	public function picture()
	{
		// if(!auth()->check())
		// 	return "Bạn phải đăng nhập để sử dụng chức năng này";
		
		$trealet_id = request()->get('tr_id');
		$nij 		= request()->get('nij');
		$user_id	= auth()->id();

		return view('trealets.input-picture', compact('user_id','trealet_id','nij'));
	}
	
	function form_upload()
	{
		$data = request()->post('data');
		$d = json_decode($data, true);	
		if(!$d) return 'Error on post data: '.$data;
		
		
		if(!$d['user_id']){
			$user_id = -1;
		}
		else{
			$user_id = $d['user_id'];
		}
		$tr_id = $d['trealet_id'];
		$nij = $d['nij'];
		
		unset($d['user_id']);
		unset($d['trealet_id']);
		unset($d['nij']);

		//$data = json_encode($d);
		
		$affected = UserToTrealet::where([['user_id','=',$user_id],
										  ['trealet_id_str','=',$tr_id],
										  ['type','=','form']])->delete();
		
		$affected = UserToTrealet::insert(
									array(	'user_id' 			=> $user_id,
											'trealet_id_str' 	=> $tr_id,
											'no_in_json'	 	=> $nij,
											'type'				=> 'form',
											'data'				=> $data)
									);

		if($affected) return "Đã cập nhật";
		
		return "Có lỗi";	
	}
	
	public function form()
	{
		// if(!auth()->check())
		// 	return "Bạn phải đăng nhập để sử dụng chức năng này";
		
		$trealet_id = request()->get('tr_id');
		$nij 		= request()->get('nij');
		$user_id	= auth()->id();
		
		return view('trealets.input-form', compact('user_id','trealet_id','nij'));
	}
	
	function qr_upload()
	{
		$data = request()->post('data');
		$d = json_decode($data, true);	
		if(!$d) return 'Error on post data: '.$data;
		
		$user_id = $d['user_id'];
		$tr_id = $d['trealet_id'];
		$nij = $d['nij'];
		
		unset($d['user_id']);
		unset($d['trealet_id']);
		unset($d['nij']);

		//$data = json_encode($d);
		
		
		$affected = UserToTrealet::where([['user_id','=',$user_id],
										  ['trealet_id_str','=',$tr_id],
										  ['type','=','qr']])->delete();
		
		$affected = UserToTrealet::insert(
									array(	'user_id' 			=> $user_id,
											'trealet_id_str' 	=> $tr_id,
											'no_in_json'	 	=> $nij,
											'type'				=> 'qr',
											'data'				=> $data)
									);
		
		if($affected) return "Đã cập nhật";
		
		return "Có lỗi";
	}
	
	public function qr()
	{
        $out =  new ConsoleOutput();
        $out->writeln("this");
        $out->writeln(request()->get('tr_id'));
        $user_id	= auth()->id();
        if(request()->get('tr_id')) {
            // if (!auth()->check()){
            // return "Bạn phải đăng nhập để sử dụng chức năng này";
            // }
		$trealet_id = request()->get('tr_id');
		$nij 		= request()->get('nij');

        }
        else{
            $trealet_id = 1;
            $nij 		= 0;
        }
        return view('trealets.input-qr', compact('user_id','trealet_id','nij'));
	}
}
