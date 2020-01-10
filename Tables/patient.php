<?php
require('header.php');

$nom = "Patient";

$req = mysqli_query($base,"SELECT * FROM ".$nom);


include('affichage.php');

?>