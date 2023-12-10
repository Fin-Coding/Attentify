<?php

$postData = file_get_contents("php://input");
die($postData);
$data = json_decode($postData);

// Check for JSON decoding errors
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'JSON decoding error']);
    exit;
}

session_start();
// Access the variables sent from JavaScript
$name = $data->studentname;
$email = $_SESSION['teacherEmail'];
require_once 'functions.php';
die($email);
addStudent($conn, $email, $name)
?>
