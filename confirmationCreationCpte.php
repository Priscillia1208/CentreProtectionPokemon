
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
<h1>Félicitation, votre compte est créé !</h1>
<?php

print_r($_POST);

if ( isset( $_POST['submit'] ) ) {
    //récupérer les données du formulaire en utilisant
       //la valeur des attributs name comme clé

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse = $_POST['adresse'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $motDePasse = $_POST['motDePasse'];
}
$roleUtilisateur = 'visiteur';
$pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=CentreProtectionPokemon', 'root');
$statForm = $pdo->prepare('INSERT INTO utilisateur (email, motDePasse, nomUtilisateur, prenomUtilisateur, telephone, adresse, roleUtilisateur) VALUES (:email, :motDePasse, :nomUtilisateur, :prenomUtilisateur, :telephone, :adresse, :roleUtilisateur)');
$statForm->bindValue('email', $email);
$statForm->bindValue('motDePasse', $motDePasse);
$statForm->bindValue('nomUtilisateur', $nom);
$statForm->bindValue('prenomUtilisateur', $prenom);
$statForm->bindValue('telephone', $telephone);
$statForm->bindValue('adresse', $adresse);
$statForm->bindValue('roleUtilisateur', $roleUtilisateur);
$statForm->execute();
$resultat = $statForm->fetchAll();

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>