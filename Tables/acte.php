<?php
require('header.php');

$nom = "Acte";

$req = mysqli_query($base,"SELECT * FROM ".$nom);


include('affichage.php');

?>