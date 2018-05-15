<html>
    <head>
        <title>Add</title>

    </head>
    <body>
        <a href="final.php">Back to the menu</a>
        
        <?php
        $host = 'jlg7sfncbhyvga14.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306';
$username = 'pywo8h8n9lylz83t';
$password = 'xzlg0tzxs8w1ndax';
$dbname = 'mhq1uy937tuxjh65';
 $conn = mysqli_connect($host, $username, $password, $dbname);

        
        $code = $_GET['code'];
        $afrom = $_GET['afrom'] ;
        $ato = $_GET['ato'];
        $type = $_GET['type'];
        
        $sql = "INSERT INTO salon(code,available_from,available_to,type) VALUES ('$code', '$available_from', '$available_fromto', '$type')";
        
        $statement = $bdd->prepare($sql);
        $statement->execute();
        
        
        ?>
        <form>
            Code : <input type="text" name="code"><br>
            Available from :<input type="date" name="available_from"><br>
            Available to :<input type="date" name="available_to"><br>
            Type : <input type="text" name="type"><br>
            
            <input type="submit" value="Add"/>
        </form>
    </body>
</html>