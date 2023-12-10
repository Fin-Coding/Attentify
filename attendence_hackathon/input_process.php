<?php
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $teachersFirstName = ucfirst($_POST["firstname"]);
    $teachersLastName = ucfirst($_POST["lastname"]);
    
    require_once 'functions.php';
    
    $serverName = "localhost";
    $dbUsername = "root";
    $dbPassword = "MHP2008Fin!DB";
    $dbName = "attendence";
    $conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);
    if(!$conn){
        die("Connection Failed:".mysqli_connect_error());
    }
    else {
        make_student_present($conn, $teachersFirstName, $teachersLastName, $name);
        if (!headers_sent()){
            header("location: public/input.php?result=done");
        }
        else{
            echo "<meta http-equiv='Refresh' content='2; url=public/input.php?result=done'>";
        }
        exit();
    }
    
}
else {
    header("location: input.php");
    exit();
}
?>

