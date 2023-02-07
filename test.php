<?php

$photo = ['Bulbi.png', 'Cara.png', 'Doudou.jpg', 'Meche.png', 'Pika.jpg', 'Sala.jpg'];
$transfo = $photo[0];
var_dump($transfo);
//echo strstr($transfo, '.', true );
echo strstr($transfo, '.', false );

/* faire une boucle sur pokemon nom et une sur photo en extryant la chaine de carctere. Si il trouve le nom exact, concatener
pour reconstituer le chemin de l'image correspondante*/



