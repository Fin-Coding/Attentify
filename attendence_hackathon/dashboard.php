<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Teacher Dashboard</title>
   <!-- You can link your CSS file for styling here -->
   <link rel="stylesheet" href="style.css">
   <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
   <script>
   function typeStudent() {
        alert("hi")
       $('.plus-btn').html("<input class='name'>");
       $('.plus-btn').removeAttr("onclick");
       $(".name").focus();
       $(".name").attr("onblur", "addStudent()");
  
       // $('.student-wrapper').append("<p>"+name+"</p>")
       alert("hi")
   }

   function addStudent() {
       var name = $(".name").val();
       if(name != "") {
           $(".student-wrapper .plus-btn").remove();
           $(".student-wrapper").append("<p>"+name+"</p>");
           $(".student-wrapper").append("<p class='plus-btn' onclick='typeStudent()''>+</p>");
           fetch('process.php', {
               method: 'POST', // You can also use 'GET' depending on your requirements
               headers: {
                   'Content-Type': 'application/json',
               },
               body: JSON.stringify({ studentname: name }), // Convert the data to JSON format
           })
               .then(response => response.json())
               .then(data => {
                   // Handle the response from the PHP file
                   console.log('Response from PHP:', data);
               })
               .catch(error => {
                   console.error('Error:', error);
               });
       }
   }


   function delete_student(this) {
       var name = this.parent().text()
       alert(name)
   }
</script>
</head>
<body>


<div class="container">


   <main class="content">
       <div class='student-wrapper'>
       <?php
               $teacher_first = $_SESSION['teacherFirstName'];
               $teacher_last = $_SESSION['teacherLastName'];


               require_once 'functions.php';
               $sql = "SELECT * FROM ".$teacher_first.$teacher_last."_students";
               if(!($resultStudent = $conn->query($sql))) {
                   $error = $conn->error;
                   die($error);
               }
               while($rowStudent = $resultStudent->fetch_assoc()) {
                    // die(boolval($rowStudent['studentPresent']));
                   if(boolval($rowStudent['studentPresent'])){
                       echo "<p class='present'>".$rowStudent['studentsName']."<img class='remove' onclick='delete_student()' src=''></p>";
                   }
                   else {
                       echo "<p class='absent'>".$rowStudent['studentsName']."<img class='remove' onclick='delete_student() src=''></p>";
                   }
               }
           ?>
           <!-- <p class='plus-btn' onclick='() => {typeStudent()}'>+</p> -->
           <br>
           <form action="dashboard_process.php" method="post">
                <!-- <label for="name">Student Name:</label> -->
                <input type="text" class="name" name="name" required>
                <button type="submit" name="submit">+</button>
            </form>
       </div>
   </main>
</div>



</body>
</html>
