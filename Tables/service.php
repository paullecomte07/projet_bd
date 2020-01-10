<?php
require('header.php');

$nom = "Service";

$req = mysqli_query($base,"SELECT * FROM ".$nom);


include('affichage.php');

?>