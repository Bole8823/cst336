<?php
$servername = 'localhost';
$username = 'bole8823';
$password = '';
$dbname = 'Kahoot';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Connection failed: '.$conn->connect_error);
}


$sql = 'SELECT * from Quizz';
$sql1 = 'SELECT * from questions';
var_dump($sql);
$result = $conn->query($sql);
$result1 = $conn->query($sql1);
$outp = array();
$outp = $result->fetch_all(MYSQLI_ASSOC);
$outp1 = array();
$outp1 = $result1->fetch_all(MYSQLI_ASSOC);
var_dump($outp);
var_dump($outp1);
$json = json_encode($outp);
$json1 = json_encode($outp1);
$fp = fopen('results.json', 'w');
//$fh = fopen( 'filelist.txt', 'w' );
//fclose($fh);
fwrite($fp, $json);
fclose($fp);
$fp1 = fopen('questions.json', 'w');
//$fh = fopen( 'filelist.txt', 'w' );
//fclose($fh);
fwrite($fp1, $json1);
fclose($fp1);