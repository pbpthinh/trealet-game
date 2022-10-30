<!DOCTYPE html>
<html>
  <head>
    <title>QR Code Scanner</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="assets/input-qr/styles.css" />
	<link rel="stylesheet" type="text/css" href="assets/input-qr/deps/opt/bootstrap.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="assets/input-qr/qr_packed.js"></script>
  </head>

  <body>
    <div id="container" style="text-align:center">
      <a id="btn-scan-qr">
        <img src="assets/input-qr/scanme.png">
      </a>
	  <canvas hidden="" id="qr-canvas" style="margin-left: 10px"></canvas>
    <br/>
	  <input type="submit" class="btn btn-primary" id="btn-scan-qr-stop" value="Stop" style="visibility:hidden">
      <div id="qr-result" hidden="" style="margin-top: -70px">
	  <div>
      <input type='text' id='outputD' readonly> 
      <input type="submit" class="btn btn-primary" id="btn-submit" value="Submit">
    </div>
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
	http.open("POST", "input-qr/upload", true);
	http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	var params = 'data=' + JSON.stringify(values)+'&_token='+'{{ csrf_token() }}';
	http.send(params);
	http.onload = function() {
		//$('#res').html('<p>' + http.responseText + '</p>');
		//btnSubmit.innerText = http.responseText;
		//console.log(http.responseText);
    window.top.postMessage({ success: true },'*');
		alert("Done");
    localStorage.setItem("current", values.scanneddata)
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
