<?php
    session_start()
?>
<!DOCTYPE html>
<html>


<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />


  <style>
    body {
      background-image: url(Lava_Lamp-scaled.jpg);
    }
    .qr-code {
      max-width: 200px;
      margin: 10px;
      margin-top: 250px;
      border-radius: 10px;
    }


    #enteredName {
      margin-top: 10px;
      font-weight: bold;
    }
  </style>


  <title>QR Code Generator</title>
</head>

<body>
  <div class="container-fluid">
    <div class="text-center">


      <img src="https://chart.googleapis.com/chart?cht=qr&chl=http://172.16.251.101:5500/input.php&chs=200x200&chld=L|0"
      class="qr-code img-thumbnail img-responsive" />
      <div id="enteredName"></div>
    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>


  <script>
    $(function () {
      function fetchEnteredName() {
        let customPage = $('#customPage').val() || '1';
        let finalURL = `http://127.0.0.1:3000/${customPage}/name`;
 
        $.get('/enteredName', function (data) {
          $('#enteredName').text('Entered Name: ' + data);
          $('.qr-code').attr('src', `https://chart.googleapis.com/chart?cht=qr&chl=http://172.16.251.101:5500/input.php&chs=200x200&chld=L|0`);
        });
      }
 
      $('#generate').click(function () {
        fetchEnteredName();
      });
 
      fetchEnteredName();
    });
  </script>
 
</body>


</html>