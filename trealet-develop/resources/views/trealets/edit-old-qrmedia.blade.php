@extends('layouts.app')

@section('page-title', 'QrMedia Edit')
@section('page-heading', 'QrMedia Edit')

@section('breadcrumbs')
<li class="breadcrumb-item active">
    You can edit your QrMedia trealet here
</li>
@stop

@section('content')
<div id = "myLoader"></div>
<div class="QrMedia-composer-container">
    <div class="QrMedia-composer__header">
        <div class="header__list">
            <div class="border-left"></div>
            <ul class="tab" id="step-number">
                <li class="step-number info-tab">
                    <div tabindex="1" class="tablinks active" onclick="chooseStep(event, 'info')">Thông tin</div>
                </li>
                <li class="step-number">
                    
                    <div tabindex="1" class="tablinks" onclick="chooseStep(event, 'step1')" >
                    QR
                        <div class="question--toolbar">
                            <button class="btn btn-secondary btn-circle delete-step" data-id="step1">
                                Xóa
                            </button>
                        </div>
                    </div>
                </li>
                <li class="create-step font-weight-bold">
                    <div title="Thêm câu" id="new-step" class="tablinks ">+</div>
                </li>
            </ul>
        </div>
        <div class="header__button">
            <div class="">
                <button class="btn btn-primary btn-sm w-90" id="save">Lưu</button>
            </div>
            <div class="">
                <button class="btn btn-secondary btn-sm w-90" id="reset">Đặt lại</button>
            </div>
        </div>
    </div>
    <div class="QrMedia-composer__content" id="steps">

        <div class="step p-4" id="info">
            <form id="main-form">
                <div class="d-flex mb-2 py-1">
                    <div class="text-left w-110 font-500">Tiêu đề</div>
                    <div class="flex-grow-1">
                        <input type="text" class="w-100 form-control" name="title" placeholder="Nhập tiêu đề" id = "title">
                    </div>
                </div>
                <div class="d-flex mb-2 py-1">
                    <div class="text-left w-110 font-500">Mô tả</div>
                    <div class="flex-grow-1">
                        <textarea id = "desc" class="w-100 no-resize form-control" name="des" rows="3"
                            placeholder="Nhập mô tả"></textarea>
                    </div>
                </div>
                <div class="d-flex mb-2 py-1">
                    <div class="text-left w-110 font-500">Ngôn ngữ</div>
                    <div class="flex-grow-1">
                    <select class="w-100 no-resize form-control" id = "language" aria-label="Default select example" rows="4">
                        <option value="vn">Tiếng Việt</option>
                        <option value="en">Tiếng Anh</option>
                        <option value="fr">Tiếng Pháp</option>
                    </select>
                     </div>
                </div>
            </form>
        </div>
        <div class="step d-none h-full" data-id="1" id="step1">
            <form class="h-full">
                <div class="flex-grow-1 d-flex main-block d-flex justify-content-between h-full"
                    style="position: relative">
                    <div class="flex-grow-1 overflow-y-auto form-wrap">
                        <div class="main-data">
                            <div class="wrap-type" id="display">
                                <br><br>
                                <h4 class="text-center">Hiển thị</h4>
                                <div class="p-2">
                                    <div class="d-flex align-items-center">
                                        <label style="min-width: 120px;text-align:center" for="">Nhập mã hiện vật</label>
                                        <input id = "code-artifact-1" class="description form-control mb-2 ml-2 code"></input>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <label style="min-width: 120px;text-align:center" for="">Tên hiện vật</label>
                                        <input id = "name-artifact-1" class="description form-control mb-2 ml-2 name"></input>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        
                                        <label style="min-width: 120px;text-align:center;position: relative;" for=""><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" /> Link</label>
                                        <input id = "link" class="description form-control mb-2 ml-2 link" disabled></input>
                                        
                                    </div>
                                    
                                    <div class="d-flex">
                                        <div class="w-100" style="text-align: center">
                                            <div class="custom-control custom-radio" style = "text-align: center;" id="upload-form">
                                                <label class="upload-field upload-field-label" style="width: 25%; margin-left: 38%;"
                                                    for="upload-field">Tải lên</label>
                                                    <span id="desc-upload" class="small font-italic text-muted">Hệ thống chấp nhận file mp3,wav và file mp4!</span>
                                                <input type="file" class="form-control d-none upload-field-input"
                                                    id="upload-field" />
                                                    <br>
                                                <div class="upload-field-preview-container"  style = "text-align: center;height: 300px; width: 50%; margin-left: 25%" id="file-preview-container">
                                                
                                                
                                            </div>
                                        </div>
                                        <ul id="sortable1" style="display: none;"
                                            class="flex-grow-1 connectedSortable connectedSortable1 py-2 px-2 list-group border"
                                            >
                                            <div id="qrcode-step1" class="qr-container"></div>
                                        </ul>
                                    </div>
                                </div>
                                
                            </div>
                            
                            </div>
                        </div>
                    </div>
                   
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script src="../js/utf8/utf8-font.js"></script>
<script href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.0/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip-utils/0.1.0/jszip-utils.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>

<script>
(function() {
    $.ajax({
        url: "{{ route('qrMedia-edit.tree-folder') }}",
        success: function(res) {
            let data = JSON.parse(res);
            $('#tree').treeview({
                data: data,
                levels: 10,
            }).on('nodeSelected', function(event, data) {
                showItem(data.id);
            });
        },
        error: function() {}
    });
    $("#step1 #sortable1, #sortable2").sortable({
        connectWith: ".connectedSortable",
        cursor: "grabbing"
    }).disableSelection();
})()


function deleteAnswer(e) {
    e.target.parentElement.remove()
}

function addAnswer(e) {
    const addAnswerContainerEle = e.target.parentElement

    $(
        `
            <div class="form-check mb-1 answer d-flex align-items-center">
                <input type="radio" style="width: 16px; height: 16px;" class="form-check-input mr-2" value="1" name="answer">
                <input type="text" name="textAnswer" id="" class="answerText form-control">
                <button class="btn btn-secondary btn-circle ml-2" onclick="deleteAnswer(event)">
                    Xóa
                </button>
            </div>
            `
    ).insertBefore(addAnswerContainerEle)
}

function onChangeTimeLimit(e) {
    const timeInputEle = e.target.parentElement.parentElement.querySelector(".time")

    if (e.target.checked) {
        timeInputEle.value = ''
        timeInputEle.setAttribute("disabled", true)
    } else {
        timeInputEle.removeAttribute("disabled")
    }
}

function onDeleteStep(e) {
    var index = document.getElementsByClassName("tablinks active")[0].getAttribute("onclick").replace("chooseStep(event, 'step" , "").replace("')", "");
    const currentSteps = $('#step-number li').length - 1;
    if (Number(currentSteps) == 2) {
        showMessageBox({
            title: 'Không thể xóa',
            message: `Không thể xóa câu. Bạn cần có ít nhất một câu.`,
            buttonConfirm: 'Đồng ý',
            hideButtonCancel: true,
        })
        return false;
    }
    showMessageBox({
        title: 'Xóa câu',
        message: `Bạn chắc chắn muốn xóa câu này?`,
        buttonConfirm: 'Xóa',
        buttonCancel: 'Hủy'
    }).then(res => {
        if (!res) return
        e.preventDefault();
        $('#step-number').find('.step-number .active').closest('li').nextAll().get().forEach(function(element) {
            if (!$(element).hasClass('create-step')) {
                $(element).find('a').text(Number($(element).text()) - 1);
            }
        });
        $('#step-number').find('.step-number .active').closest('li').remove();
        $('#step-number').find('.step-number:first-child .tablinks').addClass('active');
        $('#steps').find('.step:first-child').removeClass('d-none');
        document.getElementById("step" + String(index)).remove();
    }).catch(() => {})
}

function showMessageBox(option) {
    option ??= {}
    return new Promise((resolve, reject) => {
        const div = document.createElement('div')
        const id = Math.random().toString().split('.').pop()
        div.setAttribute("id", id)
        div.innerHTML = `
                <div class="dialog">
                    <div class="dialog__modal"></div>
                    <div class="dialog__container">
                            <div class="dialog__title">${option.title}</div>    
                            <div class="dialog__content">${option.message}</div> 
                            <div class="dialog__footer">
                                ${!option.hideButtonCancel ? `<button class="btn-secondary">${option.buttonCancel}</button>` : ""} 
                                <button class="btn-primary">${option.buttonConfirm}</button> 
                            </div>  
                    </div>
                </div>
            `
        const close = (callback) => {
            $('body')[0].removeChild(div)
            callback && callback()
        }
        const eleButtonPrimary = div.querySelector('button.btn-primary')
        if (eleButtonPrimary) {
            eleButtonPrimary.onclick = () => close(() => resolve(true))
        }
        const eleButtonSecondary = div.querySelector('button.btn-secondary')
        if (eleButtonSecondary) {
            eleButtonSecondary.onclick = () => close(() => reject(true))
        }
        $('body')[0].appendChild(div)
    })
}

function chooseType(e, type) {
    e.preventDefault();
    $(e.target).closest('.main-block')
        .find('.tab-type li div')
        .removeClass('active');
    $(e.target).addClass('active');
    $(e.target).closest('.main-block')
        .find('.wrap-type')
        .addClass('d-none');
    $(e.target).closest(`.main-block`)
        .find(`#${type}`)
        .removeClass('d-none');
}

function chooseStep(e, step) {
    if (e.target.nodeName?.toLocaleLowerCase() === 'button') return
    e.preventDefault();
    $('#steps .step').addClass('d-none');
    $(`#${step}`).removeClass('d-none');
    $('#step-number .tablinks').removeClass('active');
    $(e.target).addClass('active');
}

function showItem(donViId, stepNumber = 1) {
    $.ajax({
        url: "{{ route('qrMedia-edit.image') }}",
        data: {
            donVi: donViId
        },
        success: (response) => {
            const ungdung = JSON.parse(response);
            if (ungdung.length == 0) {
                $(`#step${stepNumber} #sortable2`)
                    .empty()
                    .append(`No Data`);
            } else {
                $(`#step${stepNumber} #sortable2`)
                    .empty()
                    .append(JSON.parse(response).map((item, index) => (
                        `<li class="item-grab list-group-item ui-state-default text-break" data-id="${item.id}">${item.title}</li>`
                    )));
            }
        }
    })
}

function addStep(){
    const currentStepsText = $('#step-number li:not(:first-child):not(:last-child)').length;
    var last_tab = document.getElementsByClassName("tablinks")[document.getElementsByClassName("tablinks").length-2];
    var index_step = String(Number(String(last_tab.getAttribute("onclick")).replace("chooseStep(event, 'step","").replace("')","")));
    const currentSteps = Number($('#steps .step:last-child').attr('data-id'));
    $('#step-number .step-number .tablinks')
        .removeClass('active');
    $(`<li class="step-number">
        <div tabindex="1" class="tablinks active" onclick="chooseStep(event, 'step${currentSteps + 1}')">
                    QR
                    <div class="question--toolbar">
                        <button class="btn btn-secondary btn-circle delete-step" data-id="step${currentStepsText + 1}" onclick="onDeleteStep">
                            Xóa
                        </button>
                    </div>
        </div>
        </li>`)
        .insertAfter('.step-number:last');
    let eleTab = $('ul.tab')[0]
    eleTab?.scrollTo({
        left: eleTab?.scrollWidth,
        behavior: 'smooth',
    })
    $(`#steps .step`).addClass('d-none');
    sortable1
    const html =
        `<div class="step" data-id="${currentSteps + 1}" id="step${currentSteps + 1}"><form class="h-full">${$(`#step${index_step}`).html()}</form><div>`;
    const element = $(html);
    element.find('.delete-step').removeAttr('data-id').attr('data-id', `step${currentSteps + 1}`);
    element.find('input:not([name=answer])').val('');
    element.find('textarea').val('');
    element.find('.tab-type li div').removeClass('active');
    element.find('.tab-type li:first-child div').addClass('active');
    element.find('input[name=answer]').attr('checked', false)
    element.find('.wrap-type').addClass('d-none');
    element.find('.wrap-type:first-child').removeClass('d-none');
    element.find('#sortable2, #sortable1').empty();
    element.find('.answer-box').removeClass('border border-danger');
    element.find('.answer-box').find('.error-answer').addClass('d-none').text('');
    element.find('.upload-field-preview').removeAttr('src');
    const newIdUploadField = Math.random().toString()
    element.find('.upload-field-input').attr('id', newIdUploadField)
    element.find('.upload-field-label').attr('for', newIdUploadField)
    element.find('.upload-field-preview').attr('id', newIdUploadField + '-preview')
    element.find('.isUnlimitedTime').removeAttr('checked')
    element.find('#file-preview-container').empty();
    var qr = document.createElement("div");
    qr.id = "qrcode";
    element.find('#quizz .answer-box').html(`
            <div class="d-flex align-items-center">
                <label style="min-width: 60px;text-align:center" for="">Câu hỏi</label>
                <input type="text" placeholder="Question" class="form-control mb-2" name="question">
            </div>
            <div class="form-check mb-1 answer d-flex align-items-center">
                <input type="radio" style="width: 16px; height: 16px;" class="form-check-input mr-2" value="1" name="answer">
                <input type="text" name="textAnser1" id="" class="answerText form-control">
                <button class="btn btn-secondary btn-circle ml-2" onclick="deleteAnswer(event)">
                    Xóa
                </button>
            </div>
            <div class="form-check mb-1 answer d-flex align-items-center">
                <input type="radio" style="width: 16px; height: 16px;" class="form-check-input mr-2" value="2" name="answer">
                <input type="text" name="textAnser2" id="" class="answerText form-control">
                <button class="btn btn-secondary btn-circle ml-2" onclick="deleteAnswer(event)">
                    Xóa
                </button>
            </div>
            <div class="form-check mb-1 answer d-flex align-items-center">
                <input type="radio" style="width: 16px; height: 16px;" class="form-check-input mr-2" value="3" name="answer">
                <input type="text" name="textAnser3" id="" class="answerText form-control">
                <button class="btn btn-secondary btn-circle ml-2" onclick="deleteAnswer(event)">
                    Xóa
                </button>
            </div>
            <div class="form-check mb-1 answer d-flex align-items-center">
                <input type="radio" style="width: 16px; height: 16px;" class="form-check-input mr-2" value="4" name="answer">
                <input type="text" name="textAnser4" id="" class="answerText form-control">
                <button class="btn btn-secondary btn-circle ml-2" onclick="deleteAnswer(event)">
                    Xóa
                </button>
            </div>
            <div class="form-check mb-1 answer">
                <div class="add-answer" onclick="addAnswer(event)">
                    Thêm câu trả lời
                </div>
            </div>
            <p class="text-danger error-answer d-none mb-0"></p>
        `)
    element.appendTo('#steps');
    var last_tab = document.getElementsByClassName("tablinks")[document.getElementsByClassName("tablinks").length-2];
    var index_step = String(Number(String(last_tab.getAttribute("onclick")).replace("chooseStep(event, 'step","").replace("')","")));
     
    var code_artifact = document.getElementsByClassName("description form-control mb-2 ml-2 code")[document.getElementsByClassName("description form-control mb-2 ml-2 code").length-1];    
    code_artifact.id = "code-artifact-" + index_step;
    var name_artifact = document.getElementsByClassName("description form-control mb-2 ml-2 name")[document.getElementsByClassName("description form-control mb-2 ml-2 name").length-1];    
    name_artifact.id = "name-artifact-" + index_step;

    var qr_container = document.createElement("div");
    qr_container.id = "qrcode-step" + index_step;
    document.getElementsByTagName("body")[0].appendChild(qr_container);
    document.getElementsByClassName("upload-field-preview-container")[document.getElementsByClassName("upload-field-preview-container").length-1].removeAttribute("data");
    document.getElementById("step" + index_step).querySelector("#link").disabled = true;
    document.getElementById("step" + index_step).querySelector("#upload-form").setAttribute("style", "display:block;text-align: center;");
    document.getElementById("step" + index_step).querySelector("#desc-upload").textContent = "Hệ thống chấp nhận file mp3,wav và file mp4!";
    function updateCheckBox(){
        if (linkInput.checked) {
            document.getElementById("step" + index_step).querySelector("#link").disabled = false;
            document.getElementById("step" + index_step).querySelector("#upload-form").setAttribute("style", "display:none");
        } else {
            document.getElementById("step" + index_step).querySelector("#link").disabled = true;
            document.getElementById("step" + index_step).querySelector("#upload-form").setAttribute("style", "display:block;text-align: center;");
        }
    }
    var linkInput = document.getElementById("step" + index_step).querySelector("#flexCheckDefault");
    linkInput.onchange = updateCheckBox;
    $(document).on('change', `#step${index_step} .upload-field-input`, async function() {
        if(this.files[this.files.length - 1].type != "video/mp4" && this.files[this.files.length - 1].type != "audio/mpeg"&& this.files[this.files.length - 1].type != "audio/wav"){
            alert("Vui lòng nhập đúng định dạng file (mp3, wav, mp4)!");
            return;
        }
        else{
            document.getElementById("step" + index_step).querySelector("#desc-upload").textContent="File bạn vừa tải lên: " + this.files[this.files.length - 1].name;
        }
        if(this.files[this.files.length - 1].type == "audio/mpeg"|| this.files[this.files.length - 1].type == "audio/wav"){
            var audio = document.createElement("audio");
            audio.controls = true
            var source = document.createElement("source");
            source.setAttribute("src",URL.createObjectURL(this.files[this.files.length - 1]));
            source.setAttribute("type","audio/mpeg");
            audio.appendChild(source);

            var container = document.getElementById("step" + index_step).querySelector("#file-preview-container");
            container.setAttribute("type", "audio");
            while (container.firstChild) {
                container.removeChild(container.firstChild);
            }
            container.setAttribute("data", await convertFileToBase64(this.files[this.files.length - 1])); 
            container.append(audio);
        }
        if(this.files[this.files.length - 1].type == "video/mp4"){
            var video = document.createElement("video");
            video.setAttribute("width", "100%");
            video.setAttribute("height", "100%")
            video.controls = true
            var source = document.createElement("source");
            source.setAttribute("src",URL.createObjectURL(this.files[this.files.length - 1]));
            source.setAttribute("type","video/mp4");
            video.appendChild(source);

            var container = document.getElementById("step" + index_step).querySelector("#file-preview-container");
            container.setAttribute("type", "video");
            while (container.firstChild) {
                container.removeChild(container.firstChild);
            }
            container.setAttribute("data", await convertFileToBase64(this.files[this.files.length - 1])); 
            container.append(video);
        }
        
    
    });
}
function onAddStep(e) {
    e.preventDefault();
    addStep();
}

function onReset(e) {
    showMessageBox({
        title: 'Đặt lại',
        message: `Bạn chắc chắn muốn đặt lại tất cả các câu?`,
        buttonConfirm: 'Đồng ý',
        buttonCancel: 'Hủy'
    }).then(res => {
        if (!res) return
        e.preventDefault();
        $('#steps .step:nth-child(2)').removeClass('d-none');
        $('#steps .step:not(:first-child):not(#step1)').remove();
        $('#step-number .step-number:nth-child(2) .tablinks').addClass('active');
        $('#step-number .step-number:not(:first-child):not(:nth-child(2))').remove();
    }).catch(() => {})
}

function convertFileToBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = reject;
    });
}

function validateAndGetFormData(e) {
    const items = [];
    let validData = true;
    e.preventDefault();
    let formData = new FormData();
    $('#main-form').serializeArray().forEach(function({
        name,
        value
    }, index) {
        formData.append(name, value.replace(/"/g, "'"));
    });
    $('#steps').find('.step:not(:first-child)')
        .get().forEach(function(item, index) {
            let step = $(item).find('.main-block .main-data .wrap-type:not(.d-none)').get();
            const type = $(step).attr('id');
            switch (type) {
                case 'display': {
                    formData.append(`items[${index}][index]`, index);
                    formData.append(`items[${index}][type]`, 'Display');
                    formData.append(`items[${index}][title]`, $(step).find('.suggest').val().replace(/"/g, "'"));
                    formData.append(`items[${index}][description]`, $(step).find('.description').val().replace(/"/g,
                        "'"));
                    formData.append(`items[${index}][youtube]`, $(step).find('.youtube').val().replace(/"/g, "'"));
                    formData.append(`${index}`, $(step).find('.upload-field-input')[0]?.files[0]);
                    break;
                }
                case 'qr': {
                    formData.append(`items[${index}][index]`, index);
                    formData.append(`items[${index}][type]`, 'QR');
                    formData.append(`items[${index}][hint]`, $(step).find('.hint').val().replace(/"/g, "'"));
                    formData.append(`items[${index}][code]`, $(step).find('.code').val().replace(/"/g, "'"));
                    break;
                }
                case 'quizz': {
                    const answersEle = $(step).find('input[name=answer]').get().forEach((ele, indexAnswer) => {
                        ele.value = (indexAnswer + 1) + ''
                    })
                    const answer = $(step).find('input[name=answer]').filter(':checked').first().val()
                    formData.append(`${index}`, $(step).find('.upload-field-input')[0].files[0]);
                    formData.append(`items[${index}][index]`, index);
                    formData.append(`items[${index}][type]`, 'Quizz');
                    formData.append(`items[${index}][question]`, $(step).find('input[name=question]').val().replace(
                        /"/g, "'"));
                    $(item).find('.answer .answerText').get().forEach(function(item, i) {
                        formData.append(`items[${index}][ListOption][${i}][id]`, i + 1);
                        formData.append(`items[${index}][ListOption][${i}][text]`, $(item).val().replace(
                            /"/g, "'"));
                    });
                    formData.append(`items[${index}][answer]`, answer);
                    if (answer) {
                        $(step).find('.answer-box').removeClass('border border-danger');
                        $(step).find('.answer-box').find('.error-answer').addClass('d-none').text('');
                        validData = true;
                    } else {
                        $(step).find('.answer-box').addClass('border border-danger');
                        $(step).find('.answer-box').find('.error-answer').removeClass('d-none').text(
                            'Chọn câu trả lời');
                        validData = false;
                    }
                    formData.append(`items[${index}][hint]`, ($(step).find('.hint').first().val() || '').replace(
                        /"/g, "'"));
                    break;
                }
                case 'audio': {
                    formData.append(`items[${index}][index]`, index);
                    formData.append(`items[${index}][type]`, 'Audio');
                    formData.append(`items[${index}][hint]`, $(step).find('.suggest_audio').val().replace(/"/g,
                        "'"));
                    break;
                }
                case 'picture': {
                    formData.append(`items[${index}][index]`, index);
                    formData.append(`items[${index}][type]`, 'Picture');
                    formData.append(`items[${index}][hint]`, $(step).find('.suggest_picture').val().replace(/"/g,
                        "'"));
                    break;
                }
            }
            formData.append(`items[${index}][key]`, Date.now());
            formData.append(`items[${index}][score]`, $(step).parent().find('.score').first().val().replace(/"/g,
                "'"));
            formData.append(`items[${index}][time]`, ($(step).parent().find('.time').first().val() || '0').replace(
                /"/g, "'"));
            formData.append(`items[${index}][isUnlimitedTime]`, ($(step).parent().find('.isUnlimitedTime') || [])[0]
                ?.checked || '');
            $(step).find('#sortable1 li').each(function(i, el) {
                formData.append(`items[${index}][image][${i}][id]`, Number($(el).attr('data-id')));
                formData.append(`items[${index}][image][${i}][value]`, $(el).text().replace(/"/g, "'"));
            });
        });
    return {
        validData,
        formData
    }
}

$(document).on('click', '#step-number #new-step', onAddStep);

$(document).on('click', '.delete-step', onDeleteStep);

$(document).on('click', '#reset', onReset);

$(document).on('click', 'input[name=answer]', function() {
    $(this).closest('.answer-box').removeClass('border border-danger');
    $(this).closest('.answer-box').find('.error-answer').addClass('d-none').text('');
});

$(document).on('change', '#step1 .upload-field-input', async function() {
    if(this.files[this.files.length - 1].type != "video/mp4" && this.files[this.files.length - 1].type != "audio/mpeg"&& this.files[this.files.length - 1].type != "audio/wav"){
            alert("Vui lòng nhập đúng định dạng file (mp3, wav, mp4)!");
            return;
        }
        else{
            document.getElementById("step1").querySelector("#desc-upload").textContent="File bạn vừa tải lên: " + this.files[this.files.length - 1].name;
        }
        if(this.files[this.files.length - 1].type == "audio/mpeg"|| this.files[this.files.length - 1].type == "audio/wav"){
            var audio = document.createElement("audio");
            audio.controls = true
            var source = document.createElement("source");
            source.setAttribute("src",URL.createObjectURL(this.files[this.files.length - 1]));
            source.setAttribute("type","audio/mpeg");
            audio.appendChild(source);

            var container = document.getElementById("step1").querySelector("#file-preview-container");
            container.setAttribute("type", "audio");
            while (container.firstChild) {
                container.removeChild(container.firstChild);
            }
            container.setAttribute("data", await convertFileToBase64(this.files[this.files.length - 1])); 
            container.append(audio);
        }
        if(this.files[this.files.length - 1].type == "video/mp4"){
            var video = document.createElement("video");
            video.setAttribute("width", "100%");
            video.setAttribute("height", "100%")
            video.controls = true
            var source = document.createElement("source");
            source.setAttribute("src",URL.createObjectURL(this.files[this.files.length - 1]));
            source.setAttribute("type","video/mp4");

            video.appendChild(source);

            var container = document.getElementById("step1").querySelector("#file-preview-container");
            while (container.firstChild) {
                container.removeChild(container.firstChild);
            }
            container.setAttribute("type", "videoS");
            container.innerHTML = "";
            container.setAttribute("data", await convertFileToBase64(this.files[this.files.length - 1])); 
            container.append(video);
        }
});
$(document).on('click', '#save', async function(e) {
    document.getElementsByClassName("QrMedia-composer-container")[0].style.opacity = 0.1;
    document.getElementById("myLoader").style.display = "block";

    setTimeout(function(){
        saveTrealet();
    },500);
});
function saveTrealet() {
    var pdf = new jsPDF();
    pdf.addFileToVFS("Amiri-Regular.ttf", amiriFont);
    pdf.addFont("Amiri-Regular.ttf", "Amiri", "normal");
	pdf.setFont("Amiri");
    
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
    var json = new Object();    
    var qrMedia = new Object();
    qrMedia["exec"] = "qrmedia";
    qrMedia["title"] = document.getElementById("title").value;
    if(qrMedia["title"] == ""){
        alert("Cần nhập tên của kịch bản!");
        document.getElementsByClassName("QrMedia-composer-container")[0].style.opacity = 1;
        document.getElementById("myLoader").style.display = "none";
        return;
    }
    for(var i = 0 ; i < document.getElementsByClassName("description form-control mb-2 ml-2 code").length; i ++){
    var name = document.getElementsByClassName("description form-control mb-2 ml-2 code")[i].value;
        if(!document.getElementsByClassName("form-check-input")[i].checked){
            if(name == ""||document.getElementsByClassName("upload-field-preview-container")[i].getAttribute("data") == null){
                alert("Bạn chưa hoàn thành kịch bản!");
                document.getElementsByClassName("QrMedia-composer-container")[0].style.opacity = 1;
                document.getElementById("myLoader").style.display = "none";
                return;
            }
        
        }
        else{
            if(name == ""||document.getElementsByClassName("description form-control mb-2 ml-2 link")[i].value == ""){
                alert("Bạn chưa hoàn thành kịch bản!");
                document.getElementsByClassName("QrMedia-composer-container")[0].style.opacity = 1;
                document.getElementById("myLoader").style.display = "none";
                return;
            }
        }
    }
    qrMedia["language"] = document.getElementById("language").value;
    
    qrMedia["desc"] = document.getElementById("desc").value;

    var json_items = [];
    var list_qrs = [];
    var nameArtifact = [];
    var filenames = [];
    for(var i = 0 ; i < document.getElementsByClassName("description form-control mb-2 ml-2 code").length; i ++){
        var item = new Object();
        item["id"] = document.getElementsByClassName("description form-control mb-2 ml-2 code")[i].value;
        item["name"] = document.getElementsByClassName("description form-control mb-2 ml-2 name")[i].value;
        var indexId = String(document.getElementsByClassName("description form-control mb-2 ml-2 code")[i].id).replace("code-artifact-","");
        filenames.push(item["id"] );
        nameArtifact.push(item["name"] );
        list_qrs.push(indexId);
    
        if(!document.getElementsByClassName("form-check-input")[i].checked){
            if (document.getElementsByClassName("upload-field-preview-container")[i].getAttribute("type") == "audio") {
                    if(document.getElementsByClassName("upload-field-preview-container")[i].getElementsByTagName("audio")[0].getAttribute("type") == "old-data"){
                        item["src"] = document.getElementsByClassName("upload-field-preview-container")[i].getElementsByTagName("source")[0].src.replace("https://trealet.com", "..");
                        item["type"] = "audio";
                    }
                     else{
                            var vid = document.getElementsByClassName("upload-field-preview-container")[i].getAttribute("data");
                            console.log(vid);
                            var block = vid.split(";");
                            var contentType = block[0].split(":")[1];
                            var realData = block[1].split(",")[1];
                            var filename = "audio";
                            var aud_blob = b64toBlob(realData, contentType);
                            var formData = new FormData();
                            formData.append('audio_file', aud_blob, filename);
                            formData.append("_token", '{{ csrf_token() }}');
                            var audio_src = $.ajax({
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
                            item["src"] = audio_src;
                            item["type"] = "audio";
                    }
                }
            if (document.getElementsByClassName("upload-field-preview-container")[i].getAttribute("type") == "video") {
                    if(document.getElementsByClassName("upload-field-preview-container")[i].getElementsByTagName("video")[0].getAttribute("type") == "old-data"){
                        item["src"] = document.getElementsByClassName("upload-field-preview-container")[i].getElementsByTagName("source")[0].src.replace("https://trealet.com", "..");
                        item["type"] = "video";
                    }
                    else{
                        var vid = document.getElementsByClassName("upload-field-preview-container")[i].getAttribute("data");
                            var block = vid.split(";");
                            var contentType = block[0].split(":")[1];
                            var realData = block[1].split(",")[1];
                            var filename = "video";
                            var vid_blob = b64toBlob(realData, contentType);
                            var formData = new FormData();
                            formData.append('video_file', vid_blob, filename);
                            formData.append("_token", '{{ csrf_token() }}');
                            var video_src = $.ajax({
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
                            item["src"] = video_src;
                            item["type"] = "video";
            }
        }                               
            json_items.push(item);
        }
        else{
            item["src"] = document.getElementsByClassName("description form-control mb-2 ml-2 link")[i].value;
            item["type"] = "link";
            json_items.push(item);
        }
    }
    var z =0;
    pdf.setFontSize(20);
    pdf.text(20, 20, qrMedia["title"]);
    pdf.setFontSize(14);
    for(var i = 0 ; i < filenames.length; i ++){
        var qrcode = new QRCode("qrcode-step" + list_qrs[i] , {
                width: 150,
                height: 150,
                colorDark : "#000000",
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.H
        });

        function makeCode() {
            qrcode.makeCode(filenames[i]);
        }
        makeCode();
        canvas = document.getElementById("qrcode-step" + list_qrs[i]).getElementsByTagName("canvas")[0];
        var imgData = canvas.toDataURL("image/jpeg", 1.0);
        
        if(i % 4 == 0 && i/4 != 0) {
            pdf.addPage();
            pdf.setFontSize(20);
            pdf.text(20, 20, qrMedia["title"]);
            pdf.setFontSize(14);
            z = 0;
        }     
        pdf.text(80, 50 + z*60, "ID: " + filenames[i]);
        pdf.text(80, 60 + z*60 , nameArtifact[i]);
        pdf.addImage(imgData, 'JPEG', 25, 40 + z*60);     
        
        var z = z + 1;
        setTimeout(() => { }, 5000);
    }
    qrMedia["items"] = json_items;
    json["qrmedia"] = qrMedia;
    pdf.save('qr-' + qrMedia["title"] +'.pdf');
    $.ajax({
        url: '/edit_old_trealet',
        type: 'POST',
        data:{
        title: qrMedia["title"].toString(),
        json: JSON.stringify(json),
        type : "qrmedia",
        id: id_trealet,
        key: "",
        items :json_items,
        lang: qrMedia["language"]
        },
        success: function (data) {
                window.location.href = "https://trealet.com/my-trealets";
        }
    })   
};
</script>
<script>
        var tr = {!! json_encode($tr) !!};
        const id_trealet = {!! json_encode($id) !!};
        const json =  JSON.parse(tr["json"]);
        document.getElementById("title").value = tr["title"];
        if(json["qrmedia"]["desc"]!= ""){
            document.getElementById("desc").value = json["qrmedia"]["desc"];
        }
        document.getElementById("language").value = json["qrmedia"]["language"];

        const items =  json["qrmedia"]["items"];
        document.getElementById("step1").querySelector("#code-artifact-1").value = items[0]["id"];
        document.getElementById("step1").querySelector("#name-artifact-1").value = items[0]["name"];
        
        if(items[0]["type"]== "video"){
            var video = document.createElement("video");
            video.setAttribute("width", "100%");
            video.setAttribute("height", "100%");
            video.setAttribute("type","old-data");
            video.controls = true;

            var source = document.createElement("source");
            source.setAttribute("src",items[0]["src"]);
            source.setAttribute("type","video/mp4");
            video.appendChild(source);

            document.getElementById("step1").querySelector("#file-preview-container").appendChild(video);
            document.getElementById("step1").querySelector("#file-preview-container").setAttribute("type", "video");
            document.getElementById("step1").querySelector("#file-preview-container").setAttribute("data", "old");
        }
        if(items[0]["type"]== "audio"){
            var audio = document.createElement("audio");
            audio.setAttribute("width", "100%");
            audio.setAttribute("height", "100%");
            audio.controls = true;
            audio.setAttribute("type","old-data");

            var source = document.createElement("source");
            source.setAttribute("src",items[0]["src"]);
            source.setAttribute("type","audio/mpeg");
            audio.appendChild(source);
            
            document.getElementById("step1").querySelector("#file-preview-container").appendChild(audio);
            document.getElementById("step1").querySelector("#file-preview-container").setAttribute("type", "audio");
            document.getElementById("step1").querySelector("#file-preview-container").setAttribute("data", "old");
        }
        if(items[0]["type"]== "link"){
            document.getElementById("step1").querySelector("#link").disabled = false;
            document.getElementById("step1").querySelector("#link").value = items[0]["src"];
            document.getElementById("step1").querySelector("#flexCheckDefault").checked = true;
            document.getElementById("step1").querySelector("#upload-form").setAttribute("style", "display:none");
            function updateCheckBox1(){
                if (document.getElementById("step1").querySelector("#flexCheckDefault").checked) {
                    document.getElementById("step1").querySelector("#link").disabled = false;
                    document.getElementById("step1").querySelector("#upload-form").setAttribute("style", "display:none");
                } else {
                    document.getElementById("step1").querySelector("#link").disabled = true;
                    document.getElementById("step1").querySelector("#upload-form").setAttribute("style", "display:block;text-align: center;");
                }
            }
            document.getElementById("step1").querySelector("#flexCheckDefault").onchange = updateCheckBox1;
            
        }
        for(var i = 1 ; i < items.length; i++){
            addStep();
            document.getElementById("step" + String(i+1)).querySelector("#code-artifact-" + String(i+1)).value = items[i]["id"];
            document.getElementById("step" + String(i+1)).querySelector("#name-artifact-" + String(i+1)).value = items[i]["name"];
        if(items[i]["type"]== "video"){
            var video = document.createElement("video");
            video.setAttribute("width", "100%");
            video.setAttribute("height", "100%");
            video.setAttribute("type","old-data");
            video.controls = true;

            var source = document.createElement("source");
            source.setAttribute("src",items[i]["src"]);
            source.setAttribute("type","video/mp4");
            video.appendChild(source);

            document.getElementById("step" + String(i+1)).querySelector("#file-preview-container").appendChild(video);
            document.getElementById("step"+ String(i+1)).querySelector("#file-preview-container").setAttribute("type", "video");
            document.getElementById("step" + String(i+1)).querySelector("#file-preview-container").setAttribute("data", "old");
        }
        if(items[i]["type"]== "audio"){
            var audio = document.createElement("audio");
            audio.setAttribute("width", "100%");
            audio.setAttribute("height", "100%");
            audio.controls = true;
            audio.setAttribute("type","old-data");

            var source = document.createElement("source");
            source.setAttribute("src",items[i]["src"]);
            source.setAttribute("type","audio/mpeg");
            audio.appendChild(source);
            
            document.getElementById("step"+ String(i+1)).querySelector("#file-preview-container").appendChild(audio);
            document.getElementById("step"+ String(i+1)).querySelector("#file-preview-container").setAttribute("type", "audio");
            document.getElementById("step" + String(i+1)).querySelector("#file-preview-container").setAttribute("data", "old");
        }

        if(items[i]["type"]== "link"){
            document.getElementById("step"+ String(i+1)).querySelector("#link").disabled = false;
            document.getElementById("step"+ String(i+1)).querySelector("#link").value = items[i]["src"];
            document.getElementById("step"+ String(i+1)).querySelector("#flexCheckDefault").checked = true;
            document.getElementById("step"+ String(i+1)).querySelector("#upload-form").setAttribute("style", "display:none");
            
        }

    }
        


</script>
@endsection

@section('styles')
<style>
#main {
    display: inline-block;
    text-align: left;
    margin: 20px auto;
    background: #fff;
    width: 100%;
    padding: 20px 30px 70px;
    border-top: 1px solid #e6e6df;
    border-right: 1px solid #e6e6df;
    border-bottom: 5px solid #e6e6df;
    border-left: 1px solid #e6e6df;
}

/* Style the tab content */
.tabcontent {
    display: none;
}

.tabcontent:first-child {
    display: block;
}

.height-41 {
    height: 41px;
}

.w-110 {
    width: 110px;
}

.font-500 {
    font-weight: 500;
}

.w-90 {
    width: 90px;
}

.bg-color {
    background-color: #e7e9eb;
}

.no-resize {
    resize: none;
}

.no-underline {
    text-decoration: none;
    color: black;
}

.no-underline:hover {
    text-decoration: none;
    color: black;
}

.h-m-600 {
    min-height: 700px;
}

.connectedSortable1 {
    min-height: 200px;
    width: 100%;
}

.connectedSortable2 {
    width: 30%;
    min-height: 200px;
}

.hr-vertical {
    border-left: 1px solid grey;
    height: 100%;
    position: absolute;
    left: 64%;
    margin-left: -3px;
    top: 0;
}

.item-grab {
    cursor: grab;
    background: #8abeb7;
}

#tree {
    max-width: 300px;
}

#tree ul {
    max-width: 400px;
    max-height: 700px;
    overflow-y: auto;
}

.QrMedia-composer-container {
    height: calc(100vh - 95px + 8px);
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 16px;
    padding: 0 16px 16px 16px;
    margin-top: -8px;
}

.QrMedia-composer__header {
    height: 70px;
    min-height: 70px;
    width: 100%;
    display: flex;
    border: 10px;
    overflow: hidden;
    gap: 16px;
}

.QrMedia-composer__content {
    height: 100%;
    width: 100%;
    border: 1px solid var(--primary);
    border-radius: 10px;
    overflow-y: auto;
    position: relative;
}

.QrMedia-composer__content .step {
    height: 100%;
    overflow: hidden;
}

.QrMedia-composer__content .step#info {
    height: fit-content;
}

.header__list {
    border: 10px;
    overflow: hidden;
    width: 100%;
    height: 100%;
    position: relative;
    padding-left: 92px;
    padding-right: 48px;
    border-radius: 10px;
    border: 1px solid var(--primary);
    display: flex
}

.header__button {
    height: 100%;
    width: 96px;
    min-width: 96px;
    padding: 4px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.border-left {
    border-left: 1px solid var(--primary);
    width: 1px;
    height: 75%;
    margin: auto 0;
}

ul.tab {
    display: flex;
    overflow-x: auto;
    height: 100%;
    padding: 8px 8px 8px 0;
    /* box-shadow: rgb(0 0 0 / 15%) 6px 0 6px inset, rgb(0 0 0 / 15%) -6px 0 6px inset; */
}

ul.tab li.step-number {
    height: 100%;
    background: none;
    position: relative;
}

ul.tab li.step-number .tablinks {
    height: 100%;
    width: 72px;
    border-radius: 10px;
    overflow: hidden;
    background-color: #fff;
    cursor: pointer;
    border: 2px solid #ccc;
    outline: none;
    display: flex;
    justify-content: center;
    align-items: center;
}

.tablinks.active {
    border: 2px solid var(--primary) !important;
    box-shadow: rgba(0, 0, 0, 0.25) 0px 8px 28px, rgba(0, 0, 0, 0.22) 0px 8px 10px;
}

.tablinks.active .question--toolbar {
    display: flex;
}

ul.tab li.info-tab {
    position: absolute;
    top: calc((100% - 52px)/2);
    left: 0;
    height: calc(100% - 12px);
}

ul.tab li.info-tab .tablinks {
    height: 52px;
}

.tablinks .question--toolbar {
    position: absolute;
    top: -8px;
    right: -8px;
    display: none;
}

ul.tab li.create-step {
    position: absolute;
    right: 10px;
    top: calc((100% - 32px)/2);
}

ul.tab li.create-step #new-step {
    background-color: var(--primary);
    color: var(--white);
    width: 32px;
    height: 32px;
    border-radius: 50%;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
}

.box-shadow {
    box-shadow: 0 0 8px 0 rgb(0 0 0 / 6%), 0 1px 0 0 rgb(0 0 0 / 2%)
}

ul.tab-type {
    height: fit-content;
    border: 6px;
    overflow: hidden;
}

ul.tab-type li>div {
    height: 32px;
    border-radius: 6px;
    overflow: hidden;
    cursor: pointer;
    padding: 0 12px;
    display: flex;
    justify-content: center;
    align-items: center;
}

ul.tab-type .active {
    border: 1px solid var(--primary) !important;
    background-color: var(--white);
    color: var(--primary);
}

.upload-field {
    width: 30%;
    margin-left: 35%;
    border: 1px dashed var(--secondary);
    border-radius: 10px;
    min-height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
}

.upload-field:hover {
    border-color: var(--primary);
    color: var(--primary);
}

button.btn-circle {
    height: 32px;
    width: 32px;
    min-width: 32px;
    border-radius: 50%;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
}

.QrMedia-composer__content .form-wrap {
    overflow-x: hidden;
    min-width: 550px;
    max-width: 100%;
}

.form-control[type="checkbox"] {
    width: 16px;
    height: 16px;
}

.add-answer {
    width: 100%;
    height: 40px;
    border: 1px dashed var(--dark);
    color: var(--dark);
    border-radius: 6px;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
}

.add-answer:hover {
    color: var(--primary);
    border-color: var(--primary);
}

.h-full {
    height: 100%;
}

.overflow-y-auto {
    overflow-y: auto;
}

ul.tab li {
    list-style-type: none;
    margin-left: 10px;
    float: left;
}

.dialog {
    width: 100vw;
    height: 100vh;
    position: fixed;
    top: 0;
    right: 0;
    overflow: auto;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

#myLoader {
            border: 16px solid #f3f3f3; /* Light grey */
            border-top: 16px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
            display:none;
            position: fixed;
            margin-left: 32%;
            margin-top: 10%;
            text-align: center;
            z-index: 9999;
}

@keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

.dialog .dialog__modal {
    position: absolute;
    background-color: #ccc;
    opacity: 0.7;
    z-index: 10;
    width: 100%;
    height: 100%;
}

.dialog .dialog__container {
    z-index: 999;
    background-color: var(--light);
    width: fit-content;
    height: fit-content;
    min-width: 400px;
    display: flex;
    flex-direction: column;
    border-radius: 6px;
    overflow: hidden;
}

.dialog .dialog__container .dialog__title {
    width: 100%;
    padding: 12px 16px;
    background-color: var(--primary);
    color: var(--light);
}

.dialog .dialog__container .dialog__content {
    min-height: 80px;
    width: 100%;
    padding: 12px 16px;
}

.dialog .dialog__container .dialog__footer {
    width: 100%;
    display: flex;
    justify-content: flex-end;
    gap: 20px;
    padding: 8px 16px;
    border-top: 1px solid var(--primary);
}

.dialog .dialog__container .dialog__footer button {
    min-width: 80px;
}

::-webkit-scrollbar {
    width: 6px;
    height: 6px;
    border-radius: 4px;
}

/* Track */
::-webkit-scrollbar-track {
    background: var(--light);
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 4px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #888;
    border-radius: 4px;
}

.delete-step {
    background-image: "@/assets/icons/trash.svg";
}
</style>
@stop