<?php
$servername = 'localhost';
$username = 'bole8823';
$password = '';
$dbname = 'Kahoot';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Connection failed: '.$conn->connect_error);
}
if ($conn->connect_error) {
    die('Connection failed: '.$conn->connect_error);
}
$str = file_get_contents('myputfile.bin', FILE_USE_INCLUDE_PATH);
$str = '';
//var_dump($str);
$name = $_POST['name'];
$description = $_POST['description'];
$sql = "INSERT INTO Quizz (name, description, image)
VALUES ('$name', '$description', '$str');";
var_dump($sql);
$result = $conn->query($sql);
var_dump($result);