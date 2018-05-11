<?php
try
{
	// On se connecte à MySQL
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'bole8823', '');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

// Si tout va bien, on peut continuer

// On récupère tout le contenu de la table jeux_video
$reponse = $bdd->query('SELECT * FROM jeux_video');

// On affiche chaque entrée une à une
while ($donnees = $reponse->fetch())
{
?>
    <p>
    <strong>Jeu</strong> : <?php echo $donnees['nom']; ?><br />
    prossesseur : <?php echo $donnees['possesseur']; ?><br /> Prix : <?php echo $donnees['prix']; ?> euros !<br />
    Utilisation : <?php echo $donnees['console']; ?> <br /> Nombre :  <?php echo $donnees['nbre_joueurs_max']; ?> au maximum<br />
    <?php echo $donnees['possesseur']; ?> a laissé ces commentaires sur <?php echo $donnees['nom']; ?> : <em><?php echo $donnees['commentaires']; ?><br /><br /><br /><br /></em>
   </p>
<?php
}

$reponse->closeCursor(); // Termine le traitement de la requête

?>


 

<?php

// afficher les noms de jeux 

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'bole8823', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$reponse = $bdd->query('SELECT nom FROM jeux_video');

while ($donnees = $reponse->fetch())
{
	echo $donnees['nom'] . '<br />';
}

$reponse->closeCursor();

?>



<?php
// afficher les jeux vidéos dont le professeur est Patrick 

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'bole8823', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$reponse = $bdd->query('SELECT nom, possesseur FROM jeux_video WHERE possesseur=\'Patrick\'');

while ($donnees = $reponse->fetch())
{
	echo $donnees['nom'] . ' appartient à ' . $donnees['possesseur'] . '<br />';
}

$reponse->closeCursor();

?>



<?php
// jeux ordonner par prix : 

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$reponse = $bdd->query('SELECT nom, prix FROM jeux_video ORDER BY prix');

while ($donnees = $reponse->fetch())
{
    echo $donnees['nom'] . ' coûte ' . $donnees['prix'] . ' EUR<br />';
}

$reponse->closeCursor();

?>

//jeux appartenant à une personne et dont le prix ne dépasse pas une certaine somme
/
/
 <?php
 
 
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'bole8823', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$req = $bdd->prepare('SELECT nom, prix FROM jeux_video WHERE possesseur = ?  AND prix <= ? ORDER BY prix');
$req->execute(array($_GET['possesseur'], $_GET['prix_max']));

echo '<ul>';
while ($donnees = $req->fetch())
{
	echo '<li>' . $donnees['nom'] . ' (' . $donnees['prix'] . ' EUR)</li>';
}
echo '</ul>';

$req->closeCursor();

?>