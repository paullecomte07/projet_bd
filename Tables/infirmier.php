<?php
require('header.php');

$nom = "Infirmier";

$req = mysqli_query($base,"SELECT * FROM ".$nom);


include('affichage.php');

?>