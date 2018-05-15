<?php
$host = 'jlg7sfncbhyvga14.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306';
$username = 'pywo8h8n9lylz83t';
$password = 'xzlg0tzxs8w1ndax';
$dbname = 'mhq1uy937tuxjh65';
 $conn = mysqli_connect($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Connection failed: '.$conn->connect_error);
}
$sql = "DELETE FROM salon WHERE id =  " . $_GET['id'];
$statement = $bdd->prepare($sql);
$statement->execute();
 
header("Location: final.php");


?>