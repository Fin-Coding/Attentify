<?php
if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    require_once 'functions.php';
    
    $serverName = "localhost";
    $dbUsername = "root";
    $dbPassword = "MHP2008Fin!DB";
    $dbName = "attendence";
    $conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);
    if(!$conn){
        die("Connection Failed:".mysqli_connect_error());
    }
    session_start();
    // $teacher = getTeacherInfo($conn, $email);
    if (!($email == $_SESSION["teacherEmail"])){
        header("location: login.php?result=emailincorrect");
        exit();
    }
    elseif (!password_verify($password, $_SESSION["teacherPassword"])){
        header("location: login.php?result=passwordincorrect");
        exit();
    }
    else {
        if (!headers_sent()){
            header("location: index.php?result=login");
        }
        else{
            echo "<meta http-equiv='Refresh' content='2; url=index.php?result=login'>";
        }
        exit();
    }

    
}
else {
    header("location: login.php");
    exit();
}
?>

