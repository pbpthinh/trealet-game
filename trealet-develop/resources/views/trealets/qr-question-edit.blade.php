@extends('layouts.app')

@section('page-title', 'qr Question Edit')
@section('page-heading', 'qr Question  Edit')

@section('breadcrumbs')
<li class="breadcrumb-item active">
    You can edit your qr trealet here
</li>
@stop

@section('content')
<div class=>
<div class="card">
    <div class="card-body">
        <div class="d-flex border border-primary">
            <div class="flex-grow-1 border-left border-secondary">
                <div class="height-41 border-bottom border-secondary"></div>
                <div class="h-m-600">
                    <div class="d-flex px-4">
                        <div class="text-left w-110 font-500">Số câu hỏi</div>
                        <div class="flex-grow-1">
                            <ul class="tab" id="step-number">
                                <li class="step-number"><a href="#" class="tablinks active" onclick="chooseStep(event, 'info')">Thông tin</a></li>
                                <li class="step-number"><a href="#" class="tablinks" onclick="chooseStep(event, 'step1')">1</a></li>
                                <li class="create-step font-weight-bold"><a href="#" id="new-step" class="tablinks ">+</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="px-4" id="steps">
                        <div class="border border-secondary step" id="info">
                            <form id="main-form">
                                <div class="d-flex mb-2 px-4 py-1">
                                    <div class="text-left w-110 font-500">Tiêu đề</div>
                                    <div class="flex-grow-1">
                                        <input type="text" class="w-100 bg-color form-control" name="title" placeholder="Nhap Tieu De" required>
                                    </div>
                                </div>
                                <div class="d-flex mb-2 px-4 py-1">
                                    <div class="text-left w-110 font-500">Mô tả</div>
                                    <div class="flex-grow-1">
                                        <textarea class="w-100 bg-color no-resize form-control" name="des" rows="3"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="border border-secondary step d-none" data-id="1" id="step1">
                            <form  action="#">
                                <div class="main-block d-flex justify-content-between border-bottom border-secondary">
                                    <div class="flex-grow-1 w-75 d-flex" style="position: relative">
                                        <div>
                                            <ul class="tab tab-type mt-2" style="min-width: 550px;">
                                                <!-- <li><a href="#" class="active" onclick="chooseType(event, 'display')">Hiển thị</a></li> -->
                                                <!-- <li><a href="#" onclick="chooseType(event, 'qr')">QR</a></li> -->
                                                <li><a href="#" onclick="chooseType(event, 'quizz')">Câu đố</a></li>
                                                <!-- <li><a href="#" onclick="chooseType(event, 'audio')">Âm thanh</a></li> -->
                                                <!-- <li><a href="#" onclick="chooseType(event, 'picture')">Hình ảnh</a></li> -->
                                                <li><a href="#" onclick="chooseType(event, 'column')">Nối cột</a></li>
                                            </ul>
                                            <div class="main-data">
                                                <!-- <div class="wrap-type" id="display">
                                                    <h4 class="text-center">Hiển thị</h4>
                                                    <div class="p-2">
                                                        <div class="d-flex align-items-center">
                                                            <label style="min-width: 40px;text-align:center" for="">Gợi ý</label><input type="text" class="suggest form-control mb-2 ml-2" required>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <label style="min-width: 40px;text-align:center" for="">Mô tả</label><textarea class="description form-control mb-2 ml-2"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="p-2">
                                                        <ul id="sortable1" class="connectedSortable py-2 px-2 list-group border">
                                                        </ul>
                                                    </div>
                                                    <div class="p-2">
                                                        <div class="d-flex align-items-center">
                                                            <label style="min-width: 40px;text-align:center" for="">Điểm</label><input type="number" class="score form-control mb-2 ml-2">
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <label style="min-width: 40px;text-align:center" for="">Thời Gian</label><input type="number" class="time form-control mb-2 ml-2">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="wrap-type d-none" id="qr">
                                                    <h4 class="text-center">QR</h4>
                                                    <div class="p-2">
                                                        <div class="d-flex align-items-center">
                                                            <label style="min-width: 40px;text-align:center" for="">Gợi ý</label><input type="text" class="hint form-control mb-2 ml-2">
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <label style="min-width: 40px;text-align:center" for="">Mã</label><input type="text" class="code form-control mb-2 ml-2">
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <label style="min-width: 40px;text-align:center" for="">Điểm</label><input type="number" class="score form-control mb-2 ml-2">
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <label style="min-width: 40px;text-align:center" for="">Thời gian</label><input type="number" class="time form-control mb-2 ml-2">
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <div class="wrap-type d-none" id="quizz">
                                                    <h4 class="text-center">Câu đố</h4>
                                                    <div class="d-flex align-items-center">
                                                            <label style="min-width: 40px;text-align:center" for="">Mã</label><input type="text" class="code form-control mb-2 ml-2">
                                                        </div>

                                                    <div class="p-2">
                                                        <ul id="sortable3" class="connectedSortable py-2 px-2 list-group border">
                                                        </ul>
                                                        <input type="file" name="img" class="step-image-1" onchange="encodeImgtoBase64(this)">
                                                        <img src="" alt="" class="displayImg" width="500">
                                                    </div>
                                                    <div class="d-flex flex-column px-2">
                                                        <div>
                                                            <input type="text" placeholder="Question" class="form-control mb-2" name="question" required>
                                                            <div class="d-flex align-items-center">
                                                            <label style="min-width: 40px;text-align:center" for="">Địa điểm</label><input type="text" class="location form-control mb-2 ml-2">
                                                        </div>
                                                            <div class="form-check mb-1 answer">
                                                                <input type="radio" class="form-check-input" value="1" name="answer" required>
                                                                <input type="text" name="textAnser1" id="" class="answerText form-control" required>
                                                            </div>
                                                            <div class="form-check mb-1 answer">
                                                                <input type="radio" class="form-check-input" value="2" name="answer" required>
                                                                <input type="text" name="textAnser2" id="" class="answerText form-control" required>
                                                            </div>
                                                            <div class="form-check mb-1 answer">
                                                                <input type="radio" class="form-check-input" value="3" name="answer" required>
                                                                <input type="text" name="textAnser3" id="" class="answerText form-control" required>
                                                            </div>
                                                            <div class="form-check mb-1 answer">
                                                                <input type="radio" class="form-check-input" value="4" name="answer" required>
                                                                <input type="text" name="textAnser4" id="" class="answerText form-control" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="p-2">
                                                        <div class="d-flex align-items-center">
                                                            <label style="min-width: 40px;text-align:center" for="">Điểm</label><input type="number" class="score form-control mb-2 ml-2">
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <label style="min-width: 40px;text-align:center" for="">Thời Gian</label><input type="number" class="time form-control mb-2 ml-2">
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <label style="min-width: 40px;text-align:center" for="">Lời giải thích về đáp án </label><input type="string" class="descriptionAnswer form-control mb-2 ml-2">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="wrap-type d-none" id="audio">
                                                    <h4 class="text-center">Âm thanh</h4>
                                                    <div class="p-2">
                                                        <div class="d-flex align-items-center">
                                                            <label style="min-width: 40px;text-align:center" for="">Gợi ý</label><input type="text" class="suggest_audio form-control mb-2 ml-2">
                                                        </div>
                                                    </div>
                                                    <div class="p-2">
                                                        <div class="d-flex align-items-center">
                                                            <label style="min-width: 40px;text-align:center" for="">Điểm</label><input type="number" class="score form-control mb-2 ml-2">
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <label style="min-width: 40px;text-align:center" for="">Thời Gian</label><input type="number" class="time form-control mb-2 ml-2">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="wrap-type d-none" id="picture">
                                                    <h4 class="text-center">Hình ảnh</h4>
                                                    <div class="p-2">
                                                        <div class="d-flex align-items-center">
                                                            <label style="min-width: 40px;text-align:center" for="">Gợi ý</label><input type="text" class="suggest_picture form-control mb-2 ml-2">
                                                        </div>
                                                    </div>
                                                    <div class="p-2">
                                                        <div class="d-flex align-items-center">
                                                            <label style="min-width: 40px;text-align:center" for="">Điểm</label><input type="number" class="score form-control mb-2 ml-2">
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <label style="min-width: 40px;text-align:center" for="">Thời Gian</label><input type="number" class="time form-control mb-2 ml-2">
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <div class="wrap-type d-none" id="column">
                                                    <h4 class="text-center">Nối cột </h4>
                                                    <div class="d-flex align-items-center">
                                                            <label style="min-width: 40px;text-align:center" for="">Mã</label><input type="text" class="code form-control mb-2 ml-2">
                                                        </div>

                                                    <div class="p-2">
                                                        <ul id="sortable1" class="connectedSortable py-2 px-2 list-group border">
                                                        </ul>
                                                    </div>
                                                    <div class="d-flex flex-column px-2">
                                                        <div>
                                                            <input type="text" placeholder="Question" class="form-control mb-2" name="questionColumn" required>
                                                            <div class="d-flex align-items-center">
                                                            <label style="min-width: 40px;text-align:center" for="">Địa điểm</label><input type="text" class="location form-control mb-2 ml-2">
                                                        </div>
                                                        <div>Các option </div>
                                                            <div class="form-check mb-1 answer">
                                                                <input type="text" name="textAnser1" id="" class="optionColumn form-control">
                                                            </div>
                                                            <div class="form-check mb-1 answer">
                                                                <input type="text" name="textAnser2" id="" class="optionColumn form-control">
                                                            </div>
                                                            <div class="form-check mb-1 answer">
                                                                <input type="text" name="textAnser3" id="" class="optionColumn form-control">
                                                            </div>
                                                            <div class="form-check mb-1 answer">
                                                                <input type="text" name="textAnser4" id="" class="optionColumn form-control">
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                            <label style="min-width: 40px;text-align:center" for="">Lời giải thích về đáp án </label><input type="string" class="descriptionAnswer form-control mb-2 ml-2">
                                                        </div>
                                                        <div>Thứ tự đáp án đúng</div>
                                                        <div style='display:flex ; height:50px;justify-content:center;'>

                                                            <div style='margin: 10px;'>
                                                            <input type="text" style="width:20px" class="answerCorrect" value="1" name="answerColumn" required>
                                                            </div style='margin: 10px;'>
                                                            <div style='margin: 10px;'>
                                                            <input type="text" style="width:20px" class="answerCorrect" value="2" name="answerColumn" required>
                                                            </div>
                                                            <div style='margin: 10px;'>
                                                            <input type="text" style="width:20px" class="answerCorrect" value="3" name="answerColumn" required>
                                                            </div>
                                                            <div style='margin: 10px;'>
                                                            <input type="text" style="width:20px" class="answerCorrect" value="4" name="answerColumn" required>
                                                            </div>
                                                        </div>


                                                        </div>
                                                        Thứ tự các cột
                                                        <div>
                                                            <div class="form-check mb-1 answer" style="display:flex">
                                                                <span>1</span>
                                                                <input type="text" name="textAnser1" id="" class="answerTextkey form-control">
                                                            </div>
                                                            <div class="form-check mb-1 answer" style="display:flex">
                                                            <span>2</span>
                                                                <input type="text" name="textAnser2" id="" class="answerTextkey form-control">
                                                            </div>
                                                            <div class="form-check mb-1 answer" style="display:flex">
                                                                <span>3</span>
                                                                <input type="text" name="textAnser3" id="" class="answerTextkey form-control">
                                                            </div>
                                                            <div class="form-check mb-1 answer" style="display:flex">
                                                                <span>4</span>
                                                                <input type="text" name="textAnser4" id="" class="answerTextkey form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="p-2">
                                                        <div class="d-flex align-items-center">
                                                            <label style="min-width: 40px;text-align:center" for="">Điểm</label><input type="number" class="score form-control mb-2 ml-2">
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <label style="min-width: 40px;text-align:center" for="">Thời Gian</label><input type="number" class="time form-control mb-2 ml-2">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="width: 5px;position: relative">
                                            <div class="hr-vertical"></div>
                                        </div>
                                        <ul id="sortable2" class="connectedSortable py-2 px-2 list-group">
                                        </ul>
                                        <div id="tree"></div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center py-2">
                                    <button class="btn btn-secondary btn-sm w-60 delete-step" data-id="step1">Xóa
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="px-4 py-2 d-flex justify-content-end">
                        <div class="px-2">
                            <button class="btn btn-secondary btn-sm w-60" id="save" type='submit'>Lưu</button>
                        </div>
                        <div class="px-2">
                            <button class="btn btn-secondary btn-sm w-60">Đặt lại</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
<script>
    (function() {
        const donvi = $('#donvi').val();
        showUngDung(donvi);
        $.ajax({
            url: "{{ route('stepquest-edit.tree-folder') }}",
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

    function chooseType(e, type) {
        e.preventDefault();
        $(e.target).closest('.main-block')
            .find('.tab-type li a')
            .removeClass('active');
        $(event.target).addClass('active');
        $(e.target).closest('.main-block')
            .find('.wrap-type')
            .addClass('d-none');
        $(e.target).closest(`.main-block`)
            .find(`#${type}`)
            .removeClass('d-none');
    }

    function chooseStep(e, step) {
        e.preventDefault();
        $('#steps .step').addClass('d-none');
        $(`#${step}`).removeClass('d-none');
        $('#step-number .tablinks').removeClass('active');
        $(e.target).addClass('active');
    }

    function showUngDung(donViId) {
        $.ajax({
            url: "{{ route('stepquest-edit.ungdung') }}",
            data: {
                donVi: donViId
            },
            success: (response) => {
                const ungdung = JSON.parse(response);
                if (ungdung.length == 0) {
                    $('#ungdung')
                        .empty()
                        .append(`<option value="" disable>No Data</option>`);
                } else {
                    $('#ungdung')
                        .empty()
                        .append(JSON.parse(response).map((item, index) => (
                            `<option ${index == 0 ? 'selected' : ''} value="${item.id}">${item.title}</option>`
                        )));
                }
            }
        });
    }

    function showItem(donViId, stepNumber = 1) {
        $.ajax({
            url: "{{ route('stepquest-edit.image') }}",
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
        });
    }
    function encodeImgtoBase64(element) {
 var img = element.files[0];

 var reader = new FileReader();

 reader.onloadend = function() {
     if(img){

         url = reader.result;
        element.parentElement.lastElementChild.setAttribute("src", url)
     }
 }
 reader.readAsDataURL(img);
}

    let folder = '';
    // $(document).on('change', '#ungdung', (e) => {
    // 	folder = $(e.target).find(':selected').data('folder');
    // 	showItem($(e.target).val());
    // })

    $(document).on('change', '#donvi', function() {
        const donViId = $(this).val();
        showUngDung(donViId)
    })

    $(document).on('click', '#step-number #new-step', function(e) {
        e.preventDefault();
        const currentSteps = $('#step-number li:not(:first-child):not(:last-child)').length;
        $('#step-number .step-number .tablinks')
            .removeClass('active');
        $(`<li class="step-number">
				<a href="#" class="tablinks active" onclick="chooseStep(event, 'step${currentSteps + 1}')">${currentSteps + 1}
				</a>
				</li>`)
            .insertAfter('.step-number:last');
        $(`#step${currentSteps}`).addClass('d-none');
        $(`.step`).addClass('d-none');
        const html = `<div class="border border-secondary step" data-id="${currentSteps + 1}" id="step${currentSteps + 1}"><form>${$(`#step${currentSteps}`).html()}</form><div>`;
        const element = $(html)
        element.find('.delete-step').removeAttr('data-id').attr('data-id', `step${currentSteps + 1}`);
        element.find('input:not([name=answer])').val('');
        element.find('textarea').val('');
        element.find('.tab-type li a').removeClass('active');
        element.find('.tab-type li:first-child a').addClass('active');
        element.find('input[name=answer]').attr('checked', false)
        element.find('.wrap-type').addClass('d-none');
        element.find('.wrap-type:first-child').removeClass('d-none');
        element.find('#sortable2, #sortable1').empty();
        element.appendTo('#steps');
        $.ajax({
            url: "{{ route('stepquest-edit.tree-folder') }}",
            success: function(res) {
                let data = JSON.parse(res);
                $(`#step${currentSteps + 1} #tree`).treeview({
                    data: data,
                    levels: 10,
                }).on('nodeSelected', function(event, data) {
                    showItem(data.id, currentSteps + 1);
                });
            },
            error: function() {}
        });
        $(`#step${currentSteps + 1} #sortable1, #sortable2`).sortable({
            connectWith: ".connectedSortable",
            cursor: "grabbing",
        }).disableSelection();
    });

    $(document).on('click', '.delete-step', function(e) {
        const currentSteps = $('#step-number li').length - 1;
        if (Number(currentSteps) == 2) {
            alert('Can not delete');
            return false;
        }
        e.preventDefault();
        $('#step-number').find('.step-number .active').closest('li').nextAll().get().forEach(function(element) {
            if (!$(element).hasClass('create-step')) {
                $(element).find('a').text(Number($(element).text()) - 1);
            }
        });
        $('#step-number').find('.step-number .active').closest('li').remove();
        $('#step-number').find('.step-number:first-child .tablinks').addClass('active');
        $(`#${$(this).data('id')}`).remove();
        $('#steps').find('.step:first-child').removeClass('d-none');
    })

    $(document).on('click', '#save', function(e) {
        const items = [];
        e.preventDefault();
        $('#steps').find('.step:not(:first-child)')
            .get().forEach(function(item) {
                let step = $(item).find('.main-block .main-data .wrap-type:not(.d-none)').get();
                let element = $.map($(step).find('#sortable1 li').get(), function(el, i) {
                    return {
                        id: Number($(el).attr('data-id')),
                        value: $(el).text()
                    };
                });
                let data = {};
                const type = $(step).attr('id');
                switch (type) {
                    // case 'display': {
                    //     data = {
                    //         type: 'Display',
                    //         title: $(step).find('.suggest').val(),
                    //         description: $(step).find('.description').val(),
                    //         id: $(step).find('.code').val(),
                    //     };
                    //     break;
                    // }
                    // case 'qr': {
                    //     data = {
                    //         type: 'QR',
                    //         hint: $(step).find('.hint').val(),
                    //         code: $(step).find('.code').val(),
                    //     };
                    //     break;
                    // }
                    case 'quizz': {
                        let listOption = [];
                        $(item).find('.answer .answerText').get().forEach(function(item, index) {
                            listOption = [...listOption, {
                                id: index + 1,
                                text: $(item).val()
                            }]
                        });
                        console.log($(step).find('input[name=answer]').filter(':checked').first())
                        console.log($(step).find('.displayImg').prop('src'))
                        data = {
                            type: 'quizz',
                            question: $(step).find('input[name=question]').val(),
                            answer: $(step).find('input[name=answer]').filter(':checked').first().val(),
                            ListOption: listOption,
                            id: $(step).find('.code').val(),
                            location: $(step).find('.location').val(),
                            descriptionAnswer: $(step).find('.descriptionAnswer').val(),
                            score:  $(step).find('.score').val(),
                            imageQuestion:$(step).find('.displayImg').prop('src'),
                        };
                        break;
                    }
                    case 'column':{
                        let listOptionColumn = [];
                        $(item).find('.answer .optionColumn').get().forEach(function(item, index) {
                            listOptionColumn = [...listOptionColumn, {
                                id: index + 1,
                                text: $(item).val(),
                            }]
                        });
                        let listOptionKey = [];
                        $(item).find('.answer .answerTextkey').get().forEach(function(item, index) {
                            listOptionKey = [...listOptionKey, {
                                id: index + 1,
                                text: $(item).val(),
                            }]
                        });
                        let answer =[];
                        $(item).find('.answerCorrect').get().forEach(function(item, index) {
                            answer = [...answer, {
                                id: index + 1,
                                text: $(item).val(),
                            }]
                        });

                        console.log($(step).find('input[name=answer]').filter(':checked').first())
                        data = {
                            type: 'column',
                            question: $(step).find('input[name=questionColumn]').val(),
                            answer: answer,
                            option: listOptionColumn,
                            key: listOptionKey ,
                            id: $(step).find('.code').val(),
                            location: $(step).find('.location').val(),
                            descriptionAnswer: $(step).find('.descriptionAnswer').val(),
                            score:  $(step).find('.score').val(),
                            imageQuestion:$(step).find('#displayImg').prop('src'),

                        };
                        break;
                    }
                    // case 'audio': {
                    //     data = {
                    //         type: 'Audio',
                    //         hint: $(step).find('.suggest_audio').val()
                    //     };
                    //     break;
                    // }
                    // case 'picture': {
                    //     data = {
                    //         type: 'Picture',
                    //         hint: $(step).find('.suggest_picture').val()
                    //     };
                    //     break;
                    // }
                }
                data.score = $(step).find('.score').first().val()
                data.time = $(step).find('.time').first().val()
                items.push({
                    ...data,
                    image: element
                })
            });
        $.ajax({
            url: "{{ route('qr-question-edit.upload') }}",
            type: 'post',
            data: {
                main: $('#main-form').serializeArray(),
                items,
            },
            success: function(href) {
                window.location.href = href
            },
            error: function(res) {
                alert('Cần nhập đầy đủ thông tin');
            }
        });
    });
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

    .step {
        min-height: 700px;
    }

    .main-block {
        min-height: 700px;
    }

    ul.tab {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }

    ul.tab li {
        float: left;
        background-color: #f1f1f1;
        margin-left: 10px;
    }

    .active {
        margin-left: 0;
        border: 1px solid black;
        border-bottom: none;
    }

    ul.tab li a {
        display: inline-block;
        color: black;
        text-align: center;
        padding: 0px 16px;
        text-decoration: none;
        transition: 0.3s;
        font-size: 17px;
    }

    ul.tab li a:hover {
        background-color: #ddd;
    }

    ul.tab li a:focus,
    .active {
        background-color: #ccc;
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

    .w-60 {
        width: 60px;
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

    .tab-type .active {
        border: 1px solid black !important;
    }

    .tab-type li a {
        min-width: 80px;
    }

    .connectedSortable {
        width: 100%;
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

    #tree ul {
        max-width: 400px;
        max-height: 700px;
        overflow-y: auto;
    }
</style>
@stop
