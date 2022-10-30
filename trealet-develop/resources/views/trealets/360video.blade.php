<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>360 Trealet - Trealet - Knowledge</title>
  <script src="https://aframe.io/releases/0.6.0/aframe.min.js"></script>
  <script src="https://unpkg.com/aframe-animation-component/dist/aframe-animation-component.min.js"></script>
  <script src="https://rawgit.com/mayognaise/aframe-mouse-cursor-component/master/dist/aframe-mouse-cursor-component.min.js"></script>
  <script src="https://rawgit.com/feiss/aframe-environment-component/master/dist/aframe-environment-component.min.js"></script>

  <style type="text/css">
    #video-permission {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: white;
      z-index: 10000;
      display: none;
    }

    #video-permission-button {
      position: fixed;
      top: calc(50% - 1em);
      left: calc(50% - 60px);
      width: 120px;
      height: 2em;
    }
  </style>
</head>

<body>
  <div id="video-permission">
    <button id="video-permission-button">Allow VR video</button>
  </div>

  <a-scene>
    <!--Night mode: #0c192a-->

    <a-assets>
      <img src="{{ url('../assets/img/360/360_icon/play.png') }}" id="play" crossorigin="anonymous" />
      <img src="{{ url('../assets/img/360/360_icon/pause.png') }}" id="pause" crossorigin="anonymous" />
      <img src="{{ url('../assets/img/360/360_icon/volume-normal.png') }}" id="volume-normal" crossorigin="anonymous" />
      <img src="{{ url('../assets/img/360/360_icon/volume-mute.png') }}" id="volume-mute" crossorigin="anonymous" />
      <img src="{{ url('../assets/img/360/360_icon/seek-back.png') }}" id="seek-back" crossorigin="anonymous" />
      <img src="{{ url('../assets/img/360/paris-height.jpg') }}" id="sky" crossorigin="anonymous" />
    </a-assets>

    <a-assets>
      <img src="{{ url('../assets/img/360/360_icon/white_grid_thin.png') }}" id="grid" crossorigin="anonymous" />
      <video id="video-src" src="<?php echo e(url("../assets/img/360/video/video" .  $id . ".mp4")); ?>"></video>
    </a-assets>

    <!-- CURSOR -->
    <a-entity position="0 1.8 0">
      <a-entity camera look-controls mouse-cursor>
        <a-cursor fuse="true" timeout="500" color="#F0F0F0" scale="0.6 0.6 0.6" line>
        </a-cursor>
      </a-entity>
    </a-entity>
    <!-- END CURSOR -->

    <!-- MEDIAS HOLDER -->
    <a-sound id="alert-sound" src="src: url(assets/action.wav)" autoplay="false" position="0 0 0"></a-sound>
    <a-video id="video-screen" src="#video-src" position="0 4.5 -10" width="16" height="9"></a-video>

    <!-- END MEDIAS HOLDER -->

    <!-- CONTROLS -->
    <a-image id="control-back" width="0.4" height="0.4" src="#seek-back" position="-0.8 0.6 -5" visible="false" scale="0.85 0.85 0.85"></a-image>
    <a-image id="control-play" width="0.4" height="0.4" src="#play" position="0 0.6 -5"></a-image>
    <a-image id="control-volume" width="0.4" height="0.4" src="#volume-normal" position="0.8 0.6 -5" visible="false" scale="0.75 0.75 0.75"></a-image>

    <!-- END CONTROLS -->

    <!-- PROGRESSBAR -->
    <a-entity id="progress-bar" geometry="primitive: plane; width: 4; height: 0.06;" material="transparent: true; visible:false; opacity: 0;" position="0 0.1 -5">
      <a-plane id="progress-bar-track" width="4" height="0.06" color="black" position="0 0 0.005" opacity="0.2" visible="false"></a-plane>
      <a-plane id="progress-bar-fill" width="0" height="0.06" color="#7198e5" position="-2 0 0.01" visible="false"></a-plane>
    </a-entity>

    <!-- END PROGRESSBAR -->

    <!-- ENVIRONMENT -->
    <!--       <a-entity
          geometry="primitive: plane; width: 10000; height: 10000;" rotation="-90 0 0"
          material="src: #grid; repeat: 10000 10000; transparent: true; opacity:0.3;"></a-entity>-->
    <a-sky src="#sky"></a-sky>
    <a-entity light="color: #FFF; intensity: 1; type: ambient;"></a-entity>
    <!-- END ENVIRONMENT -->
  </a-scene>

  <script src="{{ url('assets/js/AVideoPlayer.js') }}"></script>

  <script type="text/javascript">
    let scene = document.querySelector("a-scene");
    var cursor = document.querySelector("a-cursor");

    /**
     * AVideoPlayer
     */
    var videoPlayer = new AVideoPlayer();
    /**
     * CURSOR
     */
    // Cursor
    let hideCursor = function() {
      cursor.removeAttribute("animation__cursorHideLeave");
      cursor.setAttribute(
        "animation__cursorHideEnter",
        "property: scale; from: 0.6 0.6 0.6; to: 0 0 0; dur: 300; easing: easeInQuad;"
      );
    };
    let showCursor = function() {
      cursor.removeAttribute("animation__cursorHideEnter");
      cursor.setAttribute(
        "animation__cursorHideLeave",
        "property: scale; from: 0 0 0; to: 0.6 0.6 0.6; dur: 300; easing: easeInQuad;"
      );
    };
    document
      .querySelector("#video-screen")
      .addEventListener("mouseenter", hideCursor);
    document
      .querySelector("#video-screen")
      .addEventListener("mouseleave", showCursor);
    // Play button action
    document
      .querySelector("#control-play")
      .addEventListener("click", function() {});
  </script>
</body>

</html>