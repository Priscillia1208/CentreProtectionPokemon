<?php
$photos = ['Bulbi.png', 'Cara.png', 'Doudou.jpg', 'Mèche.png', 'Pika.jpg', 'Sala.jpg'];
$idPokemon = $_GET['identifiant'];
$pdo = new PDO('mysql:dbname=CentreProtectionPokemon;host=127.0.0.1','root');
$statement = $pdo->prepare('SELECT * FROM pokemon WHERE id = :idPokemon');
$statement->bindValue('idPokemon', $idPokemon);
$statement->execute();
$resultat = $statement->fetchAll();

print_r($resultat);
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

<div class="container-global container">
    <h1 class="detailTitre">Pokemon choisi: <?php
        echo $resultat[0]['nom'];
        ?></h1>
    <div class="sectionPhotoDescription d-flex flex-column align-items-center ">
        <div class="photoPokemon">
            <img src="<?php
            foreach ($photos as $photo){
                $nomPhoto = strstr($photo, '.', true );
                $typePhoto = strstr($photo, '.', false );
                if ($nomPhoto == $resultat[0]['nom']){
                    echo 'img/photos/'. $nomPhoto. $typePhoto;
                }
            }
            ?>" alt="photo du pokemon">
        </div>
        <div class="descriptionPokemon">
            <p>Description: <?php
                echo $resultat[0]['description']
                ?></p>
        </div>
    </div>
    <div class="sectionCaracteristiques d-flex justify-content-center">
        <div class="caracteristiquesPokemons">
            <ul>
                <li>Race: <?php
                    $idRacePokemon = $resultat[0]['idRace'];
                    $statementRace = $pdo->prepare('SELECT nomRace FROM race WHERE raceId= :idRacePokemon');
                    $statementRace->bindValue('idRacePokemon', $idRacePokemon);
                    $statementRace->execute();
                    $resultatRace = $statementRace->fetchAll();
                    echo $resultatRace[0]['nomRace'];
                    ?>
                </li>
                <li>Type: <?php
                    $idTypePokemon = $resultat[0]['idType'];
                    $statementType = $pdo->prepare('SELECT type FROM type WHERE id= :idTypePokemon');
                    $statementType-> bindValue('idTypePokemon', $idTypePokemon);
                    $statementType->execute();
                    $resultatType = $statementType->fetchAll();
                    echo $resultatType[0]['type'];
                    ?>
                </li>
                <li>Poids: <?php
                    $poidsPokemon = $resultat[0]['poidsKg'];
                    echo $poidsPokemon;
                    ?> kg
                </li>
                <li>Taille: <?php
                    $taillePokemon = $resultat[0]['tailleCm'];
                    echo $taillePokemon?>
                     cm
                </li>
            </ul>
        </div>
        <div class="faiblessesQualites ms-5">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <th scope="col">Qualités</th>
                    <th scope="col">Faiblesses</th>
                </thead>
                <tbody>
                    <tr>
                        <td><?php
                            $qualiteIdPokemon = $resultat[0]['idQualite'];
                            $statementQualite = $pdo->prepare('SELECT qualite FROM qualite WHERE id = :qualiteIdPokemon');
                            $statementQualite->bindValue('qualiteIdPokemon', $qualiteIdPokemon);
                            $statementQualite->execute();
                            $resultatQualite = $statementQualite->fetchAll();
                            echo $resultatQualite[0]['qualite'];
                            ?>
                        </td>
                        <td><?php
                            $faiblesseIdPokemon = $resultat[0]['idFaiblesse'];
                            $statementFaiblesse = $pdo->prepare('SELECT faiblesse FROM faiblesse WHERE id = :faiblesseIdPokemon');
                            $statementFaiblesse->bindValue('faiblesseIdPokemon', $faiblesseIdPokemon);
                            $statementFaiblesse->execute();
                            $resultatFaiblesse = $statementFaiblesse->fetchAll();
                            echo $resultatFaiblesse[0]['faiblesse'];
                            ?></td>

                    </tr>
                </tbody>
            </table>

        </div>

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

<?php





