<?php

if ( isset( $_POST['submit'] ) ) {
    //récupérer les données du formulaire en utilisant
    //la valeur des attributs name comme clé
    $email = $_POST['email'];
    $motDePasse = $_POST['motDePasse'];
}
print_r($_POST);
print_r($_POST['email']);
print_r($_POST['motDePasse']);

$pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=CentreProtectionPokemon', 'root');
$statRenvoiRole = $pdo->prepare('SELECT roleUtilisateur FROM utilisateur WHERE email = :email AND motDePasse = :motDePasse');
$statRenvoiRole->bindValue('email', $_POST['email']);
$statRenvoiRole->bindValue('motDePasse', $_POST['motDePasse']);
$statRenvoiRole->execute();
$resultatRole = $statRenvoiRole->fetchAll();
print_r($resultatRole);

if ($resultatRole[0] == 'visiteur'){
    $renvoi = "formulaireContact.php"; ?>
    <form
       method="post" action="<?php echo $renvoi?>"</form>
<?php }
else {
    $renvoi = "plateformeAdmin.php"; ?>
       <form method="post" action="<?php echo $renvoi?>"></form>
<?php }
?>