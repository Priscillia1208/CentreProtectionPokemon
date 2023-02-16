<?php

$pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=CentreProtectionPokemon', 'root');
?>

<?php
$statRace = $pdo->query('SELECT nomRace FROM race');
$statType = $pdo->query('SELECT type FROM type');
$statFaiblesse = $pdo->query('SELECT faiblesse FROM faiblesse');
$resultatRace = $statRace->fetchAll();
$resultatType = $statType->fetchAll();
$resultatFaiblesse = $statFaiblesse->fetchAll();
?>

<?php if ( isset( $_POST['submit'] ) ) {
    //récupérer les données du formulaire en utilisant
    //la valeur des attributs name comme clé

    $nom = $_POST['nom'];
    $race = $_POST['race'];
    $type = $_POST['type'];
    $poids = $_POST['poids'];
    $taille = $_POST['taille'];
    $faiblesse = $_POST['faiblesse'];


    $preparationRace = $pdo->prepare('SELECT raceId FROM race WHERE nomRace = :nomRace');
    $preparationRace->bindValue('nomRace', $race);
    $preparationRace->execute();
    $resultatIdRace = $preparationRace->fetch();


    $preparationType = $pdo->prepare('SELECT id FROM type WHERE type = :nomType');
    $preparationType->bindValue('nomType', $type);
    $preparationType->execute();
    $resultatIdType = $preparationType->fetch();


    $preparationFaiblesse = $pdo->prepare('SELECT id FROM faiblesse WHERE faiblesse = :nomFaiblesse');
    $preparationFaiblesse->bindValue('nomFaiblesse', $faiblesse);
    $preparationFaiblesse->execute();
    $resultatIdFaiblesse = $preparationFaiblesse->fetch();


    $statCreationPokemon = $pdo->prepare('INSERT INTO pokemon (nom, poidsKg, tailleCm, idRace, idType, idFaiblesse) VALUES (:nom, :poids, :taille, :idRace, :idType, :idFaiblesse)');
    $statCreationPokemon->bindValue('nom', $nom);
    $statCreationPokemon->bindValue('poids', $poids);
    $statCreationPokemon->bindValue('taille', $taille);
    $statCreationPokemon->bindValue('idRace', $resultatIdRace[0]);
    $statCreationPokemon->bindValue('idType', $resultatIdType[0]);
    $statCreationPokemon->bindValue('idFaiblesse', $resultatIdFaiblesse[0]);
    $statCreationPokemon->execute();
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
<h1>Bienvenue sur la plateforme d'administration</h1>

<!-------------CREATION POKEMON--------------->


<h2>Créer un nouveau pokemon</h2>
<hr />
<form method="post">
<div class="row">
    <div class="col">

        <div class="form-outline">
            <input type="text" id="form8Example3" class="form-control" name="nom"/>
            <label class="form-label" for="form8Example3">Nom</label>
        </div>
    </div>

    <div class="col">
        <div class="form-outline">
            <label class="form-label" for="form8Example4">Race</label>
            <select class="" aria-label="Choisissez une race" name="race">
                <option value="">Choisir une race</option>
                <?php
                foreach ($resultatRace as $race){ ?>
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
                <option value="">Choisir un type</option>
                <?php
                foreach ($resultatType as $type){ ?>
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
                <option value="">Choisir une faiblesse</option>
                <?php
                foreach ($resultatFaiblesse as $faiblesse){ ?>
                    <option value="<?php echo $faiblesse['faiblesse']; ?>"><?php echo $faiblesse['faiblesse']; ?></option>
                <?php }
                ?>
            </select>
        </div>
    </div>
    <div class="col">
        <div class="form-outline">
            <input type="text" id="form8Example4" class="form-control" name="poids" />
            <label class="form-label" for="form8Example4">Poids</label>
        </div>
    </div>
    <div class="col">
        <div class="form-outline">
            <input type="text" id="form8Example4" class="form-control" name="taille" />
            <label class="form-label" for="form8Example4">Taille</label>
        </div>
    </div>
</div>
<input type="submit" class="btn btn-warning btn-lg ms-2" name="submit">


</form>

<hr />

<!-------------RECAP--------------->

<h2>Liste des pokemons</h2>

<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Nom</th>
        <th scope="col">Race</th>
        <th scope="col">Type</th>
        <th scope="col">Poids</th>
        <th scope="col">Taille</th>
        <th scope="col">Faiblesse</th>
        <th scope="col">Qualité</th>
        <th scope="col">Date Arrivée</th>
        <th scope="col">Date Départ</th>
        <th scope="col">Motif de Départ</th>
        <th scope="col">Description</th>
        <th scope="col">Modifier</th>
        <th scope="col">Supprimer</th>
    </tr>
    </thead>
    <tbody>

        <?php
        $recapPokemon = $pdo->query('SELECT * FROM pokemon');
        $resultatRecapPok = $recapPokemon->fetchAll();
        ?>

        <?php
        foreach ($resultatRecapPok as $recapPok){
            ?>
        <tr>
            <td><?php echo $recapPok['nom']?></td>
            <td><?php
                $idRace = $recapPok['idRace'];
                $statRaceRecap = $pdo-> prepare('SELECT nomRace FROM race WHERE raceId = :idRace');
                $statRaceRecap->bindValue('idRace', $idRace);
                $statRaceRecap->execute();
                $resultatRaceRecap = $statRaceRecap->fetch();
                echo $resultatRaceRecap['nomRace'];

                ?>
            </td>
            <td><?php
                $idType = $recapPok['idType'];
                $statTypeRecap = $pdo-> prepare('SELECT type FROM type WHERE id = :idType');
                $statTypeRecap->bindValue('idType', $idType);
                $statTypeRecap->execute();
                $resultatTypeRecap = $statTypeRecap->fetch();
                echo $resultatTypeRecap['type'];
                ?>
            </td>
            <td><?php
                echo $recapPok['poidsKg'];
                ?>
            </td>
            <td><?php
                echo $recapPok['tailleCm'];
                ?>
            </td>
            <td><?php
                $idFaiblesse = $recapPok['idFaiblesse'];
                $statFaiblesseRecap = $pdo-> prepare('SELECT faiblesse FROM faiblesse WHERE id = :idFaiblesse');
                $statFaiblesseRecap->bindValue('idFaiblesse', $idFaiblesse);
                $statFaiblesseRecap->execute();
                $resultatFaiblesseRecap = $statFaiblesseRecap->fetch();
                echo $resultatFaiblesseRecap['faiblesse'];
                ?>
            </td>
            <td><?php
                $idQualite = $recapPok['idQualite'];
                $statQualiteRecap = $pdo-> prepare('SELECT qualite FROM qualite WHERE id = :idQualite');
                $statQualiteRecap->bindValue('idQualite', $idQualite);
                $statQualiteRecap->execute();
                $resultatQualiteRecap = $statQualiteRecap->fetch();
                echo $resultatQualiteRecap['qualite'];
                ?>
            </td>
            <td><?php
                echo $recapPok['dateArrivee'];
                ?>
            </td>
            <td><?php
                echo $recapPok['dateDepart'];
                ?>
            </td>
            <td><?php
                echo $recapPok['motifDepart'];
                ?>
            </td>
            <td><?php
                echo $recapPok['description'];
                ?>
            </td>
            <td><a href="modificationFormulaire.php?id=<?php echo $recapPok['id'] ?>"><button type="submit" name="modifier">Modifier</a></td>
            <td><button type="submit" name="supprimer">Supprimer</td>
        </tr>
        <?php }
        //print_r($resultatRecapPok);
        ?>

    </tr>

    </tbody>
</table>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>