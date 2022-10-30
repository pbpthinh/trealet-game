@extends('layouts.app')

@section('page-title', 'Map Edit')
@section('page-heading', 'Map Edit')

@section('breadcrumbs')
    <li class="breadcrumb-item active">
  You can edit your map trealet here
    </li>
@stop

@section('content')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="map-tab" data-toggle="tab" href="#map-content" role="tab" aria-controls="map-content" aria-selected="true">Thông tin bản đồ</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="locations-tab" data-toggle="tab" href="#locations-content" role="tab" aria-controls="locations-content" aria-selected="false">Thông tin địa điểm</a>
        </li>
        <div id = "save-button">
          <input type="button" id="saveMap" class="btn btn-primary" name="saveMap" value="Lưu bản đồ">
        </div>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="map-content" role="tabpanel" aria-labelledby="map-tab">
            <div>
              <form id="mapDetailForm" class="was-validated">

                <div class=" mb-3">
                  <label for="mapTitle">Tên bản đồ Trealet</label>
                  <input type="text" class="form-control" id="mapTitle" placeholder="ex: Ban do Hoang thanh Thang Long" required>
                  <div class="invalid-feedback">
                    Hãy điền tên bản đồ
                  </div>
                </div>
                <div class=" mb-3">
                  <label for="mapDesc">Mô tả về bản đồ Trealet</label>
                  <input type="text" class="form-control" id="mapDesc" placeholder="Hoang thanh Thang Long la ...." required>
                  <div class="invalid-feedback">
                    Hãy điền thông tin bản đồ
                  </div>
                </div>
                 <!-- cadd -->
                 <div class="mb-3">
                  <label>Trạng thái phát hành</label>
                  <br>
                  <select id="mapPublished" style="border: none">
                    <option value="0">No one</option>       
                    <option value="1">Everyone</option>
                    <option value="2">Everyone with key</option>
                  </select>

                  <div class="inputType_hide inputType_2">
                      <input type="textarea" class="form-control" class="inputType" name="inputType_2" id="input_2" 
                      placeholder="Nhap key..." required>
                      <div class="invalid-feedback">
                        Hãy điền key
                      </div>
                  </div>

                </div>
                <!-- cadd -->
              </form>
            </div>
        </div>
        <div class="tab-pane fade" id="locations-content" role="tabpanel" aria-labelledby="locations-tab">
            <div class="container-fluid ch-100">
                <div class="row">
                    <div class="col-3">
                        @csrf
                        <form id="addForm" onsubmit="return false">
                            <input type="number" name="placeId" id="placeId" style="display: none;">
                            <div class="mb-3" style="display: none">
                              <label for="lat"  class="form-label">Latitude</label>
                              <input type="number" step="any" class="form-control" id="placeLat" placeholder="ex 21.036713" required>
                            </div>
                            <div class="mb-3" style="display: none">
                              <label for="lng" class="form-label">Longitude</label>
                              <input type="number" step ="any" class="form-control" id="placeLng" placeholder="ex 105.844210" required>
                            </div>
                            <div class="mb-3">
                              <label for="placeName" class="form-label">Tên địa điểm</label>
                              <input type="text" class="form-control" id="placeName" placeholder="ex: Cầu Long Biên" required>
                              <div class="invalid-feedback">
                                Hãy điền tên bản đồ
                              </div>
                            </div>
                            <div class="mb-3">
                              <label for="placeDes" class="form-label">Mô tả địa điểm</label>
                              <textarea class="form-control" id="placeDes" rows="6" placeholder="ex: Cầu Long Biên là ...."></textarea>
                              
                            </div>

                            <div class="mb-3">
                            <label>Thêm hành động tương tác</label>
                            <br>
                              <select id="placeInputType" style="border: none">
                                 <option value="0">Hành động</option>       
                                 <option value="picture">Chụp ảnh</option>
                                 <option value="audio">Ghi âm</option>
                                 <option value="qr">Quét mã QR</option>
                                 <option value="form">Gửi lời nhận xét</option>
                                 <!-- cadd -->
                                 <!-- thêm hành động hỏi -->
                                 <option value="quiz">Thêm câu hỏi</option>
                                 <!-- cadd -->
                              </select>

                              <div class="inputType_hide inputType_picture">
                                  <div>Mô tả về hành động</div>
                                  <input type="textarea" class="form-control" rows = "4" class="inputType" name="inputType_picture" id="input_picture">
                              </div>
                              <div class="inputType_hide inputType_audio">
                                  <div>Mô tả về hành động</div>
                                  <input type="textarea" class="form-control" rows="4" class="inputType" name="inputType_audio " id="input_audio">
                              </div>
                              <div class="inputType_hide inputType_qr">
                                  <div>Mô tả về hành động</div>
                                  <input type="textarea" class="form-control" rows="4" class="inputType" name="inputType_qr" id="input_qr">
                              </div>
                              <div class="inputType_hide inputType_form">
                                  <div>Mô tả về hành động</div>
                                  <input type="textarea" class="form-control" rows="4" class="inputType" name="inputType_form" id="input_form">
                              </div>
                              <!-- cadd -->
                              <!-- thêm Form điền câu hỏi -->
                              <div class="inputType_hide inputType_quiz">
                                <div>Câu hỏi:</div>
                                <input type="textarea" class="form-control" rows="4" class="inputType" name="inputType_quiz" id="input_quiz">
                                  <div>Phương án 1:</div>
                                  <div class="answer_1">
                                    <input type="text" name="" id="input_answer_1">
                                    <input type="radio" name="quiz" class="answer" id="answer_1" value="1">
                                  </div>
                                  <div>Phương án 2:</div>
                                  <div class="answer_2">
                                    <input type="text" name="" id="input_answer_2">
                                    <input type="radio" name="quiz" class="answer" id="answer_2" value="2">
                                  </div>
                                  <div>Phương án 3:</div>
                                  <div class="answer_3">
                                    <input type="text" name="" id="input_answer_3">
                                    <input type="radio" name="quiz" class="answer" id="answer_3" value="3">
                                  </div>
                                  <div>Phương án 4:</div>
                                  <div class="answer_4">
                                    <input type="text" name="" id="input_answer_4">
                                    <input type="radio" name="quiz" class="answer" id="answer_4" value="4">
                                  </div>
                                  <div>Tích chọn vào phương án chính xác</div>
                              </div>
                              <!-- cadd -->
                              
                            </div>
                            <div class="inputType_fileUpload">
                              <!-- cadd -->
                              <!-- Thêm ô input audio-->
                              <label for="placeDes" class="form-label">Thêm âm thanh thuyết minh</label>
                              <div class="">
                                <input type="file" name="input_audioUpload" accept=".mp3" id="input_audioUpload"  />
                                <label for="input_audioUpload" onmouseover="this.style.color = '#28a745'" onmouseout="this.style.color = '#212529'"></label>
                                <audio id="audio_upload" style="width: 100%;display:none;" controls></audio>
                              </div>
                              <!-- cadd -->

                              <!-- cadd -->
                              <!-- hiện ô thêm file -->
                                <label for="placeDes" class="form-label">Thêm hình ảnh, đoạn phim</label>
                                <input type="file" name="inputType_fileUpload" accept=".jpg, .png, .mp4" id="input_fileUpload"  />
                                <label for="input_fileUpload" onmouseover="this.style.color = '#28a745'" onmouseout="this.style.color = '#212529'"></label>
                                <img id="image_upload" controls style="width: 100%;display:none;"></img>
                                <video id="video_upload" controls style=" width: 100%;display:none;"></video>
                            </div>

                            <label></label>
                            <div>
                            <input type="submit"  class="btn btn-primary btn-small" value="Lưu">
                            <input type="reset" class="btn btn-primary btn-small" value="Điền lại">
                            <input type="button" class="btn btn-danger btn-small" id="deleteMarker" value="Xóa" style="display: none">
                            </div>
                            
                            
                        </form>
                    </div>
                    <div class="col-9" style="height: 78ch">
                        <div id="map" c style="width: 100%; height: 100%;"></div>
                        <br>
                        <!-- <input type="button" id="saveMap" class="btn btn-primary" name="saveMap" value="Lưu bản đồ khám phá" > -->
                    </div>
                    
                </div>

              </div>
        </div>
    </div>
    
@stop

@section('scripts')
    <script type="text/javascript">
      // local map data
      var fileUploadData = [];
      var fileUploadUrl =[];
      var temp_makers_scale = 4;
      var map;
      var mapPolyLine;
      var mapDesc = $('#mapDesc') ;
      var mapTitle = $('#mapTitle');
      // cadd
      var mapPublished = $('#mapPublished');
      var mapPass = $('#input_2'); // 2 - everyone with key
      var answer1 = $('#input_answer_1');
      var answer2 = $('#input_answer_2');
      var answer3 = $('#input_answer_3');
      var answer4 = $('#input_answer_4');
      // cadd
      var gMarkers = [];
      var locationLatLng = [];
      var temp_makers = {};
      var temp_latLng = {};
      var center_marker ={ "lat": 16.384327863830695, "lng": 107.07183203125003 } ;
      var zoom = 6;
      // icon = <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-flag-fill" viewBox="0 0 16 16">
      //         <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12.435 12.435 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A19.626 19.626 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a19.587 19.587 0 0 0 1.349-.476l.019-.007.004-.002h.001"/>
      //       </svg>
      

      // map data in database
      var mapData = {!! json_encode($map_trealet->toArray(),JSON_HEX_TAG) !!};
      var locationData;
      var locations;
      var mapId;
      if(mapData.length != 0 ){
        mapId = '{!! $mapId !!}';
        locationData = JSON.parse(mapData.json);
        locations = JSON.parse(mapData.json).item;
        if(locations.length!=0){
          center_marker = locations[0];
          zoom = 10;
        }
      } else {
        locationData = {
          'exec':'map',
          'title':'',
          'author':'',
          'desc':'',
          'mapPublished':'', // cadd
          'item': locations
        };
        locations =[];
        mapId = null;
      };

      // so luong diem da co
      var locLength = locations.length;
	  var pIdAdd = locLength;
	  
	  // user_id(delete soon)
	  var user_id = '{{ $user->id }}';

      

      
      var trealet = {
          'exec':'map',
          'title':mapData.title,
          'author':'',
          'desc':locationData.desc,
          'item': locations
      };
      var mapTrealet ={
        'user_id': user_id,
        'title':mapData.title,
        'type':"maps",
        'published': mapData.published,  // cadd
        'state':'1',
        'trealet': trealet};

      $(document).ready(function(){
          $('#mapDesc').val(trealet.desc);
          $('#mapTitle').val(trealet.title);
          // cadd
          $('#mapPublished').val(mapTrealet.published);
      })
      $(document).on("keydown", "input", function(e) {
          if (e.which==13) e.preventDefault();
      });

      $('#mapTitle').change(function(e){
          trealet.desc = mapDesc.val();
          mapTrealet.title = mapTitle.val();

      })
      $('#mapDesc').change(function(e){
          trealet.desc = mapDesc.val();
      })

      // cadd
      $('#mapPublished').change(function(e){
          //trealet.desc = mapDesc.val();
          mapTrealet.published = mapPublished.val();
      })

      $('#input_2').change(function(e){
          //trealet.desc = mapDesc.val();
          mapTrealet.pass = mapPass.val();
      })
      $('#input_answer_1').change(function(e){
          mapTrealet.input.ans_1 = answer1.val();
      })
      $('#input_answer_2').change(function(e){
          mapTrealet.input.ans_2 = answer2.val();
      })
      $('#input_answer_3').change(function(e){
          mapTrealet.input.ans_3 = answer3.val();
      })
      $('#input_answer_4').change(function(e){
          mapTrealet.input.ans_4 = answer4.val();
      })
      $('#answer_1').change(function(e){
        if($('#answer_1').checked){
          mapTrealet.input.true = "1";
        }
      })
      $('#answer_2').change(function(e){
        if($('#answer_2').checked){
          mapTrealet.input.true = "2";
        }
      })
      $('#answer_3').change(function(e){
        if($('#answer_3').checked){
          mapTrealet.input.true = "3";
        }
      })
      $('#answer_4').change(function(e){
        if($('#answer_4').checked){
          mapTrealet.input.true = "4";
        }
      })
      // cadd

      //khởi tạo bắt đầu load
      function initMap() {
            var icon = {
              path: "M10.453 14.016l6.563-6.609-1.406-1.406-5.156 5.203-2.063-2.109-1.406 1.406zM12 2.016q2.906 0 4.945 2.039t2.039 4.945q0 1.453-0.727 3.328t-1.758 3.516-2.039 3.070-1.711 2.273l-0.75 0.797q-0.281-0.328-0.75-0.867t-1.688-2.156-2.133-3.141-1.664-3.445-0.75-3.375q0-2.906 2.039-4.945t4.945-2.039z",
              fillColor: "blue",
              fillOpacity: 1,
              strokeWeight: 0,
              rotation: 0,
              scale: 2,
              anchor: new google.maps.Point(13, 21),
            };

          var infowindow = new google.maps.InfoWindow();

          map = new google.maps.Map(document.getElementById('map'), {
              zoom: zoom,
              center: new google.maps.LatLng(center_marker.lat,center_marker.lng),
              mapTypeId: google.maps.MapTypeId.ROADMAP,
          });

          temp_makers =new google.maps.Marker();
          //marker event
          if(locations != undefined){
            for (let i = 0; i < locations.length; i++) { 
              let marker;
              if (i!=0) {
                marker = new google.maps.Marker({
                  position: {lat: +locations[i].lat, lng: +locations[i].lng},
                  draggable: true,
                  map: map,
                  icon: makeIcon(i+1),
                });
              }
              else{
                marker = new google.maps.Marker({
                  position: {lat: +locations[i].lat, lng: +locations[i].lng},
                  draggable: true,
                  map: map,
                  // icon: icon,
                  icon: makeIcon(1),
                });
              }

              

              gMarkers.push(marker);
              locationLatLng.push({lat: marker.position.lat(),lng: marker.position.lng()});
              
              const infowindow = new google.maps.InfoWindow();
              google.maps.event.addListener(marker, 'click', (function(marker) {
                return function() {
                  let j = gMarkers.indexOf(marker);
                  infowindow.close();
                  infowindow.setContent(locations[j].name);
                  infowindow.open({
                    anchor: marker,
                    map,
                    shouldFocus: false,
                  })
                  click_marker(marker,j);
                }
              })(marker));
              google.maps.event.addListener(marker, 'mouseover', (function(marker) {
                return function() {
                  let j = gMarkers.indexOf(marker);
                  infowindow.close();
                  infowindow.setContent(locations[j].name);
                  infowindow.open({
                    anchor: marker,
                    map,
                    shouldFocus: false,
                  })
                }
              })(marker, i));
              google.maps.event.addListener(marker, 'mouseout', (function(marker) {
                return function() {
                  let j = gMarkers.indexOf(marker);
                  infowindow.close();
                }
              })(marker));

              google.maps.event.addListener(marker,'dragstart',(function(event){
                infowindow.open({
                  anchor: marker,
                  map,
                  shouldFocus: false,
                })
              }))

              google.maps.event.addListener(marker,'drag',function(event){
                let j = gMarkers.indexOf(marker);
                const path = mapPolyLine.getPath();
                path.setAt(j,event.latLng);
              })
              google.maps.event.addListener(marker,'dragend',(function(event) {
                const i = gMarkers.indexOf(marker);
                locations[i].lat = event.latLng.lat();
                locations[i].lng = event.latLng.lng();



                infowindow.close();
              }))
                
            }
          }

          mapPolyLine = new google.maps.Polyline({
            path: locationLatLng,
            geodesic: true,
            strokeColor: "#000000",
            strokeOpacity: 1.0,
            strokeWeight: 2,
            editable: true,
            draggable: false

          });
          
          google.maps.event.addListener(mapPolyLine,"dragend",updateMapPolyLine);
          mapPolyLine.addListener("dragstart",function(){
            console.log("dragstart");
          })
          mapPolyLine.setMap(map);
          map.addListener("click",(mapMouserEvent)=>{
              temp_makers.setMap(null);
              temp_makers = new google.maps.Marker({
                position: mapMouserEvent.latLng,
                icon: {
                  path: google.maps.SymbolPath.CIRCLE,
                  scale: temp_makers_scale,
                },
                map: map,
              })

              // const path = mapPolyLine.getPath();
              // path.push(mapMouserEvent.latLng);
              // console.log(mapMouserEvent.latLng);
              temp_latLng = mapMouserEvent.latLng;
              $('#addForm').trigger('reset');
              $('#placeLat').val(mapMouserEvent.latLng.lat());
              $('#placeLng').val(mapMouserEvent.latLng.lng());
              $("#deleteMarker").hide();
          })


          // mapPolyLine event
          google.maps.event.addListener(mapPolyLine.getPath(),'insert_at',function(event){
            console.log(event+" insert_at");
            event = +event;

            if(event  != gMarkers.length){
              const index = event;

              const path = mapPolyLine.getPath();
              const lat = path.getAt(index).lat();
              const lng = path.getAt(index).lng();
              temp_latLng = path.getAt(index);
              const marker = new google.maps.Marker({
                  position: {lat: lat, lng: lng},
                  draggable: true,
                  map: map,
                  icon: makeIcon(1+event),
                });
              
              let imgUrl = $("#image_upload").attr("src");
              let videoUrl = $("#video_upload").attr("src");
              // cadd 
              // thêm url audio
              let audioUrl = $("#audio_upload").attr("src");
              let publishedType = $("#publishedInputType").val();
              // cadd 
              let pId = $("#placeId").val();
              let pName = $("#placeName").val();
              let pDes = $("#placeDes").val();
              let pInput = $("#placeInputType").val();
              let pInputLabel = $("#input_"+pInput).val();
              // cadd 
              // thay đổi khi thêm câu hỏi
              let checks = $(".answer");
              let trueAnswer ="0";
              for (let i = 0; i < checks.length; i++){
                if(checks[i].checked){
                  trueAnswer = checks[i].value;
                }
              }
              if (pInput == "quiz"){
                input = {
                "type": pInput,
                "label": pInputLabel,
                "ans_1":$("#input_answer_1").val(),
                "ans_2":$("#input_answer_2").val(),
                "ans_3":$("#input_answer_3").val(),
                "ans_4":$("#input_answer_4").val(),
                "true":trueAnswer,
              }
              }else{
                input = {
                "type": pInput,
                "label": pInputLabel
              };
              // cadd 
              }
              let locationElement ={
                "name": pName,
                "lat": lat,
                "lng": lng,
                "desc": pDes,
                "input": input,
                "imgUrl": imgUrl,
                "videoUrl": videoUrl,
                // cadd 
                // Thêm trường audio url
                "audioUrl": audioUrl
              }
              if(pId==''){
                locations.splice(index,0,locationElement);
                gMarkers.splice(index,0,marker);


                const infowindow = new google.maps.InfoWindow({
                    content: '',
                  });
                google.maps.event.addListener(marker, 'click', (function(marker) {
                  return function() {
                    let i = gMarkers.indexOf(marker);

                    infowindow.close();
                    infowindow.open({
                      anchor: marker,
                      map,
                      shouldFocus: false,
                    });
                    infowindow.setContent(locations[i].name);
                    click_marker(marker,i);
                  }
                })(marker));
                google.maps.event.addListener(marker, 'mouseover', (function(marker) {
                    return function() {
                      let i = gMarkers.indexOf(marker);
                      infowindow.close();
                      infowindow.setContent(locations[i].name);
                      infowindow.open({
                        anchor: marker,
                        map,
                        shouldFocus: false,
                      })
                    }
                  })(marker));
                  google.maps.event.addListener(marker, 'mouseout', (function(marker) {
                    return function() {
                      infowindow.close();
                    }
                  })(marker));

                google.maps.event.addListener(marker,'dragstart',(function(event){
                  let i = gMarkers.indexOf(marker);
                  infowindow.open({
                    anchor: marker,
                    map,
                    shouldFocus: false,
                  })
                }))
                google.maps.event.addListener(marker,'drag',function(event){
                    let i = gMarkers.indexOf(marker);
                    const path = mapPolyLine.getPath();
                    path.setAt(i,event.latLng);
                  })
                google.maps.event.addListener(marker,'dragend',(function(event) {
                  const i = gMarkers.indexOf(marker);
                  locations[i].lat = this.getPosition().lat();
                  locations[i].lng = this.getPosition().lng();
                  infowindow.close();
                }))
              }
              resetIcon(event+1);
              $("#addForm").trigger('reset');
            }
          })
          google.maps.event.addListener(mapPolyLine.getPath(),'remove_at',function(event){
            event = +event;
            console.log(event+" remove_at");
            if(mapPolyLine.getPath().length != gMarkers.length){
              gMarkers[event].setMap(null);
              gMarkers.splice(event,1);
              locations.splice(event,1);
            }
            resetIcon(event);
            
          })
          google.maps.event.addListener(mapPolyLine.getPath(),'set_at',function(event){

            console.log(event+ " set_at");
          })
      }

      $('#saveMap').click(function(e){
        
        
        Swal.fire({
              title: 'Bạn có muốn lưu lại bản đồ khám phá?',
              html: getDetailFromLocations(locations),
              icon: 'question',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              cancelButtonText: 'Quay lại',
              confirmButtonText: 'Đồng ý',
          })
          .then((result)=>{
            if(result.isConfirmed){
              saveMap();

            }
            else{

            }
          })
      })

      function click_marker(marker,i){
        var pre_input_type = $("#placeInputType").val();
        $('#addForm').trigger('reset');
        $("#placeId").val(i);
        console.log($("#placeId").val());
        $("#placeName").val(locations[i].name);
        $("#placeLat").val(locations[i].lat);
        $("#placeLng").val(locations[i].lng);
        $("#placeDes").val(locations[i].desc);
        let imgUrl = $("#image_upload").attr("src",locations[i].imgUrl);
        let videoUrl = $("#video_upload").attr("src",locations[i].videoUrl);
        // cadd 
        // Thêm lấy link audio
        let audioUrl = $("#audio_upload").attr("src",locations[i].audioUrl);
        // cadd 
        if($("#placeId").val()>=0) $("#placeInputType").val(locations[i].input.type).change();
        if($("#placeId").val()>=0) $("#placeInputType").val(locations[i].input.type).change();
        var inputType = $("#placeInputType").val();
        // cadd 
        // ?sửa khi thêm câu hỏi
        let checks = $(".answer");
        console.log(checks);
        if (inputType == "quiz"){
          $("#input_"+inputType).val(locations[i].input.label);
          $("#input_answer_1").val(locations[i].input.ans_1);
          $("#input_answer_2").val(locations[i].input.ans_2);
          $("#input_answer_3").val(locations[i].input.ans_3);
          $("#input_answer_4").val(locations[i].input.ans_4);
          for(let i =0; i < 4; i++){
            if((i+1) == locations[i].input.true){
              console.log((i+1),locations[i].input.true);
              checks[i].checked = true;
            }
          }

        }else{
          $("#input_"+inputType).val(locations[i].input.label);
        }
        // cadd 
        if(imgUrl.attr("src")!="" && imgUrl.attr("src") != undefined) $("#image_upload").show();
        if(videoUrl.attr("src")!="" && videoUrl.attr("src") != undefined) $("#video_upload").show();
        // cadd 
        // ẩn thẻ audio
        if(audioUrl.attr("src")!="" && audioUrl.attr("src") != undefined) $("#audio_upload").show();
        // cadd 
        $("#deleteMarker").show();
      }

      function updateMapPolyLine(){
        console.log("update");
      }

      function deleteMarker(id){
        id = +id;
        const path = mapPolyLine.getPath();
        path.removeAt(id);
        $("#addForm").trigger('reset');
        fileUploadData.splice(id,1);
      }

      
      $("#deleteMarker").click(function(e){
        let p_id = $("#placeId").val();
        deleteMarker(p_id);
      })

      //add collapse to all tags hiden and showed by select mystuff
      $('.inputType_hide').addClass('collapse');

      //on change hide all divs linked to select and show only linked to selected option
      $('#placeInputType').change(function(){
          console.log("change");
          //Saves in a variable the wanted div
          var selector = '.inputType_' + $(this).val();

          //hide all elements
          $('.inputType_hide').collapse('hide');

          //show only element connected to selected option
          $(selector).collapse('show');

      });
      // cadd
      $('#mapPublished').change(function(){
          console.log("change");
          //Saves in a variable the wanted div
          var selector = '.inputType_' + $(this).val();

          //hide all elements
          $('.inputType_hide').collapse('hide');

          //show only element connected to selected option
          $(selector).collapse('show');

      });
      // cadd
      $("#addForm").on('reset',function(e){
          $("#deleteMarker").hide();
          $('.inputType_hide').collapse('hide');
          $('#video_upload').hide().attr("src","");
          $('#image_upload').hide().attr("src","");
          // cadd 
          // ẩn thẻ audio
          $('#audio_upload').hide().attr("src","");
          // cadd 
      })
      $("#addForm").submit(function(e) {
          e.preventDefault();
          //get input data

          let pId = $("#placeId").val();
          let pName = $("#placeName").val();
          let pLat = $("#placeLat").val();
          let pLng = $("#placeLng").val();
          let pDes = $("#placeDes").val();
          let pInput = $("#placeInputType").val();
          let pInputLabel = $("#input_"+pInput).val();
          // cadd 
          let checks = $(".answer");
          let trueAnswer ="0";
          for (let i = 0; i < checks.length; i++){
            if(checks[i].checked){
              trueAnswer = checks[i].value;
            }
          }
          if (pInput == "quiz"){
            input = {
            "type": pInput,
            "label": pInputLabel,
            "ans_1":$("#input_answer_1").val(),
            "ans_2":$("#input_answer_2").val(),
            "ans_3":$("#input_answer_3").val(),
            "ans_4":$("#input_answer_4").val(),
            "true":trueAnswer,
          };
          console.log(input);//đúng r
          }else{
            input = {
            "type": pInput,
            "label": pInputLabel
          };
          // cadd 
          }


          
          let pFileUploadData ;
          let imgUrl = $("#image_upload").attr("src");
          let videoUrl = $("#video_upload").attr("src");
          // cadd 
          let audioUrl = $("#audio_upload").attr("src");
          // cadd 

          //set file upload data
          // cadd 
          // sử khi có thêm  audio
          if (audioUrl != ""){
            if(imgUrl != ""){
            pFileUploadData = {
              "img" :  $('#input_fileUpload')[0].files[0],
              "video" : "",
              "audio" : $('#input_audioUpload')[0].files[0]
            }
          }
          else if(videoUrl!= ""){
            pFileUploadData = {
              "img" : "",
              "video": $('#input_fileUpload')[0].files[0],
              "audio" : $('#input_audioUpload')[0].files[0]
            }
          }
          else{
            pFileUploadData = {
              "img" : "",
              "video" : "",
              "audio" : $('#input_audioUpload')[0].files[0]
            }
          }
          }
          else{
            if(imgUrl != ""){
            pFileUploadData = {
              "img" :  $('#input_fileUpload')[0].files[0],
              "video" : "",
              "audio" : ""
            }
          }
          else if(videoUrl!= ""){
            pFileUploadData = {
              "img" : "",
              "video": $('#input_fileUpload')[0].files[0],
              "audio" : ""
            }
          }
          else{
            pFileUploadData = {
              "img" : "",
              "video" : "",
              "audio" : ""
            }
          }
          }
          // cadd 

          


          // init marker
          let locationElement ={
            "name": pName,
            "lat": pLat,
            "lng": pLng,
            "desc": pDes,
            "input": input,
            "imgUrl": imgUrl,
            "videoUrl": videoUrl,
            // cadd 
            "audioUrl":audioUrl,
            // cadd 
          }

          if(pId !=''){
            locations[pId] = locationElement;
            fileUploadData[pId] = pFileUploadData;
          }
          else{
            //fileUploadData.push(pFileUploadData);
			fileUploadData[pIdAdd] = pFileUploadData;
            pIdAdd++;
            let marker;

            if(gMarkers.length!=0){
              marker = new google.maps.Marker({
                position:{lat: +pLat, lng: +pLng},
                draggable: true,
                map: map,
                icon: makeIcon(gMarkers.length+1),
              });
            }
            else{
              marker = new google.maps.Marker({
                position:{lat: +pLat, lng: +pLng},
                draggable: true,
                map: map,
                icon: makeIcon(1),
              });
            }
            const path = mapPolyLine.getPath();
            path.push(temp_latLng);

            gMarkers.push(marker);
            
            locations.push(locationElement);

            

            const infowindow = new google.maps.InfoWindow({
                content: '',
              });
            google.maps.event.addListener(marker, 'click', (function(marker) {
              return function() {
                let i = gMarkers.indexOf(marker);

                infowindow.close();
                infowindow.open({
                  anchor: marker,
                  map,
                  shouldFocus: false,
                });
                infowindow.setContent(locations[i].name);
                click_marker(marker,i);
              }
            })(marker));
            google.maps.event.addListener(marker, 'mouseover', (function(marker) {
                return function() {
                  let i = gMarkers.indexOf(marker);
                  infowindow.close();
                  infowindow.setContent(locations[i].name);
                  infowindow.open({
                    anchor: marker,
                    map,
                    shouldFocus: false,
                  })
                }
              })(marker));
              google.maps.event.addListener(marker, 'mouseout', (function(marker) {
                return function() {
                  infowindow.close();
                }
              })(marker));

            google.maps.event.addListener(marker,'dragstart',(function(event){
              let i = gMarkers.indexOf(marker);
              infowindow.open({
                anchor: marker,
                map,
                shouldFocus: false,
              })
            }))
            google.maps.event.addListener(marker,'drag',function(event){
                let i = gMarkers.indexOf(marker);
                const path = mapPolyLine.getPath();
                path.setAt(i,event.latLng);
              })
            google.maps.event.addListener(marker,'dragend',(function(event) {
              const i = gMarkers.indexOf(marker);
              locations[i].lat = this.getPosition().lat();
              locations[i].lng = this.getPosition().lng();
              infowindow.close();
            }))
          }
          $("#addForm").trigger('reset');
          temp_makers.setMap(null);
          
      });
      

      $('#input_fileUpload').on('change',function(event){
        if(!event || !event.target || !event.target.files || event.target.files.length === 0) return;
        let pId = $("#placeId").val();
        const fileURL = URL.createObjectURL(event.target.files[0]);
        const imgExtensions = ['jpg','png','PNG'];
        const videoExtensions = ['mkv','mp4','webm'];
        const name = event.target.files[0].name;
        const lastDot = name.lastIndexOf('.');
        const ext = name.substring(lastDot+1);
        if(imgExtensions.includes(ext)){
          $("#video_upload").hide().attr("src",'');
          $("#image_upload").show().attr("src",fileURL);
        } else if(videoExtensions.includes(ext)){
          $("#image_upload").hide().attr("src",'');
          $("#video_upload").show().attr("src",fileURL);
        }
      })
      // cadd 
      // lấy link audio khi up file
      $('#input_audioUpload').on('change',function(event){
        if(!event || !event.target || !event.target.files || event.target.files.length === 0) return;
        let pId = $("#placeId").val();
        const fileURL = URL.createObjectURL(event.target.files[0]);

        const name = event.target.files[0].name;
        $("#audio_upload").hide().attr("src",'');
        $("#audio_upload").show().attr("src",fileURL);
        
      })
      // cadd 

      function getDetailFromLocations(array){
        let i,l = array.length,detail = "<div id = 'dataLocations'>";
        for(i = 0; i<l; i++){
          detail +="<strong>Địa điểm</strong> " +(i+1)+", <strong>Tên địa điểm</strong>: "+array[i].name+", <strong>Mô tả</strong>:"+array[i].desc+", <strong>Hành động</strong>: "+array[i].input.label+"<br> ";
        }
        detail +="</div>";
        return detail;
      }

      function makeIcon(index){
        return 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld='+index+'|FE6256|000000';
      }

      function resetIcon(index){
        for(let i = index;i<gMarkers.length;i++) gMarkers[i].setIcon(makeIcon(i+1));
      }

      

      function saveMap(){

        for(let i =0; i < fileUploadData.length;i++){
		  if (fileUploadData[i] === undefined) continue;
		  var formData = new FormData();
          let fileType = '';
          // cadd 
          // up audio
          if(fileUploadData[i].img && fileUploadData[i]?.img != '') fileType = 'picture_file';
          else if(fileUploadData[i].video && fileUploadData[i]?.video != '') fileType = 'video_file';
          
          if(fileUploadData[i].audio && fileUploadData[i]?.audio != '')
          {
            // formData.append('audio_data', fileUploadData[i].audio);
            formData.append('file', fileUploadData[i].audio)
            formData.append("_token", '{{ csrf_token() }}');
            $.ajax({
                  //  url : '/upload_audio',
                   url: '/map-player/upload',
                   type : 'POST',
                   data : formData,
                   async : false,
                   processData: false,  
                   contentType: false,  
                   success : function(data) {
                      if(data != 'No audio file uploaded'){ 
                        locations[i].audioUrl = data['data'];
                      } 
                   }
            })
          }
          // cadd 
          if(fileType == '') continue;
          else if(fileType == 'picture_file'){
            // formData.append(fileType, fileUploadData[i].img);
            formData.append('file',fileUploadData[i].img);
            formData.append("_token", '{{ csrf_token() }}');
            $.ajax({
                  //  url : '/upload_image',
                   url : '/map-player/upload',
                   type : 'POST',
                   data : formData,
                   async : false,
                   processData: false,  
                   contentType: false,  
                   success : function(data) {
                      if(data != 'No picture file uploaded'){
                        locations[i].imgUrl = data['data'];
                      }
                   }
            })
          }
          else if(fileType == 'video_file'){
            // formData.append(fileType, fileUploadData[i].video);
            formData.append('file', fileUploadData[i].video);
            formData.append("_token", '{{ csrf_token() }}');
            $.ajax({
                  //  url : '/upload_video',
                   url: '/map-player/upload',
                   type : 'POST',
                   data : formData,
                   async : false,
                   processData: false,  
                   contentType: false,  
                   success : function(data) {
                    if(data != 'No video file uploaded'){
                        locations[i].videoUrl = data['data'];
                      }
                   }
            });
          }         
        }
        let url = "/api/map", method = "POST";
          if(mapId!=null){
            url = "/api/map/"+mapId;
            method = "PUT"
          } 

          $.ajax({
              url: url,
              type: method,
              data: JSON.stringify(mapTrealet),
              contentType: "application/json; charset=utf-8",
              success: function () {
                  Swal.fire({
                    title: 'Thành công',
                    text: "Bạn có muốn chuyển về trang quản lý trealet?",
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Ở lại',
                    confirmButtonText: 'Chuyển'
                  })
                  .then((result)=>{
                    if(result.isConfirmed){
                      window.location.href = "/my-trealets"
                    }
                  });
              },
              error: function (xhr, ajaxOptions, thrownError) {
                  Swal.fire("Lưu bản đồ thất bại", "Hãy kiểm tra lại thông tin bản đồ", "error");
              }
          }); 

        
      }
    </script>
    <style type="text/css">
      #dataLocations{
        width: auto;
        overflow-x: hidden;
        overflow-y: auto;
        height: 21rem;
      };

    </style>

    <script src="http://maps.google.com/maps/api/js?key=AIzaSyDaN01Pp4i8Q-JFCHFlWuYWhexqj-tNHy0&callback=initMap" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
@stop

@section('styles')
<style>

  #save-button {
    position: absolute;
    right: 15px;
    top: 90px;
  }

  #mapDetailForm {
    margin: 0px 15px;
  }


</style>
@stop