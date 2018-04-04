<?php

function dbConnect() {
$connUrl = "mysql://pywo8h8n9lylz83t:xzlg0tzxs8w1ndax@jlg7sfncbhyvga14.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/mhq1uy937tuxjh65";
            $hasConnUrl = !empty($connUrl);
            
            $connParts = null;
            if ($hasConnUrl) {
                $connParts = parse_url($connUrl);
            }
            
            //var_dump($hasConnUrl);
            $host = $hasConnUrl ? $connParts['host'] : getenv('IP');
            $dbname = $hasConnUrl ? ltrim($connParts['path'],'/') : 'lab5';
            $username = $hasConnUrl ? $connParts['user'] : getenv('C9_USER');
            $password = $hasConnUrl ? $connParts['pass'] : '';
            
            return new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
}
$conn = dbConnect();

?>
<!DOCTYPE html>
<html>
    <head>
                      <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title> Lab 6: Admin Login Page </title>
    </head>
    <body>
        
       <h1> Admin Login </h1>
        
        <form method="POST" action="loginProcess.php">
            
            Username: <input type="text" name="username"/> <br />
            
            Password: <input type="password" name="password"/> <br />
            
            <input type="submit" name="login" value="Login"/>
            
            <?php
            
            
            if($_SESSION['invalid'] == true){
                echo "Wrong Password or Username";
                
            }
            ?>
            
            
        </form>

    </body>
</html>

<?php 
            if(isset($_POST['login'])) {
                $username = $_POST['username'];
                
                $pass = sha1($_POST['password']);
                $sql = "SELECT * FROM admin WHERE userName='$username' AND password='$pass'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                if($stmt->rowCount() > 0) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $_SESSION['username'] = $username;
                    header("Location: admin.php");
                    
                    
                } else {
                    echo "Invalid username or password.<br>";
                }
            }
        ?>