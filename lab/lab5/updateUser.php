<?php
session_start();
if (!isset($_SESSION['username'])) { //validates that admin has indeed logged in
    
    header("Location: index.php");
    
}
function dbConnect() {
    $connUrl = "mysql://gonadbcm28b2pbc2:j8logw12pooo3jyl@p2d0untihotgr5f6.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/jmjet2bi89ylt1b5";
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


function getDepartmentInfo(){
    global $conn;        
    $sql = "SELECT deptName, departmentId 
            FROM tc_department 
            ORDER BY deptName";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll();
    
    return $records;
    
}


function getUserInfo($userId) {
       
    $sql = "SELECT * 
            FROM user
            WHERE userId = $userId";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch();
    //print_r($record);
    return $record;
}
if (isset($_GET['updateUserForm'])) { //admin has submitted form to update user
    
    $sql = "UPDATE user
            SET firstName = :fName,
                lastName = :lName
			WHERE userId = :userId";
	$namedParameters = array();
	$namedParameters[":fName"] = $_GET['firstName'];
	$namedParameters[":lName"] = $_GET['lastName'];
	$namedParameters[":userId"] = $_GET['userId'];
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    
}
if(isset($_GET['userId'])) {
    $userInfo = getUserInfo($_GET['userId']);
}
?>

<!DOCTYPE html>
<html>
    <head>             <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title> Admin: Updating User </title>
        <script  
        function popUp()
            {
                alert("Successfully updated User !!");
            }
            ></script>
    </head>
    <body>

    <h1> Admin Section </h1>
    <h2> Updating User Info </h2>

    <fieldset>
        
        <legend> Update User </legend>
        
        <form>
            
            <input type="hidden" name="userId" value="<?=$userInfo['userId']?>" />
            First Name: <input type="text" name="firstName" required value="<?=$userInfo['firstName']?>" /> <br>
            Last Name: <input type="text" name="lastName" required value="<?=$userInfo['lastName']?>"/> <br>
            Email: <input type="text" name="email"/> <br>
            University Id: <input type="text" name="universityId"/> <br>
            Phone: <input type="text" name="phone"/> <br>
            Gender: <input type="radio" name="gender" value="F" id="genderF"  <?=($userInfo['gender']=='F')?"checked":"" ?> required/> 
                    <label for="genderF">Female</label>
                    <input type="radio" name="gender" value="M" id="genderM"  required/> 
                    <label for="genderM">Male</label><br>
            Role:   <select name="role">
                        <option value=""> Select One </option>
                        <option>Faculty</option>
                        <option>Student</option>
                        <option>Staff</option>
                    </select>
            <br />
            Department: <select name="deptId">
                            <option value=""> Select One </option>
                            <?php
                            
                                $departments = getDepartmentInfo();
                                foreach ($departments as $record) {
                                    echo "<option value='$record[departmentId]'>$record[deptName]</option>";
                                }
                            
                            ?>
                            
                        </select>
                        <br />
                <input type="submit" name="updateUserForm" value="Update User!"/>
        </form>
        
    </fieldset>


    </body>
</html>