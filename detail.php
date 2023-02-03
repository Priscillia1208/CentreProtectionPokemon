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