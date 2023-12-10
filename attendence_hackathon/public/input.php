<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Name Input</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
  <style>
    body {
      padding-top: 200px;
    }


    .btn {
      background-color: black;
      color: white;
      border-radius: 20px;
      size: 150%;
      margin-top: 5px;
    }
  </style>
</head>
<body>
<?php
    if (isset($_GET["result"])) {
        if ($_GET["result"] == "done") {
            echo "<div class='alert-error'><p>All finished</p></div>";
        }
    }
?> 
<div class="container">
    <h2>Please fill to mark your attendance</h2>
    <form id="nameForm" action="../input_process.php" method="post">
        <div class="form-group">
        <label for="name">Name:</label>
        <input class="form-control" type="text" id="name" name="name" required>
        <br><label for="firstname">Teachers First Name: </label>
        <input class="form-control" type="text" id="firstname" name="firstname" required>
        <br><label for="lastname">Teachers Last Name: </label>
        <input class="form-control" type="text" id="lastname" name="lastname" required>
        <br><button class="btn btn-primary" type="submit" name="submit">Submit</button>
        </div>
    </form>
</div>


</body>
</html>