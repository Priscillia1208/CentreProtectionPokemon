<?php
// Vérifier si le formulaire est soumis
if ( isset( $_POST['submit'] ) ) {
    /* récupérer les données du formulaire en utilisant
       la valeur des attributs name comme clé
      */
    $nom = $_POST['nom'];
    $age = $_POST['age'];
    $adresse = $_POST['adresse'];
    // afficher le résultat
    echo '<h3>Informations récupérées en utilisant POST</h3>';
    echo 'Nom : ' . $nom . ' Age : ' . $age . ' Adresse : ' . $adresse;
    exit;
}

