<?php

$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "MHP2008Fin!DB";
$dbName = "attendence";
$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);
if(!$conn){
    die("Connection Failed:".mysqli_connect_error());
}

function SendEmail($EmailTo, $EmailFrom, $subject, $content, $NameTo, $NameFrom) {
    include 'PHPMailer-master/src/Exception.php';
    include 'PHPMailer-master/src/PHPMailer.php';
    include 'PHPMailer-master/src/SMTP.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP();
    $mail->Mailer = "smtp";
    $mail->Debugoutput = 'html';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;
    $mail->Host = "smtp.gmail.com";
    $mail->Username = "dndwebsitedummy@gmail.com";
    $mail->Password = "mbby ypcw pkpc snzs";
    $mail->Name = "teo donnelley";
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';

    if (isset($EmailTo) && isset($NameTo) && isset($EmailFrom) && isset($NameFrom) && isset($subject) && isset($content)){
        $mail->IsHTML(true);
        $mail->AddAddress($EmailTo, $NameTo);
        $mail->SetFrom($EmailFrom, $NameFrom);
        $mail->Subject = $subject;
        $mail->MsgHTML($content);

        try {
            if ($mail->send()) {
                return true;
            } else {
                throw new \Exception($mail->ErrorInfo);
            }
        } catch (\Exception $e) {
            // Log or handle the error as needed
            error_log("Email sending failed: " . $e->getMessage());
            return false;
        }
    } else {
        return false;
    }
}

function RandomizeString($string_lenth) {
   $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
   $randomString = "";
    for ($i = 0; $i < $string_lenth; $i++) {
       $index = rand(0, strlen($characters) - 1);
       $randomString .= $characters[$index];
   }
    return $randomString;
}


function getTeacherInfo($conn, $email) {
   // mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
   // require_once 'dbh.inc.php';
   $sql = "SELECT * FROM teachers WHERE teachersEmail = ?;";
   $stmt = mysqli_stmt_init($conn);
   if (!mysqli_stmt_prepare($stmt, $sql)) {
       $error = mysqli_stmt_error($stmt);
       header("location: ../signup_process.php");
       exit();
   }
   mysqli_stmt_bind_param($stmt, "s", $email);
   mysqli_stmt_execute($stmt);
   $resultData = mysqli_stmt_get_result($stmt);
   if ($row = mysqli_fetch_assoc($resultData)) {
        mysqli_stmt_close($stmt);
       return $row;
    //    return True;
   }
   else {
       mysqli_stmt_close($stmt);
       return false;
   }
}
// CREATE TABLE teachers ( 
//     teachersId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL, 
//     teachersFirstName varchar(128) NOT NULL, 
//     teachersLastName varchar(128) NOT NULL, 
//     teachersEmail varchar(128) NOT NULL, 
//     teachersPwd varchar(128) NOT NULL 
// );

function createTeacher($conn, $firstname, $lastname, $email, $pwd) {
   $sql = "INSERT INTO teachers (teachersFirstName, teachersLastName, teachersEmail, teachersPwd) VALUES (?, ?, ?, ?);";
   $stmt = mysqli_stmt_init($conn);  // makes connection to data base
   if (!mysqli_stmt_prepare($stmt, $sql)) {
       $error = mysqli_stmt_error($stmt);
       die($error);
   }
   $hashedPwd = password_hash(secure_string($pwd), PASSWORD_DEFAULT);
   mysqli_stmt_bind_param($stmt, "ssss", secure_string($firstname), secure_string($lastname), secure_string($email), $hashedPwd);
   mysqli_stmt_execute($stmt);
   mysqli_stmt_close($stmt);
   $sql = "CREATE TABLE ".$firstname.$lastname."_students (
       studentId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
       studentsName varchar(128) NOT NULL,
       studentPresent boolean DEFAULT 0
   );";


   $stmt = mysqli_stmt_init($conn);  // makes connection to data base
   if (!mysqli_stmt_prepare($stmt, $sql)) {
       $error = mysqli_stmt_error($stmt);
       die($error);
   }
   mysqli_stmt_execute($stmt);
   mysqli_stmt_close($stmt);
}

function secure_string($string){
    try {
        $string = addslashes(strip_tags(htmlentities($string)));
    } catch (Exeption $e){
        $string = "string could not be secured";
    }
    return $string;
 }
 
function addStudent($conn, $teacheremail, $studentname) {
    $teacher = getTeacherInfo($conn, $teacheremail);
    $sql = "INSERT INTO ".ucfirst($teacher['teachersFirstName']).ucfirst($teacher['teachersLastName'])."_students (studentsName) VALUES (?);";
    $stmt = mysqli_stmt_init($conn);  // makes connection to data base
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $error = mysqli_stmt_error($stmt);
        die($error);
    }
    mysqli_stmt_bind_param($stmt, "s", secure_string($studentname));
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
 }

function addStudentWithTeacherName($conn, $teacherFirstName, $teacherLastName, $studentname) {
    $sql = "INSERT INTO ".ucfirst($teacherFirstName).ucfirst($teacherLastName)."_students (studentsName) VALUES (?);";
    $stmt = mysqli_stmt_init($conn);  // makes connection to data base
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $error = mysqli_stmt_error($stmt);
        die($error);
    }
    mysqli_stmt_bind_param($stmt, "s", secure_string($studentname));
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
function make_student_present($conn, $teacherFirstName, $teacherLastName, $studentname){
    // $teacher = getTeacherInfo($conn, $teacheremail);
    session_start();
    $sql = "UPDATE ".ucfirst($teacherFirstName).ucfirst($teacherLastName)."_students SET `studentPresent` = 1 WHERE `studentsName` = (?);";
    $stmt = mysqli_stmt_init($conn);  // makes connection to data base
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $error = mysqli_stmt_error($stmt);
        die($error);
    }
    mysqli_stmt_bind_param($stmt, "s", secure_string($studentname));
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}