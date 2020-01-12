

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

<div style="text-align: center; margin: 59px 0px 67px 0px;">
  <h1>Réponses aux requêtes SQL sur la base de donnée</h1>
  <a href="index.php" class="btn btn-primary">Retour au menu</a>
</div>


<div class="container">

    <div class="row row-offcanvas row-offcanvas-right">

        <?php
          ini_set('auto_detect_line_endings',TRUE);
            header('Content-Type: text/html; charset=UTF-8');
  // Définition des fonctions
          $base = mysqli_connect ('localhost', 'root', '')
              or die("Impossible de se connecter : " . mysqli_error());

          mysqli_select_db($base,'bddplnvk') ;

        $requetes = array('SELECT m.nom FROM Medecin m JOIN Service s ON m.NumMed = s.NumMed WHERE s.Nom="cancerologie"' ,
                          'SELECT SUM(Nblits),sa.NumServ FROM Salle sa GROUP BY  sa.NumServ',
                          'SELECT sal.Nblits-ho.NbLitOccupe as NbLitsRestant, sal.NumSalle FROM (SELECT sa.Nblits, s.Nom, sa.NumSalle FROM Salle sa JOIN Service s ON s.NumService=sa.NumServ WHERE s.Nom="Cardiologie") as sal JOIN (SELECT COUNT(h.NumSalle) as NbLitOccupe,h.NumSalle FROM Hospitalisation h JOIN Service s ON s.NumService= h.NumService WHERE h.DateSortie >= "2018-07-04" AND h.DateEntree <= "2018-07-04" AND s.Nom= "Cardiologie"GROUP BY h.NumSalle) AS ho ON ho.NumSalle=sal.NumSalle',
                          'SELECT * FROM Patient p WHERE NumPat NOT IN (SELECT NumPat FROM Acte a JOIN Service s ON s.NumService=a.NumService WHERE s.Nom = "Cardiologie")',
                          'SELECT DISTINCT NumPat FROM (SELECT DISTINCT NumPat FROM (SELECT DISTINCT NumPat FROM (SELECT DISTINCT NumPat FROM (SELECT DISTINCT NumPat FROM (SELECT DISTINCT NumPat FROM Acte a WHERE a.NumPat IN (SELECT NumPat FROM Acte a JOIN Service s ON a.NumService=s.NumService WHERE s.Nom="Cardiologie")) a WHERE a.NumPat IN (SELECT NumPat FROM Acte a JOIN Service s ON a.NumService=s.NumService WHERE s.Nom="Chirurgie")) a WHERE a.NumPat IN (SELECT NumPat FROM Acte a JOIN Service s ON a.NumService=s.NumService WHERE s.Nom="Imagerie")) a WHERE a.NumPat IN (SELECT NumPat FROM Acte a JOIN Service s ON a.NumService=s.NumService WHERE s.Nom="cancerologie")) a WHERE a.NumPat IN (SELECT NumPat FROM Acte a JOIN Service s ON a.NumService=s.NumService WHERE s.Nom="dentaire")) a WHERE a.NumPat IN (SELECT NumPat FROM Acte a JOIN Service s ON a.NumService=s.NumService WHERE s.Nom="Griatrie")',
                          'SELECT m.Nom AS NomMedecin , m.Specialite AS SpecialiteMedecin, p.Nom AS NomPatient FROM Medecin m JOIN Acte a On m.NumMed=a.NumMed JOIN Patient p ON p.NumPat=a.NumPat WHERE a.NumPat IN (SELECT DISTINCT NumPat FROM (SELECT DISTINCT NumPat FROM (SELECT DISTINCT NumPat FROM (SELECT DISTINCT NumPat FROM (SELECT DISTINCT NumPat FROM (SELECT DISTINCT NumPat FROM Acte a WHERE a.NumPat IN (SELECT NumPat FROM Acte a JOIN Service s ON a.NumService=s.NumService WHERE s.Nom="Cardiologie")) a WHERE a.NumPat IN (SELECT NumPat FROM Acte a JOIN Service s ON a.NumService=s.NumService WHERE s.Nom="Chirurgie")) a WHERE a.NumPat IN (SELECT NumPat FROM Acte a JOIN Service s ON a.NumService=s.NumService WHERE s.Nom="Imagerie")) a WHERE a.NumPat IN (SELECT NumPat FROM Acte a JOIN Service s ON a.NumService=s.NumService WHERE s.Nom="cancerologie")) a WHERE a.NumPat IN (SELECT NumPat FROM Acte a JOIN Service s ON a.NumService=s.NumService WHERE s.Nom="dentaire")) a WHERE a.NumPat IN (SELECT NumPat FROM Acte a JOIN Service s ON a.NumService=s.NumService WHERE s.Nom="Griatrie"))',
                          'SELECT * FROM Patient p WHERE p.NumPat IN (SELECT B.NumPat FROM (SELECT h.NumPat FROM Hospitalisation h WHERE h.DateSortie-h.DateEntree>=14) AS B WHERE B.NumPat NOT IN (SELECT h.NumPat FROM Hospitalisation h WHERE h.DateSortie-h.DateEntree<=14))',
                          'SELECT NumPat FROM Acte WHERE NumPat NOT IN (SELECT NumPat FROM Hospitalisation)',
                          'SELECT NumService FROM Service WHERE NumService NOT IN(SELECT NumService FROM Hospitalisation)',
                          'SELECT s.Nom AS NomService, p.Nom AS NomPatient FROM Acte a JOIN Service s ON s.NumService=a.NumService JOIN Patient p ON p.NumPat = a.NumPat WHERE a.numPat IN (SELECT a.NumPat FROM Acte a GROUP BY NumPat HAVING COUNT(a.NumService)= "1")',
                          'SELECT Nom FROM Service WHERE numService IN (SELECT H.numService FROM (SELECT COUNT(NumService), NumService FROM Acte GROUP BY NumService) AS A JOIN (SELECT COUNT(Z.NumService) AS nombre, Z.NumService FROM (SELECT * FROM Hospitalisation WHERE DateSortie-DateEntree>1) as Z GROUP BY Z.NumService) AS H ON H.NumService=A.NumService WHERE `COUNT(NumService)`/2 < `H`.`nombre`)',
                          'SELECT p.Nom,p.Mutuelle FROM Patient p JOIN (SELECT h.NumPat FROM Hospitalisation h WHERE h.DateSortie-h.DateEntree >=3) as h ON h.NumPat=p.NumPat WHERE p.Mutuelle!="MUT"',
                          'SELECT AVG(NbDisctinctPatient) FROM (SELECT COUNT(R.NumMed) as NbDisctinctPatient,R.NumMed FROM (SELECT DISTINCT NumPat,NumMed FROM Acte) AS R GROUP BY R.NumMed) as L ',
                          'SELECT AVG(NbAct) FROM (SELECT COUNT(a.DateAct) AS NbAct FROM Acte a GROUP BY a.DateAct) as G ');
        $texte = array(
            '2. Quels sont les cancérologues qui sont chefs de service ?',
            '3. Quel est le nombre de lits dans chaque service ?',
            '4. Quel est le nombre de lits libres dans chaque salle du service de cardiologie au 04/07/2018 ?',
            '5. Quels sont les patients qui n’ont jamais été traités par un cardiologue',
            '6. Quels sont les patients qui ont subi au moins un acte dans tous les
services ?',
            '7. Quels sont les médecins, leur spécialité et le nom du patient, qui ont
traités un patient qui a subit un acte dans tous les services de l’hopital ? On triera le résultat par médecin',
            '8. . Quel sont les patients qui sont toujours restés plus de deux semaines
lors de leurs hospitalisations ?',
            '9. Quels sont les patients qui ont toujours été traités sans être hospitalisés ?',
            '10. Quels sont les services qui n’ont traités que des patients non hospitalisés ?',
            '11. Quels sont les patients et le service, des patients qui n’ont eu un acte
que dans un seul service ?',
            '12. Quelles sont les services dont la majorité des patients ont été hospitalisés au moins 2 jours ?',
            '13. Quels sont les patients hospitalisés plus de trois jours qui ne sont pas
à la mutelle MUT.',
            '14. Quel est le nombre moyen de patients (différents) par médecin (patient
ayant subit un acte par le médecin) ?',
            '15. Quelle est la moyenne des actes par jour pour l’ensemble des medecins.');

?>

<form action="GET">

</form>
    <?php
          echo '<div class="p-3">';
            echo '<h2><u>Requête n°1:</u></h2>';
            echo '<p><h4>1. Quels sont les patients entrés à une date que l’on saisit ?</h4></p>';
            echo ('<div class="input-group mb-3">
                    <form method="post">
                    <input type="text" name = "date" class="form-control" placeholder="Date :année-mois-jour" aria-label="Date :année-mois-jour" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <input type="submit" class="btn btn-info" name = "date-btn" value="Executer cette requête.">
                      </div>
                      </form>
                    </div>');
          echo '</div>';




        for ($i = 0; $i <= count($requetes)-1;$i++){
          echo '<div class="p-3">';
            echo '<h2><u>Requête n°'.($i+2).':</u></h2>';
            echo '<p><h4>'.$texte[$i].'</h4></p>';
            echo '<a class="btn btn-info" href="requetes.php?request='.($i+2).'#tableau">Executer cette requête.</a>';
          echo '</div>';

        };

        if(isset($_GET['request'])){
            $req = mysqli_query($base,$requetes[$_GET['request']-2])
                  or die("Message d'erreur : ".mysqli_error($base)."  ");
        

if (array_key_exists('date-btn',$_POST)){
          $val=$_POST['date'];
          $requ= 'SELECT *
          From Patient p join Hospitalisation h on p.NumPat = h.NumPat
          WHERE h.DateEntree = "'.$val.'";
          ';
          echo $requ;
          $reque = mysqli_query($base,$requ)
                  or die("Message d'erreur : ".mysqli_error($base)."  ");

          echo '<div style=" margin: auto; ">';
          echo '<h4>Réponse à la question 1</h4>';
          echo('<table class="table table-hover" style="position: sticky;">
              <thead>
              <tr>');
                  $row = $reque->fetch_assoc();
                  foreach (array_keys($row) as $attribut){echo '<th id="tableau">'.$attribut.'</th>';}
              echo('</tr>
              </thead>
              <tbody>');

              echo '<tr>';
              foreach (array_keys($row) as $attribut){echo '<th>'.$row[$attribut].'</th>';}
              echo '</tr>';
              while ($row = $reque->fetch_assoc()):
                  echo '<tr>';
                  foreach (array_keys($row) as $attribut){echo '<th>'.$row[$attribut].'</th>';}
                  echo '</tr>';
              endwhile;
              echo('
              </tbody>
          </table>');
          echo '</div>';


        }
            ?>


    <div style=" margin: auto; ">

      <?php  echo '<h4>Réponse à la question '.$_GET['request'].'</h4>'; ?>
      <form action="" method="GET">
          <table class="table table-hover" style="position: sticky;">
              <thead>
              <tr>
                  <?php
                  $row = $req->fetch_assoc();
                  foreach (array_keys($row) as $attribut){echo '<th id="tableau">'.$attribut.'</th>';} ?>
              </tr>
              </thead>
              <tbody>
              <?php
              echo '<tr>';
              foreach (array_keys($row) as $attribut){echo '<th>'.$row[$attribut].'</th>';}
              echo '</tr>';
              while ($row = $req->fetch_assoc()):
                  echo '<tr>';
                  foreach (array_keys($row) as $attribut){echo '<th>'.$row[$attribut].'</th>';}
                  echo '</tr>';
              endwhile; ?>

              </tbody>
          </table>
      </form>
    </div>


        <?php  }$base->close(); ?>
    </div><!--/row-->


  </body>
