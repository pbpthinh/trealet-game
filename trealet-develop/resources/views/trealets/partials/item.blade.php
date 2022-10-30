
@if (isset($item['url_full']))
	<?php
	$title 	  = isset($item['title'])?$item['title']:'';;
	$desc	  = isset($item['desc'])?$item['desc']:'';
	$url_full = isset($item['url_full'])?$item['url_full']:'';
	$path     = isset($item['path'])?$item['path']:'';

	$vobj	  = '';

	//Supported format APP, FLA, FLV, GIF, GLB, HTM, HTML, JPEG, JPG, M4A, M4V, MP3, MP4, PDF, PNG, PPS, PPT, TIF, TIFF, TXT

	$ext = strtoupper(pathinfo($url_full, PATHINFO_EXTENSION));

	//items
	if($ext=='GIF' || $ext=='JPEG'|| $ext=='JPG'|| $ext=='PNG'|| $ext=='TIF'|| $ext=='TIFF'){
		$vobj .= '<center><img src="https://hcloud.trealet.com'.$url_full.'" style="max-width:90%;"></center>';
	}

	//Text
	if($ext=='TXT'){
		$vobj .= file_get_contents('https://hcloud.trealet.com'.$url_full); //For embedded video
	}

	//Youtube
	if($ext=="YTB"){
		$vid = file_get_contents('https://hcloud.trealet.com'.$url_full);
		$vobj .= '<div style="position: relative; width: 90%; height: 0; padding-bottom: 50%;">';
		$vobj .= '<iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" src="https://www.youtube.com/embed/'.$vid.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
		$vobj .= '</div>';
	}

	//GLB for 3D
	if($ext=='GLB'){
		$vobj .= '<div style="position: relative; width: 90%; height: 0; padding-bottom: 50%;">';
		$vobj .= '<iframe src="https://hcloud.trealet.com/h3r/embed/?glb='.$url_full.'" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe>';
		$vobj .= '</div>';
		$vobj = '<center>'.$vobj.'</center>';
	}

	//Audio MP3
	if($ext=='MP3'){
		$vobj = '<audio controls><source src="'.$url_full.'" type="audio/mpeg">Your browser does not support the audio tag.</audio>';
	}

	//Video MP4
	if($ext=='MP4'){
		$vobj = '<video width="90%" height="auto" controls><source src="'.$url_full.'" type="video/mp4">Your browser does not support the video tag.</video>';
	}
	?>
	<div class="card">
		<h4 class="card-header">{{ $title }}</h4>
		<div class="card-body">{!! $vobj !!}<p>{!! $desc !!}</p></div>
	</div>
@elseif (isset($item['input']) && isset($item['input']['type']))
	<?php
	$type 	  = $item['input']['type'];
	$title 	  = isset($item['input']['label'])?$item['input']['label']:'';
	$desc	  = isset($item['input']['desc'])?$item['input']['desc']:'';
	$vobj 	  = '';

	if($type=='picture'){
		$vobj = '<iframe style="position: relative; width: 90%;" src="/input-picture?tr_id='.$trealet_id.'&nij='.$nij.'" title="'.$title.'" frameborder="0" allow="camera" onload="this.style.height=(this.contentWindow.document.body.scrollHeight+200)+\'px\';"></iframe>';
	}else if($type=='audio'){
		$vobj = '<iframe style="position: relative; width: 100%;" src="/input-audio?tr_id='.$trealet_id.'&nij='.$nij.'"title="'.$title.'" frameborder="0" allow="microphone" onload="this.style.height=(this.contentWindow.document.body.scrollHeight+100)+\'px\';"></iframe>';
	}else if($type=='form'){
		$vobj = '<iframe style="position: relative; width: 90%;" src="/input-form?tr_id='.$trealet_id.'&nij='.$nij.'" title="Input data from a form" frameborder="0" onload="this.style.height=(this.contentWindow.document.body.scrollHeight+250)+\'px\';"></iframe>';
	}else if($type=='qr'){
		$vobj 	 .= '<iframe style="position: relative; width: 90%;" src="/input-qr?tr_id='.$trealet_id.'&nij='.$nij.'" title="Scan QR code from camera" frameborder="0" allow="camera" onload="this.style.height=(this.contentWindow.document.body.scrollHeight+200)+\'px\';"></iframe>';
	}
	?>
	<div class="card">
		<h4 class="card-header">{{ $title }}</h4>
		<div class="card-body">{!! $vobj !!}<p>{!! $desc !!}</p></div>
	</div>


@elseif (isset($item['picture']) && isset($item['picture']['type']))
	<?php
	$type 	  = $item['picture']['type'];
	$title 	  = $item['picture']['picture_title'] ?? '';
	$desc	  = $item['picture']['description_image'] ?? '';
	$src      = $item['picture']['picture_src'] ?? '';
	$vobj 	  = '<img style="position: relative; width: 90%;" src=/'.$src.'>';
?>

	<div class="card">
		<h4 class="card-header">{{ $title }}</h4>
		<div class="card-body"  ><div style="text-align: center;">{!! $vobj !!}</div><br><p style="padding: 20px">{!! $desc !!}</p></div>
	</div>
@elseif (isset($item['video']) && isset($item['video']['type']))
	<?php
	$type 	  = $item['video']['type'];
	$title 	  = $item['video']['video_title'] ?? '';
	$desc	  = $item['video']['description_video'] ?? '';
	$src      = $item['video']['video_src'] ?? '';
	$vobj 	  = '<video controls style="position: relative; width: 90%;"><source type="video/mp4" src='.$src.'></video>';
	?>

	<div class="card">
		<h4 class="card-header">{{ $title }}</h4>
		<div class="card-body"  ><div style="text-align: center;">{!! $vobj !!}</div><br><p style="padding: 20px">{!! $desc !!}</p></div>
	</div>

@elseif (isset($item['audio']) && isset($item['audio']['type']))
	<?php
	$type 	  = $item['audio']['type'];
	$title 	  = $item['audio']['audio_title'] ?? '';
	$desc	  = $item['audio']['description_audio'] ?? '';
	$src      = $item['audio']['audio_src'] ?? '';
	$vobj 	  = '<audio controls style="position: relative; width: 90%;"><source  src=/'.$src.'></audio>';
	?>

	<div class="card">
		<h4 class="card-header">{{ $title }}</h4>
		<div class="card-body"  ><div style="text-align: center;">{!! $vobj !!}</div><br><p style="padding: 20px">{!! $desc !!}</p></div>
	</div>
@endif