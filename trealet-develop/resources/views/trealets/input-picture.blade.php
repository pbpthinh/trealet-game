<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Take a picture</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="icon" href="data:;base64,iVBORw0KGgo=">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>  
    <script src="assets/input-picture/webcam-easy.min.js"></script>
</head>
<style>
#webcam-app {
  background-position: center center;
  background-repeat: no-repeat;
  background-size: cover;
  background-color: white;
  width: 100vw;
  height: 100vh;
}

.webcam-container{
    height: 100vh;
    width: 100vw;
    background-color: black;
}

#background-container {
    height: 100vh;
    width: 100vw;
}

@media screen and (min-width: 768px) {
    .webcam-container {
        background-attachment: fixed;
    }
 }

.form-control.webcam-start{
    position: relative;
    background: black;
    opacity: 0.5;
    padding: 10px 20px;
    border: none;
    color: white;
    text-shadow: 1px 1px #000;
    font-size: 1.2rem;
    width: 350px;
    height: 55px;
    z-index: 9999;
    top: 0;
    left: 0;
    right: 0;
    margin: auto;
}

.form-control.webcam-on {
  position: fixed;
  top: 0vh;
  bottom: auto;
  left: 0px;
  right: auto;
  transition: all 100ms;
  width: 110px!important;
}
.form-control.webcam-off {
    transition: all 100ms;
}
  

  .form-switch {
    display: inline-block;
    cursor: pointer;
    -webkit-tap-highlight-color: transparent;
  }
  
  .form-switch i {
    position: relative;
    display: inline-block;
    margin-right: .5rem;
    width: 60px;
    height: 30px;
    background-color: #e6e6e6;
    border-radius: 25px;
    vertical-align: text-bottom;
    transition: all 0.3s linear;
  }
  
  .form-switch i::before {
    content: "";
    position: absolute;
    left: 0;
    width: 56px;
    height: 25px;
    background-color: #fff;
    border-radius: 15px;
    transform: translate3d(2px, 2px, 0) scale3d(1, 1, 1);
    transition: all 0.25s linear;
  }
  
  .form-switch i::after {
    content: "";
    position: absolute;
    left: 0;
    width: 26px;
    height: 26px;
    background-color: #fff;
    border: 1px solid grey;
    border-radius: 15px;
    box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.25);
    transform: translate3d(2px, 2px, 0);
    transition: all 0.2s ease-in-out;
  }
  
  .form-switch:active i::after {
    width: 60px;
    transform: translate3d(2px, 2px, 0);
  }
  
  .form-switch:active input:checked + i::after { transform: translate3d(16px, 2px, 0); }
  
  .form-switch input { display: none; }
  
  .form-switch input:checked + i { background-color: #4BD763; }
  
  .form-switch input:checked + i::before { transform: translate3d(18px, 2px, 0) scale3d(0, 0, 0); }
  
  .form-switch input:checked + i::after { transform: translate3d(30px, 2px, 0); }

  .form-switch input:disabled + i { background-color: #eeeeee; cursor: not-allowed; }

  .form-switch input:disabled + i::after {
    box-shadow: 0 2px 2px rgba(0, 0, 0, 0.10);
  }


  .app-panel{
    height: 100vh;
    width: 100vw;
    text-align: center;
    background-color: black;
  }

  #webcam{
    display: block;
    position: relative;
    width: auto;
    height: 100vh;
    z-index: 999;
    pointer-events: none;
    margin: auto;
  }

  .md-modal {
    margin: auto;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      width: 100vw;
      height: 100vh;
      z-index: 2000;
      visibility: hidden;
      -webkit-backface-visibility: hidden;
      -moz-backface-visibility: hidden;
      backface-visibility: hidden;
  }
  
  .md-show {
      visibility: visible;
  }
  
  .md-overlay {
      position: fixed;
      width: 100%;
      height: 100%;
      visibility: hidden;
      top: 0;
      left: 0;
      z-index: 1000;
      opacity: 0;
      background: rgba(#e4f0e3, 0.8);
      -webkit-transition: all 0.3s;
      -moz-transition: all 0.3s;
      transition: all 0.3s;
  }
  
  .md-show ~ .md-overlay {
      opacity: 1;
      visibility: visible;
  }
  
  .md-effect-12 .md-content {
      -webkit-transform: scale(0.8);
      -moz-transform: scale(0.8);
      -ms-transform: scale(0.8);
      transform: scale(0.8);
      opacity: 0;
      -webkit-transition: all 0.3s;
      -moz-transition: all 0.3s;
      transition: all 0.3s;
  }
  
  .md-show.md-effect-12 ~ .md-overlay {
      background-color: #e4f0e3;
  } 
  
  .md-effect-12 .md-content h3,
  .md-effect-12 .md-content {
      background: transparent;
  }
  
  .md-show.md-effect-12 .md-content {
      -webkit-transform: scale(1);
      -moz-transform: scale(1);
      -ms-transform: scale(1);
      transform: scale(1);
      opacity: 1;
  }

 #errorMsg {
     position: fixed;
     top: 22vh;
     left: 0;
     padding: 20px;
     z-index: 999999;
 }

 @media screen and (min-width: 768px) {
    #errorMsg {
        position: fixed;
        top: 32vh;
        left: 20vw;
        padding: 20px;
        z-index: 999999;
    }
 }

 #cameraFlip {
  width: 70px;
    height: 55px;
    margin-left: 40px;
    margin-top: -10px;
    position: absolute;
    cursor: pointer;
    background-color: black;
    background-position: center center;
    background-repeat: no-repeat;
    background-image: url(images//camera_flip_white.png);
    background-size: cover;
}

.cameraControls {
  position: absolute;
  bottom: 10vh;
  width: 100%;
  z-index: 99999;
  background: transparent;
  opacity: 0.3;
  padding: 0px;
  left: 0;
}


.material-icons{
  width: 100px;
  font-size: 50px !important;
  color: white;
  width: 80px;
  height: 80px;
  background-color: black;
  border-radius: 50%;
  padding-top: 15px;
  margin: 0 10px;
}

.flash{ 
  position:fixed; 
  top:0;
  left:0;
  width:100%;
  height:100%;
  background-color:#fff;
  z-index: 999999;
}

#canvas{
  background-color: transparent;
  position: absolute;
  width: auto;
  height: 100vh;
  z-index: 9999;
  margin: auto;
  top: 0;
  left: 0;
  right: 0;
  margin-left: auto;
  margin-right: auto;
}

@media screen and (max-width: 420px) {
  .form-control.webcam-start{
    width: 250px;
  }
}

@media screen and (max-width: 767px) {
  .cameraControls {
    bottom: 0vh;
  }
}

@media screen and (min-width: 420px) and (max-width: 767px) {
  .form-control.webcam-on {
    top: 0vh;
    left: 0;
  }
}

@media screen and (min-width: 1024px) {
  .form-control.webcam-on {
    top: 16vh;
    left: 8vw;
  }
}
</style>
<body>
    <main id="webcam-app">
        <div class="form-control webcam-start" id="webcam-control">
                <label class="form-switch">
                <input type="checkbox" id="webcam-switch">
                <i></i> 
                <span id="webcam-caption">Turn camera on</span>
                </label>      
                <button id="cameraFlip" class="btn d-none"></button>                  
        </div>
        
        <div id="errorMsg" class="col-12 col-md-6 alert-danger d-none">
            Fail to start camera, please allow permision to access camera. <br/>
            If you are browsing through social media built in browsers, you would need to open the page in Sarafi (iPhone)/ Chrome (Android)
            <button id="closeError" class="btn btn-primary ml-3">OK</button>
        </div>
        <div class="md-modal md-effect-12">
            <div id="app-panel" class="app-panel md-content row p-0 m-0">     
                <div id="webcam-container" class="webcam-container col-12 d-none p-0 m-0">
                    <video id="webcam" autoplay playsinline width="640" height="480"></video>
                    <canvas id="canvas" class="d-none"></canvas>
                    <div class="flash"></div>
                    <audio id="snapSound" src="assets/input-picture/snap.wav" preload = "auto"></audio>
                </div>
                <div id="cameraControls" class="cameraControls">
                    <!--<a href="#" id="exit-app" title="Exit App" class="d-none"><i class="material-icons">exit_to_app</i></a>-->
                    <a id="take-photo" title="Take Photo"><i class="material-icons">camera_alt</i></a>
                    <!--<a href="#" id="download-photo" download="selfie.png" target="_blank" title="Save Photo" class="d-none"><i class="material-icons">file_download</i></a>-->
					<a id="upload-photo" title="Upload Photo" class="d-none"><i class="material-icons" style="color:white">upload</i></a>  
                    <a id="resume-camera"  title="Resume Camera" class="d-none"><i class="material-icons">camera_front</i></a>
                </div>
            </div>        
        </div>
        <div class="md-overlay"></div>
    </main>
    <script>
const webcamElement = document.getElementById('webcam');

const canvasElement = document.getElementById('canvas');

const snapSoundElement = document.getElementById('snapSound');

const webcam = new Webcam(webcamElement, 'user', canvasElement, snapSoundElement);

$("#webcam-switch").change(function () {
    if(this.checked){
        $('.md-modal').addClass('md-show');
        webcam.start()
            .then(result =>{
               cameraStarted();
               console.log("webcam started");
            })
            .catch(err => {
                displayError();
            });
    }
    else {        
        cameraStopped();
        webcam.stop();
        console.log("webcam stopped");
    }        
});

$('#cameraFlip').click(function() {
    webcam.flip();
    webcam.start();  
});

$('#closeError').click(function() {
    $("#webcam-switch").prop('checked', false).change();
});

function displayError(err = ''){
    if(err!=''){
        $("#errorMsg").html(err);
    }
    $("#errorMsg").removeClass("d-none");
}

function cameraStarted(){
    $("#errorMsg").addClass("d-none");
    $('.flash').hide();
    $("#webcam-caption").html("");
    $("#webcam-control").removeClass("webcam-off");
    $("#webcam-control").addClass("webcam-on");
    $(".webcam-container").removeClass("d-none");
    if( webcam.webcamList.length > 1){
        $("#cameraFlip").removeClass('d-none');
    }
    $("#wpfront-scroll-top-container").addClass("d-none");
    window.scrollTo(0, 0); 
    $('body').css('overflow-y','hidden');
}

function cameraStopped(){
    $("#errorMsg").addClass("d-none");
    $("#wpfront-scroll-top-container").removeClass("d-none");
    $("#webcam-control").removeClass("webcam-on");
    $("#webcam-control").addClass("webcam-off");
    $("#cameraFlip").addClass('d-none');
    $(".webcam-container").addClass("d-none");
    $("#webcam-caption").html("Turn camera on");
    $('.md-modal').removeClass('md-show');
}

var captured_pic=null;
var uploaded_pic=false;

$("#take-photo").click(function () {
    beforeTakePhoto();
    let picture = webcam.snap();
    //document.querySelector('#download-photo').href = picture;
	captured_pic = picture;
    afterTakePhoto();
});

function b64toBlob(b64Data, contentType, sliceSize) {
	contentType = contentType || '';
	sliceSize = sliceSize || 512;

	var byteCharacters = atob(b64Data);
	var byteArrays = [];

	for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
		var slice = byteCharacters.slice(offset, offset + sliceSize);

		var byteNumbers = new Array(slice.length);
		for (var i = 0; i < slice.length; i++) {
			byteNumbers[i] = slice.charCodeAt(i);
		}

		var byteArray = new Uint8Array(byteNumbers);

		byteArrays.push(byteArray);
	}

	var blob = new Blob(byteArrays, {type: contentType});
	return blob;
}


$("#upload-photo").click(function () {
	//var pic = document.querySelector('#download-photo').href;
	if(!captured_pic) return;
	
	if(uploaded_pic){
		alert('Your picture has uploaded');
		return;
	}
	
	pic = captured_pic;
	var block = pic.split(";");
	var contentType = block[0].split(":")[1];
	var realData = block[1].split(",")[1];

	var pic_blob = b64toBlob(realData, contentType);
	
	var filename = new Date().toISOString();
	filename = '<?php echo $user_id;?>' + ' ' + '<?php echo $trealet_id;?>' + ' ' + '<?php echo $nij;?>' + ' ' + filename;
	
    var formData = new FormData();
	formData.append('picture_file', pic_blob, filename);
	formData.append("_token",'{{ csrf_token() }}');

	$.ajax({
		   url : 'input-picture/upload',
		   type : 'POST',
		   data : formData,
		   processData: false,  // tell jQuery not to process the data
		   contentType: false,  // tell jQuery not to set contentType
		   success : function(data) {
			   uploaded_pic = true;
			   $('#upload-photo').html('<i class="material-icons" style="color:blue">done</i>');
			   localStorage.setItem("current", 1)
         alert('Done');
		   }
	});
});

function beforeTakePhoto(){
    $('.flash')
        .show() 
        .animate({opacity: 0.3}, 500) 
        .fadeOut(500)
        .css({'opacity': 0.7});
    window.scrollTo(0, 0); 
    $('#webcam-control').addClass('d-none');
    $('#cameraControls').addClass('d-none');
}

function afterTakePhoto(){
    webcam.stop();
    $('#canvas').removeClass('d-none');
    $('#take-photo').addClass('d-none');
    //$('#exit-app').removeClass('d-none');
    //$('#download-photo').removeClass('d-none');
	$('#upload-photo').removeClass('d-none');
    $('#resume-camera').removeClass('d-none');
    $('#cameraControls').removeClass('d-none');
}

function removeCapture(){
    $('#canvas').addClass('d-none');
    $('#webcam-control').removeClass('d-none');
    $('#cameraControls').removeClass('d-none');
    $('#take-photo').removeClass('d-none');
    //$('#exit-app').addClass('d-none');
    //$('#download-photo').addClass('d-none');
	$('#upload-photo').addClass('d-none');
    $('#resume-camera').addClass('d-none');
}

$("#resume-camera").click(function () {
	uploaded_pic = false;
	$('#upload-photo').html('<i class="material-icons" style="color:white">upload</i>');
    webcam.stream()
        .then(facingMode =>{
            removeCapture();
        });
});

//$("#exit-app").click(function () {
//    removeCapture();
//    $("#webcam-switch").prop("checked", false).change();
//});	
	</script>
</body>
</html>