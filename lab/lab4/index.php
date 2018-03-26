


<!DOCTYPE html>
<html>
    <head>
        <title>Lab4 </title>
        <link href="style.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Itim" rel="stylesheet"> 
    </head>
    <body>
        
        <div id="menu">
        
            <div id="select_type">
                <form action="index.php">
                <select name="type">
                <option value="">Select a type</option>
                <option value="VR headset">VR headset</option>
                <option value="Tablet">Tablet</option>
                <option value="webcam">webcam</option>
                <option value="CheatSheet">CheatSheet</option>
                <option value="Smartphone">Smartphone</option>
                <option value="Camera">Camera</option>
                <option value="Laptop">Laptop</option>
                <option value="Microphone">Microphone</option>
                <option value="Dynamic Mics">Dynamic Mics</option>
                <option value="Tripod">Tripod</option>
                </select><br>
                <input type="radio" name="order" value="item_name" />Ranked by name</label>
                <input type="radio" name="order" value="price" />Ranked by price</label>
                <br>
                <input type="submit", value="filter"><br>
                </form> 
            </div>
            
            <div id="select_name">
                <form action="index.php"><br>
                Search by name:<input type="text" name="name" value=""><br>
                <input type="radio" name="order" value="item_name" />Ranked by name</label>
                <input type="radio" name="order" value="price" />Ranked by price</label>
                <br>
                <input type="submit", value="Search">
                </form> 
            </div>
            
            <div id="availability">
                <form action="index.php"><br>
                    <input type="radio" name="availability" value="available" /> Available</label>
                    <input type="radio" name="availability" value="checkedout" /> Checked Out</label><br>
                    <input type="radio" name="order" value="item_name" />Ranked by name</label>
                <input type="radio" name="order" value="price" /> Ranked by price</label>
                <br><br>
                <input type="submit", value="Select">
                </form> 
            </div>
        
        
        </div>
               
        
        <div id="header">
            <h1>Tech Checkout</h1>
        </div>
        <div id="space">
            
        </div>
        
        
        
        <div id="list">
        
        
        
            <?php
        
//$connUrl = getenv('JAWSDB_MARIA_URL');
$connUrl = "mysql://pywo8h8n9lylz83t:xzlg0tzxs8w1ndax@jlg7sfncbhyvga14.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/mhq1uy937tuxjh65";
$hasConnUrl = !empty($connUrl);

$connParts = null;
if ($hasConnUrl) {
    $connParts = parse_url($connUrl);
}

//var_dump($hasConnUrl);
$host = $hasConnUrl ? $connParts['host'] : getenv('IP');
$dbname = $hasConnUrl ? ltrim($connParts['path'],'/') : 'crime_tips';
$username = $hasConnUrl ? $connParts['user'] : getenv('C9_USER');
$password = $hasConnUrl ? $connParts['pass'] : '';

$bdd = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            
            if ($_GET['type']!='')
            {
               if($_GET['order']=='price'){
                    $reponse = $bdd->query('SELECT * FROM device WHERE deviceType=\'' . $_GET['type'] . '\' ORDER BY price');
               } else {
                    $reponse = $bdd->query('SELECT * FROM device WHERE deviceType=\'' . $_GET['type'] . '\'');
               }
                
            } 
            else if ($_GET['name']!='')
            {
                if($_GET['order']=='price'){
                    $reponse = $bdd->query('SELECT * FROM device WHERE deviceName like \'%' . $_GET['name'] . '%\' ORDER BY price');
               } else {
                    $reponse = $bdd->query('SELECT * FROM device WHERE deviceName like \'%' . $_GET['name'] . '%\'ORDER BY deviceName');
               }
            	
            } 
            
            
            else if ($_GET['availability']=='available')
            {
                 if($_GET['order']=='price'){
                    	$reponse = $bdd->query('SELECT * FROM device WHERE status=\'Available\'ORDER BY price');
               } else {
                    	$reponse = $bdd->query('SELECT * FROM device WHERE status=\'Available\'ORDER BY deviceName');
               }
            	
            } 
            else if ($_GET['availability']=='checkedout')
            {
                 if($_GET['order']=='price'){
                    $reponse = $bdd->query('SELECT * FROM device WHERE status=\'CheckedOut\'ORDER BY price');
               } else {
                    $reponse = $bdd->query('SELECT * FROM device WHERE status=\'CheckedOut\' ORDER BY deviceName');
               }
            	
            } 
            else if($_GET['type']=='')
            {
                if($_GET['order']=='price'){
                    $reponse = $bdd->query('SELECT * FROM device ORDER BY price');
               } 
               else if($_GET['order']='item_name')
               {
                    $reponse = $bdd->query('SELECT * FROM device ORDER BY deviceName');
               }else {
                $reponse = $bdd->query('SELECT * FROM device ');
                }
            	
            }
            
            
        
            
            
            
            while ($donnees = $reponse->fetch())
            {
            ?>
                <div id="item">
            
                    <strong>Device: </strong> <?php echo $donnees['deviceName']; ?><br />
                    <strong>type : </strong><?php echo $donnees['deviceType']; ?> <br />
                    <strong>Price: </strong>$<?php echo $donnees['price']; ?> <br />
                    <strong>Status: </strong><?php echo $donnees['status']; ?> <br />
                    
                    
                
                </div>
        
        </div>
        
        <?php
        }
        $reponse->closeCursor(); // Termine le traitement de la requête
    ?>
    </body>
</html>
        