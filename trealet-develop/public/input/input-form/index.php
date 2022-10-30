<?php
require_once __DIR__ . '/../../audiences/extra/auth.php';

if (! Auth::check()) {
	echo 'Bạn phải đăng nhập để sử dụng mục này';
	exit;
}

$user = Auth::user();

$user_id = $user->id;

if(!isset($_GET['tr_id']) || !isset($_GET['nij'])) {
	echo 'Có lỗi xảy ra';
	exit;
}

$jsonform = 'comment.json';
$trealet_id = $_GET['tr_id'];
$nij = $_GET['nij'];

$full_path = 'https://trealet.com/trealet-schema/input-form/forms/'.$jsonform;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" type="text/css" href="deps/opt/bootstrap.css" />
</head>
<body>
  <form name='bio'></form>
  <script type="text/javascript" src="deps/jquery.min.js"></script>
  <script type="text/javascript" src="deps/underscore.js"></script>
  <script type="text/javascript" src="deps/opt/jsv.js"></script>
  <script type="text/javascript" src="lib/jsonform.js"></script>
  <div id="res" class="alert"></div>
  <script type="text/javascript">
	function loadJSON(path, success, error) {
	  var xhr = new XMLHttpRequest();
	  xhr.onreadystatechange = function () {
		if (xhr.readyState === 4) {
		  if (xhr.status === 200) {
			success(JSON.parse(xhr.responseText));
		  }
		  else {
			error(xhr);
		  }
		}
	  };
	  xhr.open('GET', path, true);
	  xhr.send();
	}
	
	function getObjects(obj, key, val) {
		var objects = [];
		for (var i in obj) {
			if(i==key) objects.push(obj[i]);
			
			if (!obj.hasOwnProperty(i)) continue;
			if (typeof obj[i] == 'object') {
				objects = objects.concat(getObjects(obj[i], key, val));    
			}
		}
		return objects;
	}
	
	function updateField(form,obj_str,val){
		objs = getObjects(form,obj_str);
		if(objs[0]) objs[0].default = val;
	}

	function LaunchApp(data){	
		submit= {
			  onSubmit: function (errors, values) {
				if (errors) {
				  $('#res').html('<p>Errors in input form?</p>');
				} else {
				  onFormSubmit(values);
				}
			  }
			};
		
		updateField(data,'select','Python');		
		
		submit.schema = data.schema;
		submit.form   = data.form;
		$('form').jsonForm(submit);
	}
	
	function onFormSubmit(values){
		values.user_id= <?php 
			if($user_id == ""){
				echo -1;
			}
			else{
				echo $user_id;
			}
			?>;
		values.trealet_id = '<?php echo $trealet_id;?>';
		values.nij 		  = <?php echo $nij;?>;
		
		var http = new XMLHttpRequest();
		http.open("POST", "update.php", true);
		http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		var params = 'data=' + encodeURIComponent(JSON.stringify(values));
		http.send(params);
		http.onload = function() {
			//$('#res').html('<p>' + http.responseText + '</p>');
			alert(http.responseText);
		}	
	}	

	loadJSON('<?php echo $full_path;?>',LaunchApp);
  </script>
</body>
</html>