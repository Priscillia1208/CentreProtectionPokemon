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
