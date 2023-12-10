<?php
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    
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
    // $name = $data->studentname;
    $email = $_SESSION['teacherEmail'];
    require_once 'functions.php';
    addStudent($conn, $email, $name);
    if (!headers_sent()){
        header("location: dashboard.php");
    }
    else{
        echo "<meta http-equiv='Refresh' content='2; url=dashboard.php'>";
    }
    exit();
}
else {
    header("location: dashboard.php");
    exit();
}
?>

