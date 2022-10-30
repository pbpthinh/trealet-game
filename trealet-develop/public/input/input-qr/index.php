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

$trealet_id = $_GET['tr_id'];
$nij = $_GET['nij'];
?>
<!DOCTYPE html>
<html>
  <head>
    <title>QR Code Scanner</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
    <link rel="stylesheet" href="styles.css" />
	<link rel="stylesheet" type="text/css" href="deps/opt/bootstrap.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="qr_packed.js"></script>
  </head>

  <body>
    <div id="container" style="text-align:center">
      <a id="btn-scan-qr">
        <img src="scanme.png">
      </a>
      
	  <canvas hidden="" id="qr-canvas"></canvas>
	  <input type="submit" class="btn btn-primary" id="btn-scan-qr-stop" value="Stop" style="visibility:hidden">

      <div id="qr-result" hidden="">
	  <div><input type='text' id='outputD' readonly> <input type="submit" class="btn btn-primary" id="btn-submit" value="Submit"></div>
      </div>
    </div>

    <script>
const video = document.createElement("video");
const canvasElement = document.getElementById("qr-canvas");
const canvas = canvasElement.getContext("2d");

const qrResult = document.getElementById("qr-result");
const outputData = document.getElementById("outputData");
const outputD = document.getElementById("outputD");
const btnScanQR = document.getElementById("btn-scan-qr");
const btnStopScan = document.getElementById("btn-scan-qr-stop");
const btnSubmit = document.getElementById("btn-submit");

let scanning = false;

qrcode.callback = res => {
  if (res) {
	outputD.value = res;
    scanning = false;

    video.srcObject.getTracks().forEach(track => {
      track.stop();
    });

    qrResult.hidden = false;
    canvasElement.hidden = true;
    btnScanQR.hidden = false;
	btnStopScan.style.visibility="hidden";
  }
};

btnScanQR.onclick = () => {
  navigator.mediaDevices
    .getUserMedia({ video: { facingMode: "environment" } })
    .then(function(stream) {
      scanning = true;
      qrResult.hidden = true;
      btnScanQR.hidden = true;
      canvasElement.hidden = false;
	  btnStopScan.style.visibility="visible";
      video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
      video.srcObject = stream;
      video.play();
      tick();
      scan();
    });
};

btnStopScan.onclick = () => {
	if(scanning){
		scanning = false;
		video.srcObject.getTracks().forEach(track => {
		  track.stop();
		});
		qrResult.hidden = true;
		canvasElement.hidden = true;
		btnScanQR.hidden = false;
		btnStopScan.style.visibility="hidden";
	}
};

btnSubmit.onclick = () => {
	var values		  = {};
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
	values.scanneddata= encodeURIComponent(outputD.value);
	
	var http = new XMLHttpRequest();
	http.open("POST", "update.php", true);
	http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	var params = 'data=' + JSON.stringify(values);		
	http.send(params);
	http.onload = function() {
		//$('#res').html('<p>' + http.responseText + '</p>');
		//btnSubmit.innerText = http.responseText;
		//console.log(http.responseText);
		alert(http.responseText);
	}
};

function tick() {
  canvasElement.height = video.videoHeight;
  canvasElement.width = video.videoWidth;
  canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);

  scanning && requestAnimationFrame(tick);
}

function scan() {
  try {
    qrcode.decode();
  } catch (e) {
    setTimeout(scan, 300);
  }
}
	</script>
  </body>
</html>
