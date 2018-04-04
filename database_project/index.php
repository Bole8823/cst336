<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Team Project</title>
        <link href="style.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Mono" rel="stylesheet">
    </head>
    <body>
        <div id="main">
          <h1>Music Database</h1>
          <p>The database can be filtered by track name, artist name or music genre</p>
          <a href="shopping.php">
            <img id="cart" alt="cart" src="cart.jpg" >
          </a>
        </div>
        <div id="menu">
            <div id="filter">
                <form action="index.php"><br>
                    <input type="radio" name="filter" value="artist" /> Artist Name</label>
                    <input type="radio" name="filter" value="track" /> Track Name</label><br>
                    <input type="submit", value="Select">
                </form> 
            </div>
            <br>
            <div id="select_genre">
                <form action="index.php">
                <select name="genre">
                    <option value="">Select a music genre</option>
                    <option value="pop">Pop</option>
                    <option value="rap">Rap</option>
                </select><br><br>
                <input type="submit", value="search"><br><hr>
                </form> 
            </div>
        </div>
        
        
        <?php
            /*$connUrl = "mysql://rbxpsues54ht50d6:xg7fqnn4docaxmqd@olxl65dqfuqr6s4y.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/lc1ny2gy52780f2x";
            $hasConnUrl = !empty($connUrl);
            
            $connParts = null;
            if ($hasConnUrl) {
                $connParts = parse_url($connUrl);
            }
            
            //var_dump($hasConnUrl);
            $host = $hasConnUrl ? $connParts['host'] : getenv('IP');
            $dbname = $hasConnUrl ? ltrim($connParts['path'],'/') : 'lab4';
            $username = $hasConnUrl ? $connParts['user'] : getenv('C9_USER');
            $password = $hasConnUrl ? $connParts['pass'] : '';
            
            $bdd= new PDO("mysql:host=$host;dbname=$dbname", $username, $password);*/
            $bdd= new PDO("mysql:host=localhost;dbname=teamproject", 'bole8823', '');
            
            
            if ($_GET['filter']=='track')
            {
                $reponse = $bdd->query('SELECT * FROM track NATURAL JOIN artist NATURAL JOIN genre  ORDER BY track_name ');
            } 
            else if ($_GET['filter']=='artist')
            {
                $reponse = $bdd->query('SELECT * FROM track NATURAL JOIN artist NATURAL JOIN genre  ORDER BY artist_name ');	
            } 
            else if ($_GET['genre']!='')
            {
               
                $reponse = $bdd->query('SELECT * FROM track NATURAL JOIN artist NATURAL JOIN genre WHERE genre_name=\'' . $_GET['genre'] . '\'');
       
            }
            else {
                $reponse = $bdd->query('SELECT * FROM track NATURAL JOIN artist NATURAL JOIN genre');	

            }
            	
        
            while ($donnees = $reponse->fetch())
            {
            ?>
            <div id="result">
                <div id="a">
                    <?php echo $donnees['genre_name'];?>
                </div>
                    
                <div id="b">
                    <div class="popup" onclick="myFunction()"><?php echo $donnees['track_name'];?>
                        <span class="popuptext" id="myPopup"><?php echo $donnees['album_name'];?></span>
                    </div>
                </div>
                <div id="c">
                    <?php echo $donnees['artist_name'] . "<br>";?>
                </div>
                <div id="d">
                    <button onclick="addtocart()"><img id="plus" src="plus.jpg" alt="plus" ></button>
                    <p>Add to shopping cart</p>
                    

                </div>
            
               
            </div>
                
             <?php  
            }
            $reponse->closeCursor();
        ?>
    </body>
</html>
<script>
    function addtocart(){
        document.getElementById("plus").src = "check.png";
       
    }
                            
</script>

<script>
// When the user clicks on div, open the popup
function myFunction() {
    var popup = document.getElementById("myPopup");
    popup.classList.toggle("show");
}
</script>

