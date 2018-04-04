<?php


   $bdd= new PDO("mysql:host=localhost; dbname=midterm", 'bole8823', '');
   $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
   
   
    $sql = "SELECT firstName, lastName FROM `m_students` WHERE gender = 'F' ORDER BY `lastName` ASC";
    $stmt = $dbConn -> prepare ($sql);
    $stmt -> execute ( array ( ':id' => '1') );
   
   
   
    while ($row = $stmt -> fetch())
    {
       echo $row['firstName'] . " " . $row['lastName'];
       echo "<br>";
    } 
    echo "<br><br>";
    
    $sql = "SELECT firstName, lastName, grade FROM `m_students` s INNER JOIN `m_gradebook` g ON s.studentId = g.studentId AND g.grade < 50 ORDER BY g.grade ASC;";
    $stmt = $dbConn -> prepare ($sql);
    $stmt -> execute ( array ( ':id' => '1') );
    while ($row = $stmt -> fetch()) {
       echo $row['firstName'] . " " . $row['lastName'] . " " . $row['grade'];
       echo "<br>";
    }
    
    echo "<br><br>";
    
   
    $sql = "SELECT title, dueDate FROM `m_assignments` a INNER JOIN `m_gradebook` g ON a.assignmentId != g.assignmentId ORDER BY a.dueDate ASC;";
    $stmt = $dbConn -> prepare ($sql);
    $stmt -> execute ( array ( ':id' => '1') );
    while ($row = $stmt -> fetch()) {
       echo $row['firstName'] . " " . $row['lastName'] . " " . $row['grade'];
       echo "<br>";
    }
     echo "<br><br>";
     
     $sql = "SELECT firstName, lastName, grade FROM `m_students` s INNER JOIN `m_gradebook` g ON s.studentId = g.studentId AND g.grade < 50 ORDER BY g.grade ASC;";
    $stmt = $dbConn -> prepare ($sql);
    $stmt -> execute ( array ( ':id' => '1') );
    while ($row = $stmt -> fetch()) {
       echo $row['firstName'] . " " . $row['lastName'] . " " . $row['grade'];
       echo "<br>";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Program 2 </title>
    </head>
    <body>
 
    </body>
</html>
