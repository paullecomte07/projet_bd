<!Doctype html>
<html>
  <head>
      <meta charset="utf-8" >
      <title>Projet BDD</title>

      <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
      <link rel="stylesheet" href="bootstrap/css/style.css">
      <link rel="stylesheet" href="css_stylesheet/index.css">

  </head>
  <body>
  <?php
  	// Importation et exécution du fichier
  	require('fonctions.php');
  ?>
  <div class="conteneur"><h1>Projet bases de données</h1></div>

  <?php
        if(array_key_exists('button1', $_POST)) {
            button1();
        }
        else if(array_key_exists('button2', $_POST)) {
            button2();
        }
        function button1() {
            echo "This is Button1 that is selected";
        }
        function button2() {
            echo "This is Button2 that is selected";
        }
    ?>
  <div class="conteneur-button">
    <form method="post">
        <input type="submit" name="button1" class="btn btn-primary m-2" value="Créer une nouvelle base" />

        <input type="submit" name="button2" class="btn btn-secondary m-2" value="Ajouter des éléments" />
        <input type="submit" name="button2" class="btn btn-danger m-2" value="Effacer la base de donnée" />
    </form>
  </div>

  </body>
</html>
