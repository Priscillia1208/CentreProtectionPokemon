<?php
// 1. Connection et objetnent objet pdo
$pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=CentreProtectionPokemon', 'root');

// 2. Requete et récup statement
$stm = $pdo->query('SELECT * FROM pokemon');
$stm2 = $pdo->query('SELECT nomRace, raceId FROM race INNER JOIN pokemon ON pokemon.idRace = race.raceId');
// 3. Récup les données résultant de ta req
$pokemons = $stm->fetchAll();
$racesPok = $stm2->fetchAll();

//print_r($pokemons);
//print_r($racesPok);

$photo = ['bulbi.png', 'cara.png', 'doudou.jpg', 'meche.png', 'pika.jpg', 'sala.jpg']
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

    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom fixed-top">
        <img class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none logo" src="img/logoRougeBlanc.jpg">


        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="#" class="nav-link px-2 link-secondary">Accueil</a></li>
            <li><a href="#" class="nav-link px-2 link-dark">Conditions d'adoption</a></li>
            <li><a href="#" class="nav-link px-2 link-dark">Tarifs</a></li>
            <li><a href="#" class="nav-link px-2 link-dark">Qui sommes nous ?</a></li>
        </ul>

        <div class="col-md-3 text-end">
            <button type="button" class="btn btn-outline-dark me-2">Login</button>
            <button type="button" class="btn btn-dark">Sign-up</button>
        </div>
    </header>

    <body>
    <!-- Background image -->
    <div class="p-5 text-center bg-image mt-4" style="background-image: url('img/accueil (1) (1).png');height: 400px" >
        <div class="mask mt-4" style="background-color: rgba(0, 0, 0, 0.6);" >
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="text-white">
                    <h1 class="mb-3">Centre de protection des pokemon</h1>
                    <h4 class="mb-3">Adoptez un pokemon abandonné !</h4>
                </div>
            </div>
        </div>
    </div>

    <?php
    foreach ($pokemons as $pokemon){
    ?>

    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title"><?php echo $pokemon['nom']?></h5>
            <h6 class="card-subtitle mb-2 text-muted">Race:
                <?php
                $totalRace = [];
                    foreach ($racesPok as $racePok) {
                        if ($racePok['raceId'] == $pokemon['idRace']) {
                            $totalRace += [$racePok['nomRace']];
                        }
                }
                    echo $totalRace[0];
                ?>
            </h6>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="card-link">Détail</a>
        </div>
    </div>

    <?php
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    </body>
</html>
