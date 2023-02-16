<?php

$messageErreur = '';
if (isset($_POST['email'])) {
    //récupérer les données du formulaire en utilisant
    //la valeur des attributs name comme clé
    $email = $_POST['email'];
    $motDePasse = $_POST['motDePasse'];


    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=CentreProtectionPokemon', 'root');
    $statRenvoiRole = $pdo->prepare('SELECT * FROM utilisateur WHERE email = :email AND motDePasse = :motDePasse');
    $statRenvoiRole->bindValue('email', $_POST['email']);
    $statRenvoiRole->bindValue('motDePasse', $_POST['motDePasse']);
    $statRenvoiRole->execute();
    $resultatRole = $statRenvoiRole->fetch();

    if($resultatRole){
        session_start();
        $_SESSION['userConnect'] = $resultatRole;
        if ($resultatRole['roleUtilisateur'] == 'visiteur') {
            header('Location: formulaireContact.php');
            exit();
        } else if ($resultatRole['roleUtilisateur'] == 'administrateur'){
            header('Location: plateformeAdmin.php');
            exit();
        }
    } else {
        $messageErreur = 'Erreur de login';
    }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

</head>

<body>
<div class="bg-white border rounded-5">

    <section class="w-100 p-4 d-flex justify-content-center pb-4">

        <form style="width: 22rem;" method="post" class="validated-form" novalidate>
            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="email" id="form2Example1" class="form-control" name="email">
                <label class="form-label" for="form2Example1" style="margin-left: 0px;">Email address</label>
                <div class="form-notch">
                    <div class="form-notch-leading" style="width: 9px;"></div>
                    <div class="form-notch-middle" style="width: 88.8px;"></div>
                    <div class="form-notch-trailing"></div>
                </div>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <input type="password" id="form2Example2" class="form-control" name="motDePasse">
                <label class="form-label" for="form2Example2" style="margin-left: 0px;">Password</label>
                <div class="form-notch">
                    <div class="form-notch-leading" style="width: 9px;"></div>
                    <div class="form-notch-middle" style="width: 64.8px;"></div>
                    <div class="form-notch-trailing"></div>
                </div>
            </div>

            <?php echo $messageErreur; ?>

            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4">

                <div class="col">
                    <!-- Simple link -->
                    <a href="#!">Forgot password?</a>
                </div>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4" name="connexion">Connexion</button>


        </form>
    </section>


</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>


</body>

