<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="assets/input-audio/styles.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<style>
.material-icons{
  font-size: 40px !important;
  color: white;
  width: 60px;
  height: 60px;
  background-color: rgb(200, 200, 200);
  border-radius: 50%;
  padding-top: 18px;
  padding-left: 18px;
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
	<div style="max-width: 28em;controls; margin:auto">
		<div id="controls" style="display: flex;justify-content: space-around; margin-left: 10px">
			<a id="recordButton" title="Record"><i id="recordIcon" class="material-icons" style="color:#FF0000;margin: auto">mic</i></a>
			<a id="stopButton" title="Stop"><i id="stopIcon" class="material-icons" style="color:gray;margin: auto">stop_circle</i></a>
			<a id="uploadButton" title="Upload"><i id="uploadIcon" class="material-icons" style="color:gray;margin: auto">upload</i></a>
		</div>
		<div style="margin-left: -30px">
			<ol id="recordingsList"></ol>
		</div>
	</div>

	<!-- inserting these scripts at the end to be able to use all the elements in the DOM -->
	<script src="assets/input-audio/WebAudioRecorder.min.js"></script>
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
		  workerDir: "assets/input-audio/", // must end with slash
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
		fd.append("_token",'{{ csrf_token() }}');
		xhr.open("POST","input-audio/upload",true);
		xhr.send(fd);
		  
		xhr.onload = function() {
			if(xhr.responseText=='Done'){
				uploadIcon.innerText='done';
				uploadIcon.style.color='blue';
				window.top.postMessage({ success: true },'*');

				//clear click event
				uploadbutton.removeEventListener('click', doUpload);
				alert('Done');

			}else{
				// console.log(xhr.responseText);
				//document.body.innerHTML = xhr.responseText;
				window.top.postMessage({ success: true },'*');

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