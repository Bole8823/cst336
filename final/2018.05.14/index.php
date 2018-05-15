<?php
session_start();
function dbConnect() {
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
?>

<style>
    #Login {
        border: 1px solid black;
        margin-left: auto;
        margin-right: auto;
        width: 300px;
        height: 140px;
        text-align: center;
        padding-top: 15px;
    }
</style>


<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        
    </head>
    <body>
        <h1>Login</h1>
        <div id="Login">
            <p>Use admin and admin</p>
       
            <form method="POST">
        
                Username: <input type="text" name="username"/> <br />
                Password: <input type="password" name="password"/> <br /><br />
                <input type="submit" id="submit" value="Login" name="submitButton" />
            
                
            </form>


</div>


<?php 
            if(isset($_POST['submitButton'])) {
                $username = $_POST['username'];
                
                $pass = ($_POST['password']);
                $password= sha1($pass);
                
                // I was not able to use BCRYPT
                
                
            $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                if($stmt->rowCount() > 0) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $_SESSION['username'] = $username;
                    header("Location: scheduler.php");
                    
                    
                } else {
                    echo "Invalid username or password.<br>";
                }
             }
        ?>
        
    </body>
    
</html>