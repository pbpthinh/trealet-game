@extends('layouts.app')

@section('page-title', 'Streamline Edit')
@section('page-heading', 'Streamline Edit')

@section('breadcrumbs')
    <li class="breadcrumb-item active">
	You can edit your streamline trealet here
    </li>
@stop

@section('content')


    <script src="//code.jquery.com/jquery-1.12.4.js" defer></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js" ></script>




    <div class="container">
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <button type="button" id = "close_modal" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">


                                <h2 class="h4 mb-1">Choose your trealet item</h2>
                                <p class="small text-muted font-italic mb-4"></p>
                                <ul class="list-group" id = "list_item">
                                    <li  class="list-group-item rounded-0 d-flex align-items-center justify-content-between">
                                        <div class="custom-control custom-radio">
                                            <input value = "Picture_input" accept="image/*" onchange="loadFile(event)" name = "type_item" class="custom-control-input" id="customRadio1" type="radio" name="customRadio">
                                            <label class="custom-control-label" for="customRadio1">
                                                <p class="mb-0">Picture</p><span class="small font-italic text-muted">Người dùng có thể xem ảnh này trong trealet của bạn!</span>

                                                <input type="file" class="form-control"  />
                                                <textarea id="customText_1" placeholder= "Hãy viết mô tả cho ảnh này!"  class ="form-control"></textarea>
                                            </label>
                                        </div>
                                        <label for="customRadio1"><img src="https://icon-library.com/images/upload-icon/upload-icon-15.jpg" alt="" width="60"></label>
                                    </li>
                                    <li  class="list-group-item rounded-0 d-flex align-items-center justify-content-between">
                                        <div class="custom-control custom-radio">
                                            <input value = "Video_input" name = "type_item" class="custom-control-input" id="customRadio2" type="radio" name="customRadio">
                                            <label class="custom-control-label" for="customRadio2">
                                                <p class="mb-0">Video</p><span class="small font-italic text-muted">Người dùng có thể xem video này trong trealet của bạn!</span>
                                                <input type="file" class="form-control" id="customFile" />
                                                <textarea placeholder= "Hãy viết mô tả cho video này!"  class ="form-control"></textarea>
                                            </label>
                                        </div>
                                        <label for="customRadio1"><img src="data:image/jpeg;base64,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" alt="" width="60"></label>
                                    </li>


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
                                            <input value = "Picture_input" name = "type_item" class="custom-control-input" id="customRadio4" type="radio" name="customRadio">
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
                    <div class="modal-footer">

                        <button type="button" class="btn btn-primary submit_add_element" id="submit_add_element">Add element</button>
                    </div>
                </div>
            </div>
        </div>

            <center><h1><input placeholder="Hãy điền tên trealet" class = "form-control" style="text-align:center; height: 60px; width: 50%"></h1>
                <h4 class="text-muted"><input placeholder= "thang123"  class ="form-control" style="text-align:center; width: 25%"></h4></center>
            <div class="card">
                <h4 class="card-header">Lời giới thiệu</h4>
                <div class="card-body"><textarea class="form-control rounded-0"></textarea><p></p></div>
            </div>
            <div class="list-group" id="sortable">
            </div>


            <script>
                $(function () {
                    $("#sortable").sortable();
                });
            </script>
            <form class="form-inline mb-4" id="form">
                <button class="btn btn-sm btn-secondary" style="margin-top: 20px; text-align: center;">Add</button>

            </form>
        <form class="form-inline mb-4" id="form" >
            <button class="btn btn-sm btn-secondary" style="margin-top: 20px;margin-left: 40%; text-align: center;">Save trealet</button>

        </form>


            <script>
                let form = document.querySelector("#form");
                let list = document.querySelector("#sortable");
                let filter = document.querySelector("#filter");
                let submit = document.querySelector("#submit_add_element");
                let add = document.querySelector("#button_add_item_trealet");

                let selectedItem;
                let picture;
                let description;


                form.addEventListener("submit", addItem);
                list.addEventListener("click", removeItem);
                submit.addEventListener("click", updateItem);
                list.addEventListener("click", getItem);
                window.addEventListener('load', function() {
                    document.querySelector('input[type="file"]').addEventListener('change', function() {
                        if (this.files && this.files[0]) {
                            picture = document.createElement('img');
                            picture.setAttribute("style", "width: 80%");
                            picture.onload = () => {
                                URL.revokeObjectURL(img.src);
                            }

                            picture.src = URL.createObjectURL(this.files[0]);

                        }
                    });

                });


                function addItem(e) {
                    e.preventDefault();
                    let list_items = document.createElement("div");
                    list_items.className = "card";
                    list_items.style = "margin-top: 30px"
                    let card_header = document.createElement("div");
                    card_header.className = "card-header";
                    let input = document.createElement("input");
                    input.className = "form-control";
                    input.setAttribute("type", "text");
                    input.setAttribute("style", "width: 90%");

                    let card_body = document.createElement("div");
                    card_body.className = "card-body";
                    card_body.style = "text-align:center";

                    let btn_add = document.createElement("button");
                    btn_add.className = "btn btn-link update btn-sm float-right ";
                    btn_add.style = "margin-left: 30px;"

                    let btn_link_1 = document.createElement("i");
                    btn_link_1.className = "fas fa-plus update";
                    btn_link_1.id = "button_add_item_trealet"
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
                    console.log(selectedItem)
                    var br;
                    for (i = 0; i < selected.length; i++) {
                        if (selected[i].checked) {
                            console.log(selected[i].value)
                            if (selected[i].value == "QR_upload") {
                                let iframe = document.createElement("iframe")
                                iframe.style = "position: relative; width: 90%;";
                                iframe.title = "Scan QR code from camera";
                                iframe.allow = "camera";
                                iframe.onload = "this.style.height=(this.contentWindow.document.body.scrollHeight+200)+\'px\';";
                                iframe.src = "https://trealet.com/input-qr"
                                selectedItem.appendChild(iframe)
                                let close_btn = document.getElementById('close_modal');

                                close_btn.click();
                            }
                            if (selected[i].value == "Picture_input") {
                                let div = document.createElement("div")
                                div.style = "text-align: left"
                                description = document.createTextNode(document.getElementById("customText_1").value);
                                div.appendChild(description)
                                selectedItem.appendChild(picture);
                                let br = document.createElement("br");
                                selectedItem.appendChild(br)

                                selectedItem.appendChild(div)
                                let close_btn = document.getElementById('close_modal');

                                close_btn.click();
                            }
                        }


                    }
                }
                function getItem(e) {

                    console.log(e.target.parentElement.parentElement)
                    selectedItem = e.target.parentElement.parentElement
                    if(e.target.classList.contains("update")) {
                        e.target.parentElement.parentElement.removeChild(e.target.parentElement)

                    }
                }
                function removeItem(e) {

                    e.preventDefault();
                    if (e.target.classList.contains("delete")) {
                        if (confirm("Are you to remove the selected item?")) {
                            let item = e.target.parentElement.parentElement;
                            list.removeChild(item);
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

    <style>
        .btn-link {
            margin-right: 47.5%;
            width: 5%;
        }
    </style>
    </body>

@stop

@section('styles')
    <style>
        .options {
            margin-top: 20px;
            padding: 20px;
            background: rgba(191, 191, 191, 0.15);
        }

        .options .caption {
            font-size: 18px;
            font-weight: 500;
        }

        .option {
            margin-top: 10px;
        }

        .option > span {
            margin-right: 10px;
        }

        .option > .dx-selectbox {
            display: inline-block;
            vertical-align: middle;
            max-width: 350px;
            width: 100%;
        }



    </style>


@stop