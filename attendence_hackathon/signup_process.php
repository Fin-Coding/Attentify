<?php
if (isset($_POST["submit"])) {
    $first_name = ucfirst($_POST["firstName"]);
    $last_name = ucfirst($_POST["lastName"]);
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirmPassword"];
    
    $name = $first_name." ".$last_name;
    require_once 'functions.php';

    if ($first_name == "" || $last_name == "" || $password == "" || $confirm_password == ""){
        header("location: signup.php?result=emptyinput");
        exit();
    }
    elseif ($password != $confirm_password){
        header("location: signup.php?result=passwordsdontmatch");
        exit();
    }
      elseif (SendEmail($email, 'DoNotReply@gmail.com', "Attendance App Signup", "Thank you, ".$name." for signing up for our Attendance App!<br>We really appreciate it.<br>-Attendance App", $name, 'Attendance App') == false) {
          header("location: signup.php?result=emaildoesnotexist");
          exit();
      }
    else {
        $serverName = "localhost";
        $dbUsername = "root";
        $dbPassword = "MHP2008Fin!DB";
        $dbName = "attendence";
        $conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);
        if(!$conn){
            die("Connection Failed:".mysqli_connect_error());
        }
        if(getTeacherInfo($conn, $email)) {
            header("location: signup.php?result=teachertaken");
            exit();
        }
        createTeacher($conn, $first_name, $last_name, $email, $password);
        session_start();
        $_SESSION["teacherEmail"] = $email;
        $_SESSION["teacherFirstName"] = $first_name;
        $_SESSION["teacherLastName"] = $last_name;
        $_SESSION["teacherPassword"] = $password;
        // addStudent($conn, $email, "Test");
        // make_student_present($conn, $email, "Test");
        if (!headers_sent()){
            header("location: index.php?result=success");
        }
        else{
            echo "<meta http-equiv='Refresh' content='2; url=index.php?result=success'>";
        }
        exit();
    }


}
else {
    header("location: signup.php");
    exit();
}
?>

