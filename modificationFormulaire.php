<?php

// REQUETES DE MODIFICATION
$idPokemon = $_GET['id'];

$pdo = new PDO('mysql:dbname=CentreProtectionPokemon;host=127.0.0.1','root');
$statModifPok = $pdo->prepare('SELECT * FROM pokemon WHERE id = :idPokemon');
$statModifPok->bindValue('idPokemon', $idPokemon);
$statModifPok->execute();
$resultatModifPok = $statModifPok->fetchAll();
print_r($resultatModifPok);


$statRacePok = $pdo->prepare('SELECT nomRace FROM race WHERE raceId = :raceId');
$statRacePok->bindValue('raceId', $resultatModifPok[0]['idRace']);
$statRacePok->execute();
$nomRacePok = $statRacePok->fetch();

$statRace = $pdo->query('SELECT nomRace FROM race');
$statRace->execute();
$resultatStatRace = $statRace->fetchAll();

$statType = $pdo->prepare('SELECT type FROM type WHERE id = :idType');
$statType->bindValue('idType', $resultatModifPok[0]['idType']);
$statType->execute();
$resultatStatType = $statType->fetch();

$statTypePok = $pdo->query('SELECT type FROM type');
$statTypePok->execute();
$resultatTypePok = $statTypePok->fetchAll();

$statFaiblesse = $pdo->prepare('SELECT faiblesse FROM faiblesse WHERE id = :idFaiblesse');
$statFaiblesse->bindValue('idFaiblesse', $resultatModifPok[0]['idFaiblesse']);
$statFaiblesse->execute();
$resultatStatFaiblesse = $statFaiblesse->fetch();

$statFaiblessePok = $pdo->query('SELECT faiblesse FROM faiblesse');
$statFaiblessePok->execute();
$resultatFaiblessePok = $statFaiblessePok->fetchAll();

if (isset($_POST['submit'])){
    $nouveauNom = $_POST['nom'];
    $nouvelleRace = $_POST['race'];
    $nouveauType = $_POST['type'];
    $nouveauPoids = $_POST['poids'];
    $nouvelleTaille = $_POST['taille'];
    $nouvelleFaiblesse = $_POST['faiblesse'];

    $insertionNom = $pdo->prepare('UPDATE pokemon SET nom = :nouveauNom WHERE id = :idPokemon ');
    $insertionNom->bindValue('nouveauNom', $nouveauNom);
    $insertionNom->bindValue('idPokemon', $resultatModifPok[0]['id']);
    $insertionNom->execute();

    $preparationInsertionRace = $pdo->prepare('SELECT raceId FROM race WHERE nomRace = :nomRace');
    $preparationInsertionRace->bindValue('nomRace', $nouvelleRace);
    $preparationInsertionRace->execute();
    $resultatPreparationIdRace = $preparationInsertionRace->fetch();
    print_r($resultatPreparationIdRace);
    $insertionRace = $pdo->prepare('UPDATE pokemon SET idRace = :nouvelleRace WHERE id = :idPokemon ');
    $insertionRace->bindValue('nouvelleRace', $resultatPreparationIdRace[0]);
    $insertionRace->bindValue('idPokemon', $resultatModifPok[0]['id']);
    $insertionRace->execute();

    $preparationInsertionType = $pdo->prepare('SELECT id FROM type WHERE type = :type');
    $preparationInsertionType->bindValue('type', $nouveauType);
    $preparationInsertionType->execute();
    $resultatPreparationIdType = $preparationInsertionType->fetch();
    $insertionType = $pdo->prepare('UPDATE pokemon SET idType = :nouveauType WHERE id = :idPokemon ');
    $insertionType->bindValue('nouveauType', $resultatPreparationIdType[0]);
    $insertionType->bindValue('idPokemon', $resultatModifPok[0]['id']);
    $insertionType->execute();

    $insertionPoids = $pdo->prepare('UPDATE pokemon SET poidsKg = :nouveauPoids WHERE id = :idPokemon ');
    $insertionPoids->bindValue('nouveauPoids', $nouveauPoids);
    $insertionPoids->bindValue('idPokemon', $resultatModifPok[0]['id']);
    $insertionPoids->execute();

    $preparationInsertionFaiblesse = $pdo->prepare('SELECT id FROM faiblesse WHERE faiblesse = :faiblesse');
    $preparationInsertionFaiblesse->bindValue('faiblesse', $nouvelleFaiblesse);
    $preparationInsertionFaiblesse->execute();
    $resultatPreparationIdFaiblesse = $preparationInsertionFaiblesse->fetch();
    $insertionFaiblesse = $pdo->prepare('UPDATE pokemon SET idFaiblesse = :nouvelleFaiblesse WHERE id = :idPokemon ');
    $insertionFaiblesse->bindValue('nouvelleFaiblesse', $resultatPreparationIdFaiblesse[0]);
    $insertionFaiblesse->bindValue('idPokemon', $resultatModifPok[0]['id']);
    $insertionFaiblesse->execute();

    // RETOUR PAGE ACCUEIL SI SUBMIT AVEC MAJ RECAP POKEMON

    header('Location: plateformeAdmin.php');


}



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Centre de protection des pokemon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

</head>

<body>

<!-------------MODIFICATION--------------->


<h2>Modifier les données du pokemon</h2>
<hr />
<form method="post">
<div class="row">
    <div class="col">

        <div class="form-outline">
            <input type="text" id="form8Example3" class="form-control" name="nom"
                   value="<?php echo $resultatModifPok[0]['nom'] ?>"/>
            <label class="form-label" for="form8Example3">Nom</label>
        </div>
    </div>

    <div class="col">
        <div class="form-outline">
            <label class="form-label" for="form8Example4">Race</label>
            <select class="" aria-label="Choisissez une race" name="race">
                <option value="<?php
                echo $nomRacePok[0];
                ?>">
                    <?php
                    echo $nomRacePok[0];
                    ?>
                </option>
                <?php
                foreach ($resultatStatRace as $race){ ?>
                <option value="<?php echo $race['nomRace']; ?>"><?php echo $race['nomRace']; ?></option>
                <?php }
                ?>
            </select>
        </div>
    </div>
    <div class="col">
        <div class="form-outline">
            <label class="form-label" for="form8Example4">Type</label>
            <select class="" aria-label="Choisissez un type" name="type">
                <option value="<?php echo $resultatStatType['type']?>"><?php echo $resultatStatType['type']?></option>
                <?php
                foreach ($resultatTypePok as $type){ ?>
                    <option value="<?php echo $type['type']; ?>"><?php echo $type['type']; ?></option>
                <?php }
                ?>
            </select>

        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-outline">
            <label class="form-label" for="form8Example4">Faiblesse</label>
            <select class="" aria-label="Choisissez une faiblesse" name="faiblesse">
                <option value="<?php echo $resultatStatFaiblesse['faiblesse']?>"><?php echo $resultatStatFaiblesse['faiblesse']?></option>
                <?php
                foreach ($resultatFaiblessePok as $faiblesse){ ?>
                    <option value="<?php echo $faiblesse['faiblesse']; ?>"><?php echo $faiblesse['faiblesse']; ?></option>
                <?php }
                ?>
            </select>
        </div>
    </div>
    <div class="col">
        <div class="form-outline">
            <input type="text" id="form8Example4" class="form-control" name="poids" value="<?php echo $resultatModifPok[0]['poidsKg']?>" />
            <label class="form-label" for="form8Example4">Poids en kg :</label>
        </div>
    </div>
    <div class="col">
        <div class="form-outline">
            <input type="text" id="form8Example4" class="form-control" name="taille" value="<?php echo $resultatModifPok[0]['tailleCm']?>"/>
            <label class="form-label" for="form8Example4">Taille en cm: </label>
        </div>
    </div>
</div>
<input type="submit" class="btn btn-warning btn-lg ms-2" name="submit">

</form>

<hr />
</body>

</html>
