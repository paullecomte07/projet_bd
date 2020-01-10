<?php
require('header.php');

$nom = "Hospitalisation";

$req = mysqli_query($base,"SELECT * FROM ".$nom);

include('affichage.php');

?>