<!DOCTYPE html>
<html>
        <head>
        <title>Dashboard</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    </head>
<body>
<?php
            $host = 'jlg7sfncbhyvga14.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306';
$username = 'pywo8h8n9lylz83t';
$password = 'xzlg0tzxs8w1ndax';
$dbname = 'mhq1uy937tuxjh65';
 $conn = mysqli_connect($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Connection failed: '.$conn->connect_error);
}
        ?>
        
        
        
<?php
            $sql = "SELECT * FROM salon";
            $stmt = $bdd->prepare($sql);
            $stmt->execute();
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo "<div class='container'><center><br><b><h2>Barber Shop</h2> </center></b>" ;
            echo "<table class='table'>";
            echo "<a href='add.php'><span class='glyphicon glyphicon-plus-sign'></span></a>";
            foreach ($records as $donnees)
            {  
                echo "<tr>";
                echo "<td>Code: ".  $donnees['code'] . "</td>" ;
                echo "<td>Available from: ". $donnees['available_from'] . " </td>" ; 
                echo  "<td>to: ". $donnees['available_to'] ." </td>" ;
                echo "<td>Type: ".$donnees['type'] . " </td>"; 
                echo "<td><a href='edit.php?id=" . $donnees['id'] . "'><span class='glyphicon glyphicon-pencil'></span></a>
                <a href='content.php?id=" . $donnees['id'] . "'><span class='glyphicon glyphicon-info-sign'></span></a>
                <a href='delete.php?id=" . $donnees['id'] . "'><span class='glyphicon glyphicon-remove-circle'></span></a>";
                echo "</tr>";
            }
            echo "</table>";
            echo '</div>';
            
            
?>

</body>
</html>