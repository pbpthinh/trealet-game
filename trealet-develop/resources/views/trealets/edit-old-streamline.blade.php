@extends('layouts.app')

@section('page-title', 'Play details')
@section('page-heading', 'Play details')

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        The details of your Trealet
    </li>
@stop

<?php
$nij = 0;
$css_display='';
$css_input='';
$trealet_id = $tr->id_str;
?>
@section('content')
    @include('partials.messages')
    <div class="card" style="width: 100%"><div class="card-body">
            @csrf

            <form action="/edit_trealet/{{$tr->id}}" method="post" >
                <div><h2>Chỉnh sửa streamline của bạn tại đây!</h2></div>
                @csrf



                <div>
                    <div class="form-group">

                        <label for="published">Cho phép truy cập</label>

                        <select id= "select_mode_public" name="published" class="form-control" style="width:250px" >
                            @if ($tr->published == 0)
                                <option value="0" selected>Không ai có thể truy cập</option>
                                <option value="1">Tất cả mọi người có thể truy cập</option>
                                <option value="2">Tất cả mọi người có mật khẩu có thể truy cập</option>
                                aaaa
                            @endif
                            @if ($tr->published == 1)
                                <option value="1" selected>Tất cả mọi người có thể truy cập</option>

                                <option value="2">Tất cả mọi người có mật khẩu có thể truy cập</option>
                                <option value="0">Không ai có thể truy cập</option>
                            @endif
                            @if ($tr->published == 2)
                                <option value="2" selected>Tất cả mọi người có mật khẩu có thể truy cập</option>
                                <option value="1">Tất cả mọi người có thể truy cập</option>
                                <option value="0">Không ai có thể truy cập</option>
                            @endif

                        </select>
                    </div>
                    <div class="form-group" style="width:250px" >
                        <label for="title">@lang('Mật khẩu ')</label>
                        <input type="text" class="form-control input-solid" id="title"
                               name="key" placeholder="@lang('')"  value="{{$tr->pass}}" >
                    </div>



                </div>
            </form>


        </div>


    </div>
    <script src="//code.jquery.com/jquery-1.12.4.js" defer></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js" ></script>



    <div class="loader" id = "myLoader"></div>
    <div id="myLocker"></div>
    <div class="container" id = "myContainer">

        <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <button type="button" id = "close_modal" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">


                        <h2 class="h4 mb-1">Chọn dữ liệu cho trealet của bạn!</h2>
                        <p class="small text-muted font-italic mb-4"></p>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                                   aria-selected="true">Hình ảnh, âm thanh, video</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                                   aria-selected="false">Tương tác</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                                   aria-selected="false"></a>
                            </li>
                           
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <ul class="list-group" id = "list_item">
                                    <li  id = "picture_input" class="list-group-item rounded-0 d-flex align-items-center justify-content-between">
                                        <div class="custom-control custom-radio">
                                            <input value = "Picture_input" accept="image/*" onchange="loadFile(event)" name = "type_item" class="custom-control-input" id="customRadio1" type="radio" name="customRadio">
                                            <label class="custom-control-label" for="customRadio1">
                                                <p class="mb-0">Picture</p><span class="small font-italic text-muted">Người dùng có thể xem ảnh này trong trealet của bạn! (chấp nhận ảnh png)</span>

                                                <input type="file" class="form-control" id ="customFile_uploadImage"  /><br>
                                                <textarea  id="customText_1" placeholder= "Hãy viết mô tả cho ảnh này!"  class ="form-control"></textarea>
                                            </label>
                                        </div>
                                        <label for="customRadio1"><img src="https://icon-library.com/images/upload-icon/upload-icon-15.jpg" alt="" width="60"></label>
                                    </li>
                                    <li  class="list-group-item rounded-0 d-flex align-items-center justify-content-between">
                                        <div class="custom-control custom-radio">
                                            <input value = "Video_input" name = "type_item" class="custom-control-input" id="customRadio2" type="radio" name="customRadio">
                                            <label class="custom-control-label" for="customRadio2">
                                                <p class="mb-0">Video</p><span class="small font-italic text-muted">Người dùng có thể xem video này trong trealet của bạn! (chấp nhận video mp4)</span>
                                                <input type="text" class="form-control" placeholder= "Link youtube" id="link-youtube" /><br>
                                                <input type="file" class="form-control" id="customFile_uploadVideo" /><br>
                                                <textarea  style="height: 100px" id="customText_2" placeholder= "Hãy viết mô tả cho video này!"  class ="form-control"></textarea>
                                            </label>
                                        </div>
                                        <label for="customRadio1"><img src="data:image/jpeg;base64,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" alt="" width="60"></label>
                                    </li>

                                    <li  id = "audio_input" class="list-group-item rounded-0 d-flex align-items-center justify-content-between">
                                        <div class="custom-control custom-radio">
                                            <input value = "Audio_upload" accept="*" onchange="loadFile(event)" name = "type_item" class="custom-control-input" id="customRadio7" type="radio" name="customRadio7">
                                            <label class="custom-control-label" for="customRadio7">
                                                <p class="mb-0">Audio</p><span class="small font-italic text-muted">Người dùng có thể nghe đoạn audio này trong trealet của bạn! (chấp nhận audio mp3)</span>

                                                <input type="file" class="form-control" id ="customFile_uploadAudio"  /><br>
                                                <textarea style="height: 100px" id="customText_3" placeholder= "Hãy viết mô tả cho audio này!"  class ="form-control"></textarea>
                                            </label>
                                        </div>
                                        <label for="customRadio1"><img src="https://tse2.mm.bing.net/th?id=OIP.avZrIE2u4nFpbnubq-rkLAHaG0&pid=Api&P=0&w=187&h=173" alt="" width="60"></label>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <ul>
                                    <li  class="list-group-item rounded-0 d-flex align-items-center justify-content-between">
                                        <div class="custom-control custom-radio">
                                            <input value = "Audio_input" name = "type_item" class="custom-control-input" id="customRadio3" type="radio" name="customRadio">
                                            <label class="custom-control-label" for="customRadio3">
                                                <p class="mb-0">Audio input</p><span class="small font-italic text-muted">Người dùng có thể lưu một audio vào trealet của bạn!</span>
                                            </label>
                                        </div>
                                        <label for="customRadio1"><img src="https://www.kindpng.com/picc/m/220-2203226_volume-sound-audio-on-audio-icon-white-png.png" alt="" width="60"></label>
                                    </li>
                                    <li  class="list-group-item d-flex align-items-center justify-content-between">
                                        <div class="custom-control custom-radio">
                                            <input value = "Picture_upload" name = "type_item" class="custom-control-input" id="customRadio4" type="radio" name="customRadio">
                                            <label class="custom-control-label" for="customRadio4">
                                                <p class="mb-0">Picture input</p><span class="small font-italic text-muted">Người dùng có thể chụp một bức ảnh khi sử dụng trealet của bạn!</span>
                                            </label>
                                        </div>
                                        <label for="customRadio2"><img src="https://www.pinclipart.com/picdir/middle/460-4608361_album-svg-png-icon-free-download-album-foto.png" alt="" width="60"></label>
                                    </li>
                                    <li  class="list-group-item d-flex align-items-center justify-content-between">
                                        <div class="custom-control custom-radio">
                                            <input value = "QR_upload" name = "type_item" class="custom-control-input" id="customRadio5" type="radio" name="customRadio">
                                            <label class="custom-control-label" for="customRadio5">
                                                <p class="mb-0">QR input</p><span class="small font-italic text-muted">Người dùng có thể quét mã QR khi sử dụng trealet của bạn!</span>
                                            </label>
                                        </div>
                                        <label for="customRadio3"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/31/QR_icon.svg/1024px-QR_icon.svg.png" alt="" width="60"></label>
                                    </li>
                                    <li  class="list-group-item d-flex align-items-center justify-content-between">
                                        <div class="custom-control custom-radio">
                                            <input value = "Form_input" name = "type_item" class="custom-control-input" id="customRadio6" type="radio" name="customRadio">
                                            <label class="custom-control-label" for="customRadio6">
                                                <p class="mb-0">Form comment input</p><span class="small font-italic text-muted">Người dùng có thể comment khi sử dụng trealet của bạn!</span>
                                            </label>
                                        </div>
                                        <label for="customRadio3"><img src="https://www.clipartmax.com/png/middle/10-104506_form-icon-orcamento-icon.png" alt="" width="60"></label>
                                    </li>
                                </ul>
                            </div>
                            
                           
                        </div>

                    </div>


                    <div class="modal-footer">

                        <button type="button" class="btn btn-primary submit_add_element" id="submit_add_element">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <center><h1><input value = "{!! $name !!}" placeholder="Hãy điền tên trealet" class = "form-control" id ="trealet_title" style="text-align:center; height: 60px; width: 50%"></h1>
            <h4 class="text-muted"><input value = "{{!! $creator->get_fullname() !!}}" placeholder= "Hãy điền tên của tác giả " id="trealet_author" class ="form-control" style="text-align:center; width: 30%"></h4></center>
        <div class="d-flex mb-2 py-1" style="width: 25%">
                    <div class="flex-grow-1">
                    <select class="w-100 no-resize form-control" id = "language" aria-label="Default select example" rows="4">
                        <option value="">Chọn ngôn ngữ</option>
                        <option value="vn">Tiếng Việt</option>
                        <option value="en">Tiếng Anh</option>
                        <option value="fr">Tiếng Pháp</option>
                    </select>
                     </div>
                </div>
            <div class="card" style="text-align: justify; height: 100%">
            <h4 class="card-header">Lời giới thiệu</h4>
            <div class="card-body"><textarea id="trealet_desc" class="form-control rounded-0" style="text-align: justify; height: 100%">{{$desc}}</textarea><p></p>
                <!-- large buttons -->
            </div>

        </div>

        <div class="list-group" id="sortable">
        </div>
        <script>
            $(function () {
                $("#sortable").sortable();
            });
        </script>
        <form class="form-inline mb-4" id="form">
            <button class="btn btn-sm btn-secondary" style="margin-top: 20px; text-align: center;">Thêm dữ liệu</button>

        </form>
        <form class="form-inline mb-4" id="form" >
            <div id = "save_trealet" class="btn btn-sm btn-secondary" style="margin-top: 20px;margin-left: 40%; text-align: center;">Lưu trealet</div>

        </form>


        <script>
            let form = document.querySelector("#form");
            // let album = document.querySelector("#album");
            let list = document.querySelector("#sortable");
            let filter = document.querySelector("#filter");
            let submit = document.querySelector("#submit_add_element");
            let add = document.querySelector("#button_add_item_trealet");
            let selectedItem;
            let index = 0;
            let picture;
            let audio;
            let video;
            var json_items = [];
            let list_album = [];
            let dict_json = new Object();
            let dict_item = new Object();
            let picture_blob;
            let video_blob;
            let audio_blob;
            let save = document.querySelector("#save_trealet");
            save.addEventListener('click', function (){
                document.getElementById("myContainer").style.opacity = 0.1;
                document.getElementById("myLoader").style.display = "block";
                setTimeout(function(){
                    saveTrealet();
                },500);
            })
            function saveTrealet (){
                if(document.getElementById("language").value == ""){
                        alert("Vui lòng chọn ngôn ngữ!");
                        document.getElementById("myContainer").style.opacity = 1;
                        document.getElementById("myLoader").style.display = "none";
                        return;
                    }
                
                var list_card = document.getElementsByClassName("card ui-sortable-handle");

                for (const element of list_card) {
                    var itemAdd = new Object();
                    if (element.getElementsByClassName("card-body")[0].getAttribute("type") == "iframe") {

                        var iframe_json = new Object();
                        iframe_json["type"] = element.getElementsByClassName("card-body")[0].getElementsByTagName("iframe")[0].getAttribute("type");
                        iframe_json["label"] = element.getElementsByClassName("form-control")[0].value;
                        itemAdd['input'] = iframe_json;
                        json_items.push(itemAdd);

                    }
                    if (element.getElementsByClassName("card-body")[0].getAttribute("type") == "video_youtube") {

                        var video_youtube = new Object();
                        video_youtube["type"] = "video_youtube";
                        video_youtube["video_src"] = element.getElementsByClassName("card-body")[0].getElementsByTagName("iframe")[0].getAttribute("src");
                        video_youtube["video_title"] = element.getElementsByClassName("form-control")[0].value;
                        if(element.getElementsByClassName("form-control").length == 2){
                            video_youtube["description_video"] = element.getElementsByClassName("form-control")[1].value;
                        }
                        else{
                            console.log(element.getElementsByTagName("div"));
                            video_youtube["description_video"] = element.getElementsByTagName("div")[3].textContent;
                        }
                        itemAdd['video-youtube'] = video_youtube;
                        json_items.push(itemAdd);

                    }
                    
                    if (element.getElementsByClassName("card-body")[0].getAttribute("type") == "picture") {
                        var picture_src;
                        if (element.getAttribute("old") != "true") {
                            var pic = element.getElementsByClassName("card-body")[0].getElementsByTagName("img")[0].getAttribute("blob_value");
                            var block = pic.split(";");
                            var contentType = block[0].split(":")[1];
                            var realData = block[1].split(",")[1];
                            var filename = "picture";
                            var pic_blob = b64toBlob(realData, contentType);
                            var formData = new FormData();
                            formData.append('picture_file', pic_blob, filename);
                            formData.append("_token", '{{ csrf_token() }}');
                            picture_src = $.ajax({
                                url: '/upload_image',
                                type: 'POST',
                                async: false,
                                data: formData,
                                processData: false,  // tell jQuery not to process the data
                                contentType: false,  // tell jQuery not to set contentType
                                success: function (data) {
                                    console.log(data);
                                }
                            })["responseText"];
                        } else {
                           
                            picture_src = element.getElementsByClassName("card-body")[0].getElementsByTagName("img")[0].getAttribute("src");
                        }
                        itemAdd["picture_title"] = element.getElementsByClassName("form-control")[0].value;
                        if(element.getElementsByClassName("form-control").length == 2){
                            itemAdd["description_image"] = element.getElementsByClassName("form-control")[1].value;
                        }
                        else{
                            itemAdd["description_image"] = element.getElementsByTagName("div")[3].textContent;
                        }
                        
                        itemAdd["picture_src"] = picture_src;
                        itemAdd["type"] = "image_upload";
                        var pic_json = new Object();
                        
                        pic_json["picture"] = itemAdd;
                        json_items.push(pic_json);

                    }
                 
                    if (element.getElementsByClassName("card-body")[0].getAttribute("type") == "video") {
                        var video_src;
                        if (element.getAttribute("old") != "true") {
                            var vid = element.getElementsByClassName("card-body")[0].getElementsByTagName("video")[0].getAttribute("blob_value");
                            var block = vid.split(";");
                            var contentType = block[0].split(":")[1];
                            var realData = block[1].split(",")[1];
                            var filename = "video";
                            var vid_blob = b64toBlob(realData, contentType);
                            var formData = new FormData();
                            formData.append('video_file', vid_blob, filename);
                            formData.append("_token", '{{ csrf_token() }}');
                            video_src = $.ajax({
                                url: '/upload_video',
                                type: 'POST',
                                async: false,
                                data: formData,
                                processData: false,  // tell jQuery not to process the data
                                contentType: false,  // tell jQuery not to set contentType
                                success: function (data) {
                                    console.log(data);
                                }
                            })["responseText"];
                        } else {
                            video_src = element.getElementsByClassName("card-body")[0].getElementsByTagName("source")[0].getAttribute("src");
                        }
                        itemAdd["video_title"] = element.getElementsByClassName("form-control")[0].value;
                        if(element.getElementsByClassName("form-control").length == 2){
                            itemAdd["description_video"] = element.getElementsByClassName("form-control")[1].value;
                        }
                        else{
                            itemAdd["description_video"] = element.getElementsByTagName("div")[3].textContent;
                        }
                        
                        itemAdd["video_src"] = video_src;
                        itemAdd["type"] = "video_upload";
                        var vid_json = new Object();
                        
                        vid_json["video"] = itemAdd;
                        json_items.push(vid_json);

                    }
                    if (element.getElementsByClassName("card-body")[0].getAttribute("type") == "audio") {
                        var audio_src;
                        if (element.getAttribute("old") != "true") {
                            var au = element.getElementsByClassName("card-body")[0].getElementsByTagName("audio")[0].getAttribute("blob_value");
                            var block = au.split(";");
                            var contentType = block[0].split(":")[1];
                            var realData = block[1].split(",")[1];
                            var filename = "audio";
                            var pic_blob = b64toBlob(realData, contentType);
                            var formData = new FormData();
                            formData.append('audio_file', pic_blob, filename);
                            formData.append("_token", '{{ csrf_token() }}');


                            audio_src = $.ajax({
                                url: '/upload_audio',
                                type: 'POST',
                                async: false,
                                data: formData,
                                processData: false,  // tell jQuery not to process the data
                                contentType: false,  // tell jQuery not to set contentType
                                success: function (data) {
                                    console.log(data);
                                }
                            })["responseText"];
                        } else {

                            audio_src = element.getElementsByClassName("card-body")[0].getElementsByTagName("audio")[0].getAttribute("src");
                        }
                        itemAdd["audio_title"] = element.getElementsByClassName("form-control")[0].value;
                        if(element.getElementsByClassName("form-control").length == 2){
                            itemAdd["description_audio"] = element.getElementsByClassName("form-control")[1].value;
                        }
                        else{
                            itemAdd["description_audio"] = element.getElementsByTagName("div")[3].textContent;
                        }
                        itemAdd["audio_src"] = audio_src;
                        itemAdd["type"] = "audio_upload";
                        var au_json = new Object();

                        au_json["audio"] = itemAdd;
                        json_items.push(au_json);

                    }

                }
                
                var json = new Object();
                var trealet = new Object();
                trealet["exec"] = "streamline";
                trealet["title"] = document.getElementById("trealet_title").value;
                trealet["author"] = document.getElementById("trealet_author").value;
                trealet["desc"] = document.getElementById("trealet_desc").value;
                trealet["language"] = document.getElementById("language").value;
                trealet["items"] = json_items;
                json["trealet"] = trealet;
                var public_mode = $('#select_mode_public').find(":selected").val();
                var key = $('#title').val();
                $.ajax({
                    url: '/edit_old_trealet',
                    type: 'POST',
                    data:{
                        title: trealet["title"].toString(),
                        json: JSON.stringify(json),
                        author: trealet["author"].toString(),
                        type : "streamline",
                        id : id_trealet,
                        mode: public_mode,
                        key: key
                    },
                    success: function (data) {

                        window.location.href = "https://trealet.com/my-trealets";
                    }
                })
            };

            let description;
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
            function convertFileToBase64(file) {
                return new Promise((resolve, reject) => {
                    const reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = () => resolve(reader.result);
                    reader.onerror = reject;
                });
            }
            window.addEventListener('load', function() {

                document.querySelector('#customFile_uploadImage').addEventListener('change', async function () {
                    if (this.files && this.files[0] && (this.files[0].type).toString().startsWith("image")) {
                        picture = document.createElement('img');
                        picture.id = "picture_upload";
                        picture.setAttribute("style", "width: 80%");
                        picture.src = URL.createObjectURL(this.files[this.files.length - 1]);
                        picture_blob = await convertFileToBase64(this.files[this.files.length - 1]);

                    }

                });

            });
            window.addEventListener('load', function() {

                document.querySelector('#customFile_uploadVideo').addEventListener('change', async function() {

                    console.log("video");
                    if (this.files && this.files[0] && (this.files[0].type).toString().startsWith("video")) {


                        video = document.createElement('video');
                        video.setAttribute("style", "width: 80%");
                        video.setAttribute("controls","");
                        video.src = URL.createObjectURL(this.files[this.files.length-1]);
                        video_blob = await convertFileToBase64(this.files[this.files.length - 1]);

                    }

                });

            });
            window.addEventListener('load', function() {

                document.querySelector('#customFile_uploadAudio').addEventListener('change', async function() {


                    if (this.files && this.files[0] && (this.files[0].type).toString().startsWith("audio")) {
                        audio = document.createElement('audio');
                        audio.setAttribute("style", "width: 80%");
                        audio.setAttribute("controls","");
                        audio.src = URL.createObjectURL(this.files[this.files.length-1]);
                        audio_blob = await convertFileToBase64(this.files[this.files.length - 1]);

                    }

                });

            });



            form.addEventListener("submit", addItem);
           
            list.addEventListener("click", removeItem);
            submit.addEventListener("click", updateItem);
            list.addEventListener("click", getItem);


   
            function addItem(e) {
                e.preventDefault();
                let list_items = document.createElement("div");
                list_items.className = "card ui-sortable-handle";
                list_items.id =  index;
                index = index + 1;
                list_items.style = "margin-top: 30px"
                let card_header = document.createElement("div");
                card_header.className = "card-header";
                let input = document.createElement("input");
                input.className = "form-control";
                input.id = "input_title"
                input.setAttribute("type", "text");
                input.setAttribute("style", "width: 90%");

                let card_body = document.createElement("div");
                card_body.className = "card-body";
                card_body.style = "text-align:center";
                let btn_add = document.createElement("div");
                btn_add.style = "margin-left: 30px;"


                let btn_link_1 = document.createElement("i");
                btn_link_1.className = "fas fa-plus update";

                btn_add.appendChild(btn_link_1)
                btn_link_1.setAttribute("data-toggle","modal");
                btn_link_1.setAttribute("data-target","#exampleModalCenter");

                let btn = document.createElement("button");
                btn.className = "btn btn-link btn-sm float-right ";
                btn.style = "margin-right: 5%;"

                let btn_link_2 = document.createElement("i");
                btn_link_2.className = "fas fa-trash  delete ";
                btn.appendChild(btn_link_2)

                card_body.appendChild(btn_add)
                card_header.appendChild(input)
                list_items.appendChild(card_header)
                list_items.appendChild(card_body)
                list_items.appendChild(btn)
                list.appendChild(list_items);


            }

            function updateItem(e) {
                let selected = document.getElementsByName('type_item');
                document.getElementsByClassName("fas fa-plus update")[0].remove();
                selected.checked = false;
                
                    for (i = 0; i < selected.length; i++) {
                        if (selected[i].checked) {
                            // selectedItem.innerHTML = '';
                            
                            if (selected[i].value == "QR_upload") {
                                let iframe = document.createElement("iframe")
                                iframe.style = "position: relative; width: 90%; height: 300px;";
                                iframe.title = "Scan QR code from camera";
                                iframe.allow = "camera";
                                iframe.setAttribute("type", "qr");
                                iframe.setAttribute("frameborder", "0");
                                iframe.onload = "this.style.height=(this.contentWindow.document.body.scrollHeight+200)+\'px\';";
                                iframe.src = "https://trealet.com/input-qr"
                                selectedItem.appendChild(iframe)
                                selectedItem.setAttribute("type", "iframe");
                                let close_btn = document.getElementById('close_modal');

                                close_btn.click();
                                var type = "qr";
                                var item_component = {type};
                                var item_index = selectedItem.parentElement.id;
                                dict_item[item_index] = item_component;
                            }
                            if (selected[i].value == "Picture_upload") {
                                let iframe = document.createElement("iframe")
                                iframe.setAttribute("style", "position: relative; width: 90%; height: 350px;");
                                iframe.setAttribute("src", "https://trealet.com/input-picture");
                                iframe.setAttribute("type", "picture");
                                iframe.setAttribute("frameborder", "0");
                                iframe.setAttribute("allow", "camera");
                                iframe.setAttribute("onload", "this.style.height=(this.contentWindow.document.body.scrollHeight+200)+'px';");
                                selectedItem.appendChild(iframe)
                                selectedItem.setAttribute("type", "iframe");
                                let close_btn = document.getElementById('close_modal');
                                close_btn.click();
                                var type = "picture";
                                var item_component = {type};
                                var item_index = selectedItem.parentElement.id;
                                dict_item[item_index] = item_component;
                            }
                            if (selected[i].value == "Audio_input") {
                                let iframe = document.createElement("iframe")
                                iframe.setAttribute("style", "position: relative; width: 90%; height: 350px;");
                                iframe.setAttribute("src", "https://trealet.com/input-audio");
                                iframe.setAttribute("frameborder", "0");
                                iframe.setAttribute("type", "audio");
                                iframe.setAttribute("allow", "camera");
                                iframe.setAttribute("onload", "this.style.height=(this.contentWindow.document.body.scrollHeight+200)+'px';");
                                selectedItem.appendChild(iframe)
                                selectedItem.setAttribute("type", "iframe");
                                let close_btn = document.getElementById('close_modal');
                                close_btn.click();
                                var type = "audio";
                                var item_component = {type};
                                var item_index = selectedItem.parentElement.id;
                                dict_item[item_index] = item_component;
                            }
                            if (selected[i].value == "Form_input") {
                                let iframe = document.createElement("iframe")
                                iframe.setAttribute("style", "position: relative; width: 90%; height: 282px;");
                                iframe.setAttribute("src", "https://trealet.com/input-form");
                                iframe.setAttribute("title", "Input data from a form");
                                iframe.setAttribute("frameborder", "0");
                                iframe.setAttribute("type", "form");
                                iframe.setAttribute("onload", "this.style.height=(this.contentWindow.document.body.scrollHeight+250)+'px';");
                                selectedItem.appendChild(iframe)
                                selectedItem.setAttribute("type", "iframe");
                                selectedItem.setAttribute("style", "border-color: #000!important;")
                                let close_btn = document.getElementById('close_modal');
                                close_btn.click();
                                var type = "form";
                                var item_component = {type};
                                var item_index = selectedItem.parentElement.id;
                                dict_item[item_index] = item_component;
                            }
                            if (selected[i].value == "Picture_input") {

                                let div = document.createElement("div")
                                div.setAttribute("style", "padding: 5%;text-align: left; ");
                                description = document.createTextNode(document.getElementById("customText_1").value);
                                div.appendChild(description);
                                picture.setAttribute("blob_value", picture_blob) ;
                                selectedItem.appendChild(picture);
                                selectedItem.setAttribute("type", "picture");
                                var picture_blob_index = selectedItem.parentElement.id;
                                var description_image = document.getElementById("customText_1").value;
                                var type = "image_upload";
                                picture = {type, picture_blob, description_image};
                                dict_item[picture_blob_index] = picture;
                                let br = document.createElement("br");
                                selectedItem.appendChild(br)
                                selectedItem.appendChild(div)
                                console.log(picture_blob);
                                let close_btn = document.getElementById('close_modal');
                                close_btn.click();
                                document.getElementById("customText_1").value = "";
                                var input = document.getElementById('customFile_uploadImage');

                                var fileListArr = Array.from(input.files)
                                fileListArr.splice(index, 1) // here u remove the file
                            }
                            if (selected[i].value == "Video_input") {

                                let div = document.createElement("div");   
                                var video_blob_index = selectedItem.parentElement.id; 
                                if(document.getElementById("link-youtube").value != ""){
                                    
                                    div.setAttribute("style", "padding: 5%;text-align: left;");
                                    description = document.createTextNode(document.getElementById("customText_2").value);
                                    div.appendChild(description)
                                    let iframe = document.createElement("iframe");
                                    iframe.setAttribute("style", "height: 500px;width: 800px;")
                                    iframe.src = document.getElementById("link-youtube").value.replace("watch?v=", "embed/");;
                                    selectedItem.appendChild(iframe);
                                    selectedItem.setAttribute("type", "video_youtube");
                                    var description_video = document.getElementById("customText_2").value;
                                    var type = "video_youtube";
                                    video_blob = iframe.src;
                                    video = {type, video_blob, description_video};
                                    document.getElementById("link-youtube").value = "";
                                    document.getElementById("customText_2").value = "";
                                }
                                else{                               
                                    let div = document.createElement("div")
                                    div.setAttribute("style", "padding: 5%;text-align: left;");
                                    description = document.createTextNode(document.getElementById("customText_2").value);
                                    div.appendChild(description)
                                    selectedItem.appendChild(video);
                                    
                                    var description_video = document.getElementById("customText_2").value;
                                    var type = "video_upload";
                                    video = {type, video_blob, description_video};
                                    document.getElementById("customText_2").value = "";
                                    var input = document.getElementById('customFile_uploadVideo');

                                    var fileListArr = Array.from(input.files)
                                    fileListArr.splice(index, 1) // here u remove the file
                                    
                                }
                                    let br = document.createElement("br");
                                    selectedItem.appendChild(br)
                                    selectedItem.appendChild(div)
                                    let close_btn = document.getElementById('close_modal');

                                    close_btn.click();
                                    
                                    dict_item[video_blob_index] = video;
                            }
                            if (selected[i].value == "Audio_upload") {

                                let div = document.createElement("div")
                                div.setAttribute("style", "padding: 5%;text-align: left;");
                                description = document.createTextNode(document.getElementById("customText_3").value);
                                div.appendChild(description)
                                audio.setAttribute("blob_value", audio_blob) ;
                                selectedItem.appendChild(audio);
                                selectedItem.setAttribute("type", "audio");
                                let br = document.createElement("br");
                                selectedItem.appendChild(br)
                                selectedItem.appendChild(div)
                                let close_btn = document.getElementById('close_modal');
                                close_btn.click();
                                var audio_blob_index = selectedItem.parentElement.id;
                                var description_audio = document.getElementById("customText_3").value;
                                var type = "audio_upload";
                                audio = {type, audio_blob, description_audio};
                                console.log(audio_blob);
                                dict_item[audio_blob_index] = audio;
                                document.getElementById("customText_3").value = "";
                                var input = document.getElementById('customFile_uploadAudio');

                                var fileListArr = Array.from(input.files)
                                fileListArr.splice(index, 1) // here u remove the file
                            }



                        }
                    }


                
            }
            function getItem(e) {

                console.log(e.target.parentElement.parentElement)
                selectedItem = e.target.parentElement.parentElement

            }
            function removeItem(e) {

                e.preventDefault();
                if (e.target.classList.contains("delete")) {
                    if (confirm("Are you to remove the selected item?")) {
                        let item = e.target.parentElement.parentElement;

                        var index = Array.prototype.indexOf.call(list.children, item);
                        list.removeChild(item);
                        selectedItem = undefined;
                        console.log(selectedItem);
                        console.log(items)

                    }
                }
            }

            function filterItem(e) {
                let filterValue = e.target.value.toLowerCase();
                let li = list.getElementsByTagName("li");
                Array.from(li).forEach(item => {
                    let i = item.firstChild.textContent;
                    console.log(i);
                    if (i.toLowerCase().indexOf(filterValue) !== -1)
                        item.style.display = "block";
                    else item.style.display = "none";
                });
            }
        </script>


    </div>
    <script>
        var items = {!! json_encode($items) !!};
        const id_trealet = {!! json_encode($id) !!};
        const json =JSON.parse( {!! json_encode($json) !!});     
        var lang = json["trealet"]["language"];
        document.getElementById("language").value = lang;
        var i = 0;
        for (var element of items) {
            dict_item[i] = Object.keys(element)[0];
            i++;
            var e_0 = document.createElement("div");
            e_0.setAttribute("old", "true");
            if(Object.keys(element)[0] == "picture"){
                e_0.setAttribute("class", "card");
                var e_1 = document.createElement("h4");
                e_1.setAttribute("class", "card-header");
                var e_7 = document.createElement("input");
                e_7.setAttribute("value", element[Object.keys(element)[0]].picture_title);
                e_7.setAttribute("id", "trealet_author");
                e_7.setAttribute("class", "form-control");
                e_7.setAttribute("style", " width: 50%");
                e_1.appendChild(e_7);
                e_0.appendChild(e_1);
                var e_2 = document.createElement("div");
                e_2.setAttribute("class", "card-body");
                e_2.setAttribute("type", "picture");
                var e_3 = document.createElement("div");
                e_3.setAttribute("style", "text-align: center;");
                var e_4 = document.createElement("img");
                e_4.setAttribute("style", "position: relative; width: 90%;");
                e_4.setAttribute("src", element[Object.keys(element)[0]].picture_src);
                e_3.appendChild(e_4);
                e_2.appendChild(e_3);
                var e_5 = document.createElement("br");
                e_2.appendChild(e_5);
                var e_6 = document.createElement("p");
                e_6.setAttribute("style", "padding: 20px");
                var e_8 = document.createElement("textarea");
                e_8.appendChild(document.createTextNode(element[Object.keys(element)[0]].description_image));
                e_8.setAttribute("id", "trealet_author");
                e_8.setAttribute("class", "form-control");
                e_8.setAttribute("style", " width: 100%");
                e_6.appendChild(e_8);
                e_2.appendChild(e_6);
                e_0.appendChild(e_2);
                let btn = document.createElement("button");
                btn.className = "btn btn-link btn-sm float-right ";
                btn.style = "margin-right: 5%;"
                let btn_link_2 = document.createElement("i");
                btn_link_2.className = "fas fa-trash  delete ";
                btn.appendChild(btn_link_2)
                e_0.appendChild(btn)
                list.appendChild(e_0);
            }
            if(Object.keys(element)[0] == "video"){


                e_0.setAttribute("class", "card");
                var e_1 = document.createElement("h4");
                e_1.setAttribute("class", "card-header");
                var e_7 = document.createElement("input");
                e_7.setAttribute("value", element[Object.keys(element)[0]].video_title);
                e_7.setAttribute("id", "trealet_author");
                e_7.setAttribute("class", "form-control");
                e_7.setAttribute("style", " width: 50%");
                e_1.appendChild(e_7);
                e_0.appendChild(e_1);
                var e_2 = document.createElement("div");
                e_2.setAttribute("class", "card-body");
                e_2.setAttribute("type", "video");
                var e_3 = document.createElement("div");
                e_3.setAttribute("style", "text-align: center;");
                var e_4 = document.createElement("video");
                e_4.setAttribute("controls", "");
                e_4.setAttribute("style", "position: relative; width: 90%;");
                var e_9 = document.createElement("source");
                e_9.setAttribute("type", "video/mp4");
                e_9.setAttribute("src", element[Object.keys(element)[0]].video_src);
                e_4.appendChild(e_9);
                e_3.appendChild(e_4);
                e_2.appendChild(e_3);
                var e_5 = document.createElement("br");
                e_2.appendChild(e_5);
                var e_6 = document.createElement("p");
                e_6.setAttribute("style", "padding: 20px");
                var e_8 = document.createElement("textarea");
                e_8.appendChild(document.createTextNode(element[Object.keys(element)[0]].description_video));
                e_8.setAttribute("id", "trealet_author");
                e_8.setAttribute("class", "form-control");
                e_8.setAttribute("style", " width: 100%");
                e_6.appendChild(e_8);
                e_2.appendChild(e_6);
                e_0.appendChild(e_2);
                let btn = document.createElement("button");
                btn.className = "btn btn-link btn-sm float-right ";
                btn.style = "margin-right: 5%;"
                let btn_link_2 = document.createElement("i");
                btn_link_2.className = "fas fa-trash  delete ";
                btn.appendChild(btn_link_2)
                e_0.appendChild(btn)
                list.appendChild(e_0);
            }
            if(Object.keys(element)[0] == "video-youtube"){
                e_0.setAttribute("class", "card");
                var e_1 = document.createElement("h4");
                e_1.setAttribute("class", "card-header");
                var e_7 = document.createElement("input");
                e_7.setAttribute("value", element[Object.keys(element)[0]].video_title);
                e_7.setAttribute("id", "trealet_author");
                e_7.setAttribute("class", "form-control");
                e_7.setAttribute("style", " width: 50%");
                e_1.appendChild(e_7);
                e_0.appendChild(e_1);
                var e_2 = document.createElement("div");
                e_2.setAttribute("class", "card-body");
                e_2.setAttribute("type", "video_youtube");
                var e_3 = document.createElement("div");
                e_3.setAttribute("style", "text-align: center;");
                var e_4 = document.createElement("iframe");
                e_4.setAttribute("style", "position: relative; height: 500px;width: 800px;");
                e_4.setAttribute("src", element[Object.keys(element)[0]].video_src);
                e_3.appendChild(e_4);
                e_2.appendChild(e_3);
                var e_5 = document.createElement("br");
                e_2.appendChild(e_5);
                var e_6 = document.createElement("p");
                e_6.setAttribute("style", "padding: 20px");
                var e_8 = document.createElement("textarea");
                e_8.appendChild(document.createTextNode(element[Object.keys(element)[0]].description_video));
                e_8.setAttribute("id", "trealet_author");
                e_8.setAttribute("class", "form-control");
                e_8.setAttribute("style", " width: 100%");
                e_6.appendChild(e_8);
                e_2.appendChild(e_6);
                e_0.appendChild(e_2);
                let btn = document.createElement("button");
                btn.className = "btn btn-link btn-sm float-right ";
                btn.style = "margin-right: 5%;"
                let btn_link_2 = document.createElement("i");
                btn_link_2.className = "fas fa-trash  delete ";
                btn.appendChild(btn_link_2)
                e_0.appendChild(btn)
                list.appendChild(e_0);
            }
            if(Object.keys(element)[0] == "audio"){


                e_0.setAttribute("class", "card");
                var e_1 = document.createElement("h4");
                e_1.setAttribute("class", "card-header");
                var e_7 = document.createElement("input");
                e_7.setAttribute("value", element[Object.keys(element)[0]].audio_title);
                e_7.setAttribute("id", "trealet_author");
                e_7.setAttribute("class", "form-control");
                e_7.setAttribute("style", " width: 50%");
                e_1.appendChild(e_7);
                e_0.appendChild(e_1);
                var e_2 = document.createElement("div");
                e_2.setAttribute("class", "card-body");
                e_2.setAttribute("type", "audio");
                var e_3 = document.createElement("div");
                e_3.setAttribute("style", "text-align: center;");
                var e_4 = document.createElement('audio');
                e_4.setAttribute("style", "width: 80%");
                e_4.setAttribute("controls","");
                e_4.src = element[Object.keys(element)[0]].audio_src;
                e_3.appendChild(e_4);
                e_2.appendChild(e_3);
                var e_5 = document.createElement("br");
                e_2.appendChild(e_5);
                var e_6 = document.createElement("p");
                e_6.setAttribute("style", "padding: 20px");
                var e_8 = document.createElement("textarea");
                e_8.appendChild(document.createTextNode(element[Object.keys(element)[0]].description_audio));
                e_8.setAttribute("id", "trealet_author");
                e_8.setAttribute("class", "form-control");
                e_8.setAttribute("style", " width: 100%");
                e_6.appendChild(e_8);
                e_2.appendChild(e_6);
                e_0.appendChild(e_2);
                let btn = document.createElement("button");
                btn.className = "btn btn-link btn-sm float-right ";
                btn.style = "margin-right: 5%;"
                let btn_link_2 = document.createElement("i");
                btn_link_2.className = "fas fa-trash  delete ";
                btn.appendChild(btn_link_2)
                e_0.appendChild(btn)
                list.appendChild(e_0);
            }

            if(Object.keys(element)[0] == "input"){
                if(element[Object.keys(element)[0]].type == "picture"){

                    e_0.setAttribute("class", "card");
                    var e_1 = document.createElement("h4");
                    e_1.setAttribute("class", "card-header");
                    var e_7 = document.createElement("input");
                    e_7.setAttribute("value", element[Object.keys(element)[0]].label);
                    e_7.setAttribute("id", "trealet_author");
                    e_7.setAttribute("class", "form-control");
                    e_7.setAttribute("style", " width: 50%");
                    e_1.appendChild(e_7);
                    var e_2 = document.createElement("div");
                    e_2.setAttribute("class", "card-body");
                    e_2.setAttribute("type", "iframe");
                    let iframe = document.createElement("iframe")
                    iframe.setAttribute("style", "position: relative; width: 90%; height: 350px;");
                    iframe.setAttribute("src", "https://trealet.com/input-picture");

                    iframe.setAttribute("frameborder", "0");
                    iframe.setAttribute("allow", "camera");
                    iframe.setAttribute("type", "picture");
                    iframe.setAttribute("onload", "this.style.height=(this.contentWindow.document.body.scrollHeight+200)+'px';");
                    e_2.appendChild(iframe);
                    e_0.appendChild(e_1);
                    e_0.appendChild(e_2);
                    let btn = document.createElement("button");
                    btn.className = "btn btn-link btn-sm float-right ";
                    btn.style = "margin-right: 5%;"
                    let btn_link_2 = document.createElement("i");
                    btn_link_2.className = "fas fa-trash  delete ";
                    btn.appendChild(btn_link_2)
                    e_0.appendChild(btn)
                    list.appendChild(e_0);
                }
                if(element[Object.keys(element)[0]].type == "audio"){

                    e_0.setAttribute("class", "card");
                    var e_1 = document.createElement("h4");
                    e_1.setAttribute("class", "card-header");
                    var e_7 = document.createElement("input");
                    e_7.setAttribute("value", element[Object.keys(element)[0]].label);
                    e_7.setAttribute("id", "trealet_author");
                    e_7.setAttribute("class", "form-control");
                    e_7.setAttribute("style", " width: 50%");
                    e_1.appendChild(e_7);
                    var e_2 = document.createElement("div");
                    e_2.setAttribute("class", "card-body");
                    e_2.setAttribute("type", "iframe");
                    let iframe = document.createElement("iframe")
                    iframe.setAttribute("style", "position: relative; width: 90%; height: 350px;");
                    iframe.setAttribute("src", "https://trealet.com/input-audio");

                    iframe.setAttribute("frameborder", "0");
                    iframe.setAttribute("allow", "audio");
                    iframe.setAttribute("type", "picture");
                    iframe.setAttribute("onload", "this.style.height=(this.contentWindow.document.body.scrollHeight+200)+'px';");
                    e_2.appendChild(iframe);
                    e_0.appendChild(e_1);
                    e_0.appendChild(e_2);
                    let btn = document.createElement("button");
                    btn.className = "btn btn-link btn-sm float-right ";
                    btn.style = "margin-right: 5%;"
                    let btn_link_2 = document.createElement("i");
                    btn_link_2.className = "fas fa-trash  delete ";
                    btn.appendChild(btn_link_2)
                    e_0.appendChild(btn)
                    list.appendChild(e_0);
                }
                if(element[Object.keys(element)[0]].type == "form"){

                    e_0.setAttribute("class", "card");
                    var e_1 = document.createElement("h4");
                    e_1.setAttribute("class", "card-header");
                    var e_7 = document.createElement("input");
                    e_7.setAttribute("value", element[Object.keys(element)[0]].label);
                    e_7.setAttribute("id", "trealet_author");
                    e_7.setAttribute("class", "form-control");
                    e_7.setAttribute("style", " width: 50%");
                    e_1.appendChild(e_7);
                    var e_2 = document.createElement("div");
                    e_2.setAttribute("class", "card-body");
                    e_2.setAttribute("type", "iframe");
                    let iframe = document.createElement("iframe")
                    iframe.setAttribute("style", "position: relative; width: 90%; height: 350px;");
                    iframe.setAttribute("src", "https://trealet.com/input-form");
                    iframe.setAttribute("type", "form");
                    iframe.setAttribute("frameborder", "0");
                    iframe.setAttribute("allow", "camera");
                    iframe.setAttribute("onload", "this.style.height=(this.contentWindow.document.body.scrollHeight+200)+'px';");
                    e_2.appendChild(iframe);
                    e_0.appendChild(e_1);
                    e_0.appendChild(e_2);
                    let btn = document.createElement("button");
                    btn.className = "btn btn-link btn-sm float-right ";
                    btn.style = "margin-right: 5%;"
                    let btn_link_2 = document.createElement("i");
                    btn_link_2.className = "fas fa-trash  delete ";
                    btn.appendChild(btn_link_2)
                    e_0.appendChild(btn)
                    list.appendChild(e_0);
                }
                if(element[Object.keys(element)[0]].type == "qr"){

                    e_0.setAttribute("class", "card");
                    var e_1 = document.createElement("h4");
                    e_1.setAttribute("class", "card-header");
                    var e_7 = document.createElement("input");
                    e_7.setAttribute("value", element[Object.keys(element)[0]].label);
                    e_7.setAttribute("id", "trealet_author");
                    e_7.setAttribute("class", "form-control");
                    e_7.setAttribute("style", " width: 50%");
                    e_1.appendChild(e_7);
                    var e_2 = document.createElement("div");
                    e_2.setAttribute("class", "card-body");
                    e_2.setAttribute("type", "iframe");
                    let iframe = document.createElement("iframe")
                    iframe.setAttribute("style", "position: relative; width: 90%; height: 350px;");
                    iframe.setAttribute("src", "https://trealet.com/input-qr");
                    iframe.setAttribute("type", "qr");
                    iframe.setAttribute("frameborder", "0");
                    iframe.setAttribute("allow", "camera");
                    iframe.setAttribute("onload", "this.style.height=(this.contentWindow.document.body.scrollHeight+200)+'px';");
                    e_2.appendChild(iframe);
                    e_0.appendChild(e_1);
                    e_0.appendChild(e_2);
                    let btn = document.createElement("button");
                    btn.className = "btn btn-link btn-sm float-right ";
                    btn.style = "margin-right: 5%;"
                    let btn_link_2 = document.createElement("i");
                    btn_link_2.className = "fas fa-trash  delete ";
                    btn.appendChild(btn_link_2)
                    e_0.appendChild(btn)
                    list.appendChild(e_0);
                }

            }


        }
        const dict_length = Object.keys(dict_item).length;
        console.log(Object.keys(dict_item).length);

    </script>
    <script>
        $('textarea').each(function () {
            this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
        }).on('input', function () {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
        document.getElementById("customText_1").setAttribute('style', 'height: 80px');
        document.getElementById("customText_2").setAttribute('style', 'height: 80px');
        document.getElementById("customText_3").setAttribute('style', 'height: 80px');
    </script>
@stop

@section('styles')
    <style>

        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 800px;
            }
            .btn-round {
                width: 40px;
                height: 40px;
                border-radius: 50%;
            }

            .btn-round.btn-lg {
                width: 48px;
                height: 48px;
            }

            .btn-round.btn-sm {
                width: 34px;
                height: 34px;
            }

            .btn-round.btn-xs {
                width: 24px;
                height: 24px;
            }
            #myLoader {
                border: 16px solid #f3f3f3; /* Light grey */
                border-top: 16px solid #3498db; /* Blue */
                border-radius: 50%;
                width: 120px;
                height: 120px;
                animation: spin 2s linear infinite;
                display: none;
                position: fixed;
                margin-left: 32%;
                margin-top: 10%;
                text-align: center;
                z-index: 9999;
            }


            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }
                100% {
                    transform: rotate(360deg);
                }
            }

            .btn-link {
                margin-right: 47.5%;
                width: 5%;
            }

            .user.media {
                float: left;
                border: 1px solid #dfdfdf;
                background-color: #fff;
                padding: 15px 20px;
                border-radius: 4px;
                margin-right: 15px;
            }

            .form-control input-solid {
                background-color: white;
            }}
        body{
            background:#E1D38A;
            background-size:cover;
            font-family:sans-serif;
        }


    </style>
@stop

