<?php

$number1= $_POST['number_entered1'];
$number2= $_POST['number_entered2'];

$submitbutton= $_POST['submit'];


$randomnumber1= mt_rand(1,10);
$randomnumber2= mt_rand(1,10);


?>


<form action="" method="POST">
Guess a Number Between 1 and 10: 
<input type="text" name="number_entered1" value=''/> <br><br>

<form action="" method="POST">
Guess a Number Between 1 and 10: 
<input type="text" name="number_entered2" value=''/> <br><br>


Result: 

<?php 
if ($submitbutton){
global $tries=0;
    $tries++;
    echo "number of tries : $tries";
    echo "</br>";
if (($number1 > 0) && ($number1 <11)){
        if ($number1 < $randomnumber1)
        {
            echo "the second number should be higher";
        }
        else if ($number1 > $randomnumber1)
        {
           echo "the second number should be lowe";
        }
        else 
        {
            echo "You've guessed the second number! ";
        }
    }

}
?>
        

echo "</br>";

<?php 
if ($submitbutton){

if (($number1 > 0) && ($number1 <11)){
        if ($number1 < $randomnumber1)
        {
            echo "the second number should be higher";
        }
        else if ($number1 > $randomnumber1)
        {
           echo "the second number should be lowe";
        }
        else 
        {
            echo "You've guessed the second number! ";
        }
    }

}
?>
echo "</br>";


<br><br>
<input type="submit" name="submit" value="Search"/><br><br>
</form>

