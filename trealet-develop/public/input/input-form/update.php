<?php
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

$data = $_POST['data'];

$d = json_decode($data, true);	
if(!$d){
	echo 'Error on post data';
	exit;
}

$user_id = $d['user_id'];
$tr_id = $d['trealet_id'];
$nij = $d['nij'];

unset($d['user_id']);
unset($d['trealet_id']);
unset($d['nij']);

//$data = json_encode($d);

$sql = 'DELETE FROM au_user_to_trealet WHERE user_id='.$user_id.' AND trealet_id_str="'.$tr_id.'" AND type="form"';
$db->query($sql);

$sql = 'INSERT INTO au_user_to_trealet (user_id, trealet_id_str, no_in_json, type, data) VALUES ('.$user_id.', "'.$tr_id.'",'.$nij.',"form","'.addslashes($data).'")';
if(!$db->query($sql)){
	echo 'Lỗi dữ liệu';
}
else{
	echo 'Đã cập nhật';
}
?>