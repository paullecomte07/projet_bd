<?php
require('header.php');

$nom = "Medecin";

$req = mysqli_query($base,"SELECT * FROM ".$nom);


include('affichage.php');

?>