<?php
// 1. Connection et objetnent objet pdo
$pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=CentreProtectionPokemon', 'root');

// 2. Requete et récup statement
$stm = $pdo->query('SELECT * FROM pokemon');

// 3. Récup les données résultant de ta req
$pokemons = $stm->fetchAll();

#print_r($pokemons);
?>

<?php
foreach ($pokemons as $pokemon){
    ?>
    <h2><a href="detail.php?id=<?php echo $pokemon['id'] ?>">Nom: <?php echo $pokemon['nom'] ?></a></h2>
    <p> Taille en cm : 50</p>
    <p> Poids en kg: 3</p>

    <?php
}
?>

<?php
//print_r($_GET);
//echo $_GET['id'];

// 0. Récup poinds et taille à partir params d'url: pour info, directement dans l'url de notre serveur local on a ajouté les param suivant: ?poids=2&taille=1 par exemple.
//La superglobale get renvoit un tableau associatif des paramètres passés dans l'url
$poids = $_GET['poids'];
$taille = $_GET['taille'];

// 1. récupère le pokemon du bon id, à partir bd ( bindValue :


$pdo = new PDO('mysql:dbname=CentreProtectionPokemon;host=127.0.0.1','root');
$statement = $pdo->prepare('SELECT * FROM pokemon WHERE tailleCm > :tailleMin AND poidsKg > :poidsMin');
$statement->bindValue('tailleMin', $poids);
$statement->bindValue('poidsMin', $taille);
$statement->execute();
$resultat = $statement->fetchAll();

print_r($resultat);

// 2.
