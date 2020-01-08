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
  <div class="conteneur"><h1>Projet bases de données</h1></div>

  <?php
        if(array_key_exists('button1', $_POST)) {
            if(creerTables()){
              echo "les tables ont été crées";
            }
        }
        else if(array_key_exists('button2', $_POST)) {
            button2();
        }
        function button1() {
            echo "This is Button1 that is selected";
        }
        function button2() {
          if(supprimerBDD()){
            echo "les tables ont été supprimées";
          }

        }
    ?>

  <div class="conteneur-button">
    <form method="post">
        <input type="submit" name="button1" class="btn btn-primary m-2" value="Créer une nouvelle base" />
        <input type="submit" name="button2" class="btn btn-danger m-2" value="Effacer la base de donnée" />
    </form>
  </div>


  <div class="conteneur-button">
      <div class="row">
          <form class="form-horizontal" action="import_csv" method="post" name="upload_excel" enctype="multipart/form-data">
              <fieldset>
                  <div class="form-group">
                      <label class="col-md-4 control-label" for="filebutton">Ajouter des fichiers</label>
                      <div class="col-md-4">
                          <input type="file" name="file" id="file" class="input-large btn btn-primary">
                      </div>
                  </div>
                  <!-- Button -->
                  <div class="form-group">
                      <div class="col-md-4">
                          <button type="submit" id="submit" name="Import" class="btn btn-success button-loading" data-loading-text="Loading...">Importer</button>
                      </div>
                  </div>
              </fieldset>
          </form>
      </div>

  </div>


  <div class="dropdown show">
    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Dropdown link
    </a>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
      <a class="dropdown-item" href="#">Action</a>
      <a class="dropdown-item" href="#">Another action</a>

    </div>
  </div>

  <div>
    <div class="requete"> s</div>
  </div>



  <p class="lead">Remplissez à partir d'un fichier CSV ou manuellement.</p>
                    <form action="remplir.php" method="post">
                        <p class="lead"><button class="btn btn-info btn-block" name="csv" value="1">Remplir à l'aide d'un csv</button></p>
                    </form>

                    <form action="display.php" method="post">
                    <p class="lead"><button class="btn btn-info btn-block" name="manuel" value="1">Remplir manuellement</button></p>
                    </form>



  </body>
</html>
