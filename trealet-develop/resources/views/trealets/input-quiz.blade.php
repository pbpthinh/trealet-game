<?php
$jsonquiz = 'answer.json';

$full_path = 'assets/input-quiz/'.$jsonquiz;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <!-- <link rel="stylesheet" type="text/css" href="assets/input-quiz/deps/opt/bootstrap.css" /> -->
</head>
<body>
  
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
	
	
	function onFormSubmit(values){
		console.log("onFormSubmit");
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
		http.open("POST", "input-quiz/upload", true);
		http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		var params = 'data=' + encodeURIComponent(JSON.stringify(values))+'&_token='+'{{ csrf_token() }}';
		http.send(params);
		http.onload = function() {
			window.top.postMessage({ success: true },'*');
		}	
	}	

	loadJSON('<?php echo $full_path;?>',onFormSubmit);
  </script>
</body>
</html>