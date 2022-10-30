<?php

function PNG2JPG($png, $jpg){
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

include '../lib/db.php';
require_once __DIR__ . '/../../audiences/extra/auth.php';
if (! Auth::check()) exit;

$dbhost = 'localhost';
$dbuser = 'khobau_usr';
$dbpass = 'khobauHMI123!@#';
$dbname = 'khobau';

$db = new db($dbhost, $dbuser, $dbpass, $dbname);
if(!$db){
	echo 'Could not connect to database';
	exit;
}

if(!$_FILES){
	echo 'No photo file uploaded';
	exit;
}

$size = $_FILES['picture_file']['size']; //the size in bytes
$input = $_FILES['picture_file']['tmp_name']; //temporary name that PHP gave to the uploaded file
$output = $_FILES['picture_file']['name'].".png"; //letting the client control the filename is a rather bad idea

//Extract user_id and tr_id from input filename
list($user_id, $tr_id, $nij, $name) = sscanf($output, '%d %s %d %s');

//Delete all the previous upload files
$sql = 'SELECT * FROM au_user_to_trealet WHERE user_id='.$user_id.' AND trealet_id_str="'.$tr_id.'" AND type="picture"';
$trealets = $db->query($sql)->fetchAll();
foreach ($trealets as $tr) {
	$w_output = $_SERVER['DOCUMENT_ROOT'].$tr['data'];
	unlink($w_output);
}
$sql = 'DELETE FROM au_user_to_trealet WHERE user_id='.$user_id.' AND trealet_id_str="'.$tr_id.'" AND type="picture"';
$db->query($sql);

$oid = uniqid();
$output = $_SERVER['DOCUMENT_ROOT'].'uploaded/'.$user_id.'_'.$tr_id.'_'.$oid.'.png';
$output_jpg = $_SERVER['DOCUMENT_ROOT'].'uploaded/'.$user_id.'_'.$tr_id.'_'.$oid.'.jpg';
$w_output = 'uploaded/'.$user_id.'_'.$tr_id.'_'.$oid.'.png';
$w_output_jpg = 'uploaded/'.$user_id.'_'.$tr_id.'_'.$oid.'.jpg';

//Move the file to upload folder, convert it to .jpg, delete the .png, and insert the pathinfo to database
move_uploaded_file($input, $output);
PNG2JPG($output, $output_jpg);
unlink($output);
$sql = 'INSERT INTO au_user_to_trealet (user_id, trealet_id_str, no_in_json, type, data) VALUES ('.$user_id.', "'.$tr_id.'",'.$nij.',"picture","'.$w_output_jpg.'")';

if(!$db->query($sql)){
	echo 'Lỗi dữ liệu';
}
else{
	echo 'done';
}
//print_r($_FILES); //this will print out the received name, temp name, type, size, etc.
?>