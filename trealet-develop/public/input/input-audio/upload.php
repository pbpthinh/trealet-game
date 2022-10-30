<?php


include '../lib/db.php';

// require_once __DIR__ . '/../../audiences/extra/auth.php';
// if (! Auth::check()) exit;

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
	echo 'No audio file uploaded';
	exit;
}

$size = $_FILES['audio_data']['size']; //the size in bytes
$input = $_FILES['audio_data']['tmp_name']; //temporary name that PHP gave to the uploaded file
$output = $_FILES['audio_data']['name'].".mp3";

//Extract user_id and tr_id from input filename
list($user_id, $tr_id, $nij, $name) = sscanf($output, '%d %s %d %s');



//Delete all the previous upload files
$sql = 'SELECT * FROM au_user_to_trealet WHERE user_id='.$user_id.' AND trealet_id_str="'.$tr_id.'" AND type="audio"';
$trealets = $db->query($sql)->fetchAll();
foreach ($trealets as $tr) {
	$w_output = $_SERVER['DOCUMENT_ROOT'].$tr['data'];
	unlink($w_output);
}
$sql = 'DELETE FROM au_user_to_trealet WHERE user_id='.$user_id.' AND trealet_id_str="'.$tr_id.'" AND type="audio"';
$db->query($sql);

//Create ouput file name, move the file and insert into table
$oid = uniqid();
$output = $_SERVER['DOCUMENT_ROOT'].'uploaded/'.$user_id.'_'.$tr_id.'_'.$oid.'.mp3';
$w_output = 'uploaded/'.$user_id.'_'.$tr_id.'_'.$oid.'.mp3';

move_uploaded_file($input, $output);
$sql = 'INSERT INTO au_user_to_trealet (user_id, trealet_id_str, no_in_json, type, data) VALUES ('.$user_id.', "'.$tr_id.'",'.$nij.',"audio","'.$w_output.'")';
if(!$db->query($sql)){
	echo 'Lỗi dữ liệu';
}
else{
	echo 'Done';
}

$db->close();
?>