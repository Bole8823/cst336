<?php
$servername = 'localhost';
$username = 'bole8823';
$password = '';
$dbname = 'Kahoot';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Connection failed: '.$conn->connect_error);
}
 $dbConn = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $username, $password);
    // Setup to exception on errors (will go to php_errors.log)
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
var_dump($dbConn);
$sql1 = 'SELECT name FROM Quizz ORDER BY n DESC LIMIT 1';
    //var_dump($sql1);
$result1 = $conn->query($sql1);
var_dump($result1);
$name = '';
$array = $_POST['array'];
$l = count($array);
for ($i = 0; $i < $l; ++$i) {
    $question = $array[$i][0];
    var_dump($question);
    $time = $array[$i][1];
    $answers = $array[$i][2];
    $answer1 = $answers[0];
    $answer2 = $answers[1];
    $answer3 = $answers[2];
    $answer4 = $answers[3];
    $correct = $array[$i][3];
    $sql = "INSERT INTO questions (quizzName ,question, time, answer1, answer2, answer3, answer4, correct) VALUES ('$name','$question','$time','$answer1','$answer2','$answer3','$answer4','$correct');";
    var_dump($sql);
    $result = $conn->query($sql);
    var_dump($result);
}