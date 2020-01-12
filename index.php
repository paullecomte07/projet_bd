<!Doctype html>
<html>
  <head>
      <meta charset="utf-8" >
      <title>Projet BDD</title>

      <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
      <link rel="stylesheet" href="bootstrap/css/style.css">
      <link rel="stylesheet" href="css_stylesheet/index.css">

      <script src="bootstrap/js/jquery.js"></script>
      <script src="bootstrap/js/popper.min.js"></script>
      <script src="bootstrap/js/bootstrap.min.js"></script>
      <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

  </head>
  <body>
  <?php
  	// Importation et exécution du fichier
  	require('fonctions.php');
  ?>

  <div class="conteneur mt-4"><h1>Projet bases de données</h1></div>

  <?php
        if(array_key_exists('button1', $_POST)) {
          if(creerTables()){
            echo "les tables ont été crées";
          }
        }
        else if(array_key_exists('button2', $_POST)) {
          majTables();
        }
        else if(array_key_exists('button3', $_POST)) {
          if(supprimerBDD()){
            echo "les tables ont été supprimées";
          }
        }
  ?>

  <div class="conteneur-button">
    <form method="post">
        <input type="submit" name="button1" class="btn btn-primary m-2" value="Créer une nouvelle base" />
        <input type="submit" name="button2" class="btn btn-primary m-2" value="Charger les enregistrements" />
        <input type="submit" name="button3" class="btn btn-danger m-2" value="Effacer la base de donnée" />
    </form>
  </div>

  <div class="conteneur-button">
    <a class="btn btn-warning" href="requetes.php">Requêtes SQL</a>
  </div>




  <div class="dropdown show m-3" style="text-align: center;">
    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Tables
    </a>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
      <a class="dropdown-item" href="Tables\acte.php">Acte</a>
      <a class="dropdown-item" href="Tables\hospitalisation.php">Hospitalisation</a>
      <a class="dropdown-item" href="Tables\infirmier.php">Infirmier</a>
      <a class="dropdown-item" href="Tables\medecin.php">Medecin</a>
      <a class="dropdown-item" href="Tables\patient.php">Patient</a>
      <a class="dropdown-item" href="Tables\salle.php">Salle</a>
      <a class="dropdown-item" href="Tables\service.php">Service</a>

    </div>
  </div>




  </body>
</html>
