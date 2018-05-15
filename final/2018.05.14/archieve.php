<?php
session_start();
if(!isset($_SESSION['username'])) {
    header("Location: index.php");
}
function dbConnect() {
    $connUrl ="mysql://pywo8h8n9lylz83t:xzlg0tzxs8w1ndax@jlg7sfncbhyvga14.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/mhq1uy937tuxjh65";
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
  function getAppId($id){
    
    $conn = dbConnect();
    
    $sql = "SELECT * FROM salon WHERE id='$id'";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}
 
  
  
  if (isset($_GET['Yes'])) {
    $userid=$_GET['userId'];
    
    $sql = "DELETE FROM salon  WHERE  id =$userid";
   
    $conn = dbConnect();
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    header("Location: scheduler.php");
  }
  
  
  
  if (isset($_GET['No'])) {
    header("Location: scheduler.php");
  }
  
  
  
  if (isset($_GET['id'])) {
    $appinfo = getAppId($_GET['id']);
    
  }
?>

<!DOCTYPE html>
<html>
  <head>
    
    
  </head>
  <body>
    <div id="archieve">
        
        
        <p>Are you sure you want to archieve the appointment ? This cannot be undone</p>
        <form method="GET">
            <input type="hidden" name="userId" value="<?=$appinfo['id']?>" />
            <input type="submit" id="decision" value="Cancel" name="No" />
            <input type="submit" id="decision" value="Yes archieve it !" name="Yes" />
        </form>
    </div>
    
  </body>
</html>

