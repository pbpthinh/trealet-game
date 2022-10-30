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
	<meta charset="UTF-8">

	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Latest compiled and minified Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<style>
.material-icons{
  width: 100px;
  font-size: 40px !important;
  color: white;
  width: 60px;
  height: 60px;
  background-color: rgb(200, 200, 200);
  border-radius: 50%;
  padding-top: 11px;
  padding-left: 11px;
  margin: 0 2px;
}

.blinking{
    animation:blinkingText 1.2s infinite;
}
@keyframes blinkingText{
    0%		{color: #000000;	}
    50%		{color: #FF0000;  	}
    100%	{color: #000000;	}
}

</style>
<body>
	<div style="max-width: 28em;">
		<div id="controls">
			<!--<button id="recordButton">Record</button>
			<button id="stopButton" disabled>Stop</button>-->
			<a id="recordButton" title="Record"><i id="recordIcon" class="material-icons" style="color:#FF0000">mic</i></a>
			<a id="stopButton" title="Stop"><i id="stopIcon" class="material-icons" style="color:gray">stop_circle</i></a>
			<a id="uploadButton" title="Upload"><i id="uploadIcon" class="material-icons" style="color:gray">upload</i></a>
		</div>
	<ol id="recordingsList"></ol>
	</div>

	<!-- inserting these scripts at the end to be able to use all the elements in the DOM -->
	<script src="js/WebAudioRecorder.min.js"></script>
	<script>
URL = window.URL || window.webkitURL;

var gumStream; 						//stream from getUserMedia()
var recorder; 						//WebAudioRecorder object
var input; 							//MediaStreamAudioSourceNode  we'll be recording
var encodingType; 					//holds selected encoding for resulting audio (file)
var encodeAfterRecord = true;       // when to encode

// shim for AudioContext when it's not avb. 
var AudioContext = window.AudioContext || window.webkitAudioContext;
var audioContext; //new audio context to help us record

var recordButton = document.getElementById("recordButton");
var recordIcon	 = document.getElementById("recordIcon");
var stopButton   = document.getElementById("stopButton");
var stopIcon	 = document.getElementById("stopIcon");
var uploadButton = document.getElementById("uploadButton");
var uploadIcon	 = document.getElementById("uploadIcon");
var isRecording  = false;

//add events to those 2 buttons
recordButton.addEventListener("click", startRecording);
stopButton.addEventListener("click", stopRecording);

function startRecording() {
	if(isRecording) return;
	
	console.log("startRecording() called");    
    var constraints = { audio: true, video:false }

	navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
		__log("getUserMedia() success, stream created, initializing WebAudioRecorder...");

		/*
			create an audio context after getUserMedia is called
			sampleRate might change after getUserMedia is called, like it does on macOS when recording through AirPods
			the sampleRate defaults to the one set in your OS for your playback device

		*/
		audioContext = new AudioContext();

		//update the format 
		//document.getElementById("formats").innerHTML="Format: 2 channel "+encodingTypeSelect.options[encodingTypeSelect.selectedIndex].value+" @ "+audioContext.sampleRate/1000+"kHz"

		//assign to gumStream for later use
		gumStream = stream;
		
		/* use the stream */
		input = audioContext.createMediaStreamSource(stream);		
		
		encodingType = 'mp3';

		recorder = new WebAudioRecorder(input, {
		  workerDir: "js/", // must end with slash
		  encoding: encodingType,
		  numChannels:2, //2 is the default, mp3 encoding supports only 2
		  onEncoderLoading: function(recorder, encoding) {
		    // show "loading encoder..." display
		    __log("Loading "+encoding+" encoder...");
		  },
		  onEncoderLoaded: function(recorder, encoding) {
		    // hide "loading encoder..." display
		    __log(encoding+" encoder loaded");
		  }
		});

		recorder.onComplete = function(recorder, blob) { 
			__log("Encoding complete");
			createDownloadLink(blob,recorder.encoding);
		}

		recorder.setOptions({
		  timeLimit:120,
		  encodeAfterRecord:encodeAfterRecord,
	      ogg: {quality: 0.5},
	      mp3: {bitRate: 160}
	    });

		//start the recording process
		recorder.startRecording();

		 __log("Recording started");

	}).catch(function(err) {
	  	//enable the record button if getUSerMedia() fails
    	recordButton.disabled = false;
    	stopButton.disabled = true;

	});

	//disable the record button
    recordButton.disabled = true;
	recordIcon.classList.add('blinking');
	stopButton.disabled = false;
	stopIcon.style.color = "black";
	uploadButton.disabled = true;
	uploadIcon.innerText = 'upload';
	uploadIcon.style.color = 'gray';
	isRecording = true;
}

function stopRecording() {
	console.log("stopRecording() called");
	
	//stop microphone access
	gumStream.getAudioTracks()[0].stop();

	//disable the stop button
	stopButton.disabled = true;
	stopIcon.style.color = "gray";
	recordButton.disabled = false;
	recordIcon.classList.remove('blinking');
	isRecording = false;
	
	//tell the recorder to finish the recording (stop recording + encode the recorded audio)
	recorder.finishRecording();

	__log('Recording stopped');
}

function createDownloadLink(blob,encoding) {
	
	var url = URL.createObjectURL(blob);
	var au = document.createElement('audio');
	var li = document.createElement('li');


	//add controls to the <audio> element
	au.controls = true;
	au.src = url;
	
	//update upload Icon
	uploadIcon.style.color = "black";
	
	uploadButton.addEventListener("click", function doUpload(event){
		if(uploadIcon.innerText=='done') return;
		
		var filename = new Date().toISOString();
		filename = '<?php echo $user_id;?>' + ' ' + '<?php echo $trealet_id;?>' + ' ' + '<?php echo $nij;?>' + ' ' + filename + '.'+encoding;
		
		var xhr=new XMLHttpRequest();
		var fd=new FormData();
		fd.append("audio_data",blob, filename);
		xhr.open("POST","upload.php",true);
		xhr.send(fd);
		  
		xhr.onload = function() {
			if(xhr.responseText=='Done'){
				uploadIcon.innerText='done';
				uploadIcon.style.color='blue';
				
				//clear click event
				uploadbutton.removeEventListener('click', doUpload);

			}else{
				console.log(xhr.responseText);
			}
		}
	});	
	
	//add the new audio to the li element
	li.appendChild(au);

	//Clear all other previous recordings
	while( recordingsList.firstChild ){
	  recordingsList.removeChild( recordingsList.firstChild );
	}
	//add the li element to the ordered list
	recordingsList.appendChild(li);
}

//helper function
function __log(e, data) {
	//log.innerHTML += "\n" + e + " " + (data || '');
}
	</script>

</body>
</html>