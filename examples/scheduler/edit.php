<!DOCTYPE html>

<html>
    <head>
        <title>Edit</title>

    </head>
    <body>
        <a href="final.php">Back to the menu</a>
        
    
        <?php
$host = 'jlg7sfncbhyvga14.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306';
$username = 'pywo8h8n9lylz83t';
$password = 'xzlg0tzxs8w1ndax';
$dbname = 'mhq1uy937tuxjh65';
 $conn = mysqli_connect($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Connection failed: '.$conn->connect_error);
}
        
        $code = $_GET['code'];
        $afrom = $_GET['available_from'] ;
        $ato = $_GET['available_to'];
        $type = $_GET['type'];
        
       $sql = "UPDATE salon SET code='$code',available_from='available_from',available_to='available_from',type='$type' WHERE id =  " . $_GET['id'];
        
        $statement = $bdd->prepare($sql);
        $statement->execute();
        
        
        ?>
        <form>
            Code : <input type="text" name="code"><br>
            Available from :<input type="date" name="available_from"><br>
            Available to :<input type="date" name="available_to"><br>
            Type : <input type="text" name="type"><br>
            
            <input type="submit" value="Edit"/>
        </form>
    </body>
</html>