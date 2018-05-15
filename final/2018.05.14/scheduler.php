<?php
session_start();
if(!isset($_SESSION['username'])) {
    header("Location: index.php");
}

function dbConnect() {
    
    $hasConnUrl = !empty($connUrl);
    $connUrl = "mysql://pywo8h8n9lylz83t:xzlg0tzxs8w1ndax@jlg7sfncbhyvga14.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/mhq1uy937tuxjh65";
    $hasConnUrl = !empty($connUrl);
            $connParts = null;
            if ($hasConnUrl) {
                $connParts = parse_url($connUrl);
            }
            
            //var_dump($hasConnUrl);
            $host = $hasConnUrl ? $connParts['host'] : getenv('IP');
            $dbname = $hasConnUrl ? ltrim($connParts['path'],'/') : 'scheduler';
            $username = $hasConnUrl ? $connParts['user'] : getenv('C9_USER');
            $password = $hasConnUrl ? $connParts['pass'] : '';
            
            return new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            
            
}
$conn = dbConnect();

        if(isset($_POST['add'])){
            
            $code = $_POST['code'];
            $available_from = $_POST['available_from'];
            $available_to = $_POST['available_to'];
            $type = $_POST['type'];
            
        $sql = "INSERT INTO appointment
                            (code, available_from, available_to, type)
                        VALUES
                            ('$code', '$available_from', '$available_to', '1')";
                
                
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                
                header("Location: scheduler.php");
                
                
            }
        ?>
        
        <style>
    #logout {
        text-align: right;
    }
    
    
    #Add {
        display:none ;
        border: 1px solid black;
        width: 250px;
        margin-left:auto;
        margin-right: auto;
    }
    
    
</style>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>
        <div id="logout">
            <form action="logout.php">
                
                <input type="submit" id="mainPageButtons" value="Logout" />
                
            </form>
        </div>
            
        <div id="invLink">
            <p>Invitation link</p>
        </div>
        
        
        <p onclick="myFunction()">Modify the appointment</p>
        
        
        <div id="modify">
            <p>Modify</p>
            <form  method="POST">
                Code: <input id="code" type="code" name="code"><br>
                Available from : <input name="available_from" type="time"> 
                -to :<input name="available_to" type="time"><br>
                <input type="submit" id="modifybuttom" value="modify" name="modify" />
            </form>
        </div>
        
<?php
    $bdd= new PDO("mysql:host=localhost;dbname=scheduler", 'bole8823', '');
    $sql='SELECT * FROM salon WHERE available_from > CURDATE() ORDER BY available_from ';
?>

    <table id="data">
    <tr>
        <tr>code</tr>
        <tr>available_from</tr>
        <tr>available_to</tr>
        <tr>type</tr>
        
        
         </tr>
            <?php 
                showData($sql);
            ?>
        </table>
        
        
             
    </body>
</html>


<?php
    function showData($a) {
        $bdd= dbConnect();
        $sql=$a;
        $stmt = $bdd->prepare($sql);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";

echo "<td>".$row['code']."</td>";
echo "<td>".$row['available_from']."</td>";
echo "<td>".$row['available_to']."</td>";
echo "<td>".$row['type']."</td>";

echo "<td><a  href='archieve.php?id=".$row['id']."'>Cancel</a></td>";

 echo "</tr>";
        }
    }
    

?>
<script>
    
function myFunction() {
    if( document.getElementById("modify").style.display=="block"){
         document.getElementById("modify").style.display= "none" ;
    } else {
    document.getElementById("modify").style.display= "block" ;
    }
}
</script>