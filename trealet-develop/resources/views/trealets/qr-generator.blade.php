
    <!DOCTYPE html>
<html>

<head>
  <!-- Include Bootstrap for styling -->
  <link rel="stylesheet" href=
"https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />

  <style>
    .qr-code {
      max-width: 200px;
      margin: 10px;
    }
  </style>

  <title>QR Code Generator</title>
</head>

<body>
  <div class="container-fluid">
      <button class="btn" style=" background-color :red ; color :white ;margin-top:30px"
      onclick="goBack()"
      >
        Thoát
      </button>
    <div class="text-center">

      <!-- Get a Placeholder image initially,
       this will change according to the
       data entered later -->
      <img src=
"https://chart.googleapis.com/chart?cht=qr&chl=Hello+World&chs=160x160&chld=L|0"
        class="qr-code img-thumbnail img-responsive" />
    </div>

    <div class="form-horizontal">
      <div class="form-group">
        <label class="control-label col-sm-2"
          for="content">
          Content:
        </label>
        <div class="col-sm-10">

          <!-- Input box to enter the
              required data -->
          <input type="text" size="60"
            maxlength="60" class="form-control"
            id="content" placeholder="Nhập mã câu hỏi" />
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">

          <!-- Button to generate QR Code for
           the entered data -->
          <button type="button" class=
            "btn btn-default" id="generate">
            In ra mã QR
          </button>
        </div>
      </div>
      <div>
          Danh sách các mã câu hỏi QR
          <div id ="nameId"></div>
      </div>
    </div>
  </div>
  <script src=
    "https://code.jquery.com/jquery-3.5.1.js">

  </script>

  <script>
    // Function to HTML encode the text
    // This creates a new hidden element,
    // inserts the given text into it
    // and outputs it out as HTML
    function htmlEncode(value) {
      return $('<div/>').text(value)
        .html();
    }
    function goBack(){
    window.history.back();

}

    $(function () {

      // Specify an onclick function
      // for the generate button
      $('#generate').click(function () {

        // Generate the link that would be
        // used to generate the QR Code
        // with the given data
        let finalURL =
'https://chart.googleapis.com/chart?cht=qr&chl=' +
          htmlEncode($('#content').val()) +
          '&chs=160x160&chld=L|0'

        // Replace the src of the image with
        // the QR code image
        $('.qr-code').attr('src', finalURL);
      });
    });

    const QR = document.getElementById("nameId")
    var items = <?php echo json_encode($items); ?>;
    items?.forEach((v)=>{
     QR.innerHTML +=`<div style="display:flex"> <div>Mã câu hỏi : ${v.id} . </div> <div style='margin-left:30px'>Địa điểm :${v?.location}</div></div> `
})

  </script>
</body>

</html>



