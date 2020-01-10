<?php
require('header.php');

$nom = "Salle";

$req = mysqli_query($base,"SELECT * FROM ".$nom);


include('affichage.php');

?>