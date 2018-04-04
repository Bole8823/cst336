<?php
   
    function creatDeck()
    {
      //Array with all the cards
      $deck = array();
      
      //creation of the deck
      for ($i = 1; $i <= 52; $i++ )
      {
        $deck[] = $i;
      }
      
      //randomize the deck
      shuffle($deck);
      
      return $deck;
    }
    
    function drawCard(&$deck,&$cards,$omit)
    {
        $j = count($cards);
       //to get one card of the end of the array
        $card = array_pop($deck);
        
        //print the card
       
        
        //to get the suit
        $suit = array("clubs", "diamonds", "hearts", "spades");
        
        //cardSuit is value of the floor((card-1)/13)
        $cardSuit = $suit[floor(($card-1) / 14)];
        
        //cardValue will be the mod of the card by 13
        $cardValue = $card % 13;
        
        //if the cardValue is 0 it means that will be the 13(K)
        if ($cardValue == 0)
        {
            $cardValue = 13;
        }
    
        if ($cardSuit == $omit)
        {
            drawCard($deck,$cards,$omit);
        }
        else
        {
            $cards[$j]["value"] = $cardValue;
            $cards[$j]["suit"] = $cardSuit;
        }
        
    }
     function printCard(&$cards,&$as,&$ks)
    {
      $size = count($cards);
      
      for ($i = 0; $i < $size; $i++)
      {
        $cardValue = $cards[$i]["value"];
        $cardSuit = $cards[$i]["suit"];
        
        if ($cardValue == 1)
        {
            $color = "yellow";
            $as++;
        }
        if ($cardValue == 13)
        {
            $color = "cyan";
            $ks++;
        }
        
        echo "<td bgcolor=\"".$color."\">";
        echo "<img class=\"cards\" src='cards/$cardSuit/$cardValue.png'/>";
        echo "</td>";
      }
    }
    function game($r, $c, $omit)
    {
        // echo "rows: " .$r. "<br>";
        // echo "columns: " .$c. "<br>";
        // echo "omit: " .$omit. "<br>";
        
      //create and shuffle deck
      $deck = creatDeck($omit);
      //print_r($deck);
      
      $as = 0;
      $ks = 0;
      
      $cards[] = array();
      $k = 0;
      for($t = 0; $t < $r; $t++) //each row
      {
        for ($i = 0; $i < $c; $i++) //each column
        {
          drawCard($deck,$cards[$k],$omit);
          $k++;
        }
      }
      
      $k = 0;
        echo "<table>";
        for($t = 0; $t < $r; $t++) //each row
        {
            echo "<tr>";
            for ($i = 0; $i < $c; $i++) //each column
            {
                printCard($cards[$k],$as,$ks);
                $k++;
            }
            echo "</tr>";
        }
        echo "</table>";
      echo "</div>";
      
      echo "<br><p>Number of Aces:".$as."</p>";
      echo "<br><p>Number of Kings:".$ks."</p>";
      
      if ($as > $ks)
        {
            echo "<br><h2 id=\"winner\">Aces win!!!</h2>";
        }
        if ($as < $ks)
        {
            echo "<br><h2 id=\"winner\">Kings win!!!</h2>";
        }
        if ($as == $ks)
        {
            echo "<br><h2 id=\"winner\">Tie!!!</h2>";
        }
      unset($deck);
      unset($cards);
    }
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
     
        <link rel="stylesheet" type="text/css" href="css/theme.css"> 
        <title> Find the Letter! </title>
         
        <style>
            body
            {
                text-align:center;
                height: 100%;
            }
            table, th, td
            {
                padding: 5px;
                margin: auto;
                border: 1px solid black;
            }
            
            #winner {
                margin-left: auto;
                margin-right: auto;
            }
        </style>
    </head>
    
    <body>
        <div class="container">
            <div class="content">
                <h1> Aces vs Kings</h1>
                
                <div class="entryForm">
                    <form action="program1.php" method="POST">
                        <div class="formEntry">
                            <div id="nRows">
                                <p>Number of Rows:
                                    <input type="text" name="rows" required/></p>
                                </p>
                            </div>
                            
                            <div id="nColumns">
                                <p>Number of Columns: 
                                    <input type="text" name="columns" required/></p>
                                </p>
                            </div>
                              
                          <div id="omitLetter">
                            <p>Suit to omit:
                                <select name="omit" required>
                                    <option value="hearts">hearts</option>
                                    <option value="clubs">clubs</option>
                                    <option value="diamonds">diamonds</option>
                                    <option value="spades">spades</option>
                                </select>
                            </p>
                          </div>
                           
                        </div>
                        
                        <div class="formSubmission">
                            <input type="submit" value="Submit Query">
                        </div>
                        
                        <div>
                            <?php
                                $r = intval($_POST["rows"]);
                                $c = intval($_POST["columns"]);
                                $omit = strval($_POST["omit"]);  
                                
                                if(($r*$c) > 39)
                                {
                                    echo "<br><p>! Error: product of columns and rows exceeds 39 !</p>";
                                }
                                else
                                {
                                    game($r,$c,$omit);
                                }
                                
                            ?>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </body>
