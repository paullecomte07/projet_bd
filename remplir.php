<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="includes/icon.ico">

    <title>Projet BDD</title>

    <!-- Bootstrap core CSS -->
    <link href="includes/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="includes/stylesheet.css" rel="stylesheet">
    <link href="includes/cover.css" rel="stylesheet">
    <link href="includes/offcanvas.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<script src="includes/jquery-3.3.1.slim.min.js" ></script>
<script src="includes/popper.min.js" ></script>
<?php

include_once 'header.php';
$conn->query('USE bddplnvk;')  or die($conn->error);

print_r($_POST['bdd']);
if(!(isset($_POST['csv'])) && isset($_GET['bdd']) ) {
    $filename = "Enregistrements/".$_GET['bdd'].".csv";
    $file = fopen($filename, "r");



    $sql = "INSERT INTO ".$_GET['bdd'] ." (";
    $i = 0;

    for(; $i < count($tables[$_GET['bdd']])-1; $i++ ){
        $sql =  $sql . $tables[$_GET['bdd']][$i]. ",";

    }
    $sql =  $sql . $tables[$_GET['bdd']][$i]. ")";


    while (($donne = fgetcsv($file, 10000,";")) != FALSE)
    {
        $sqlprime = " values(";
        $donne_util = array_slice($donne,4);


        for($i = 0; $i < count($donne_util)-1; $i++ ){
            $sqlprime =  $sqlprime ."'$donne_util [$i]',";
        }
        print_r($sqlprime);
        $sqlprime =  $sqlprime."'" .$donne[count($donne)-1]. "');";

        //echo $sql.$sqlprime.'<br>';
        //$conn->query($sql.$sqlprime) or die(print_r($conn->error_list));
    }
    fclose($file);
    header($location);
} else {?>
<nav class="navbar navbar-fixed-top navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="navbar-brand" >Projet bdd</div>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
                <li class="active"><a href="remplir.php">Remplir</a></li>
                <li><a href="Requetes.php">Requêtes</a></li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="display.php" id="navbardrop" data-toggle="dropdown">
                        Tables
                        <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-center">
                        <a class="text-muted btn btn-dark text-center" href="display.php?bdd=Infirmier">Activites</a>
                        <div class="dropdown-divider"></div>
                        <a class="text-muted btn btn-dark text-center" href="display.php?bdd=Classes">Classes</a>
                        <div class="dropdown-divider"></div>
                        <a class="text-muted btn btn-dark text-center" href="display.php?bdd=Eleve">Eleve</a>
                        <div class="dropdown-divider"></div>
                        <a class="text-muted btn btn-dark text-center" href="display.php?bdd=Repartition">Repartition</a>
                    </div>
                </li>
            </ul>
        </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
</nav><!-- /.navbar -->

<div class="container">

    <div class="row row-offcanvas row-offcanvas-right">


        <div class="jumbotron">
            <h3 class="cover-heading text-muted">Veuillez choisir la table à remplir à partir d'un fichier CSV.</h3>

            <div class="dropdown">
                <a class="btn btn-secondary btn-lg text-muted" href="display.php" id="navbardrop" data-toggle="dropdown">
                    Tables à remplir
                    <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-center">
                    <a class="text-muted btn btn-dark text-center" href="remplir.php?bdd=Infirmier">Activites</a>
                    <div class="dropdown-divider"></div>
                    <a class="text-muted btn btn-dark text-center" href="remplir.php?bdd=Classes">Classes</a>
                    <div class="dropdown-divider"></div>
                    <a class="text-muted btn btn-dark text-center" href="remplir.php?bdd=Eleve">Eleve</a>
                    <div class="dropdown-divider"></div>
                    <a class="text-muted btn btn-dark text-center" href="remplir.php?bdd=Repartition">Repartition</a>
                </div>
            </div>
            <h3 class="cover-heading text-muted">Vous pouvez remplir les tables manuellement en choisissant la table dans l'onglet <a class="text-muted" href="display.php">Tables</a></h3>

            <div class="dropdown">
                <a class="text-muted btn btn-secondary btn-lg" href="display.php" id="navbardrop" data-toggle="dropdown">
                    Tables à remplir
                    <span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-center">
                    <a class="text-muted btn btn-dark text-center" href="display.php?bdd=Activites#add">Activites</a>
                    <div class="dropdown-divider"></div>
                    <a class="text-muted btn btn-dark text-center" href="display.php?bdd=Classes#add">Classes</a>
                    <div class="dropdown-divider"></div>
                    <a class="text-muted btn btn-dark text-center" href="display.php?bdd=Eleve#add">Eleve</a>
                    <div class="dropdown-divider"></div>
                    <a class="text-muted btn btn-dark text-center" href="display.php?bdd=Repartition#add">Repartition</a>
                </div>
            </div>
        </div>

    </div><!--/row-->

    <hr>
    <?php } $conn->close(); ?>

</div><!--/.container-->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="includes/jquery-1.12.4.min.js" ></script>
<script>window.jQuery || document.write('<script src="includes/jquery.min.js"><\/script>')</script>
<script src="includes/bootstrap.min.js"></script>
<script src="includes/offcanvas.js"></script>
</body>
</html>
