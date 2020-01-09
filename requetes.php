

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


<div class="container">

    <div class="row row-offcanvas row-offcanvas-right">

        <?php
          ini_set('auto_detect_line_endings',TRUE);
            header('Content-Type: text/html; charset=UTF-8');
  // Définition des fonctions
          $base = mysqli_connect ('localhost', 'root', 'root')
            or mysqli_connect ('localhost', 'root', 'root')
              or die("Impossible de se connecter : " . mysqli_error());

          mysqli_select_db($base,'bddplnvk') ;

        $requetes = array("0", 'SELECT m.nom FROM Medecin m JOIN Service s ON m.NumMed = s.NumMed WHERE s.Nom="cancerologie"','SELECT SUM(Nblits),sa.NumServ FROM Salle sa GROUP BY  sa.NumServ', "0",'SELECT * FROM Patient p JOIN (SELECT * FROM Hospitalisation h JOIN (SELECT * FROM Service se WHERE NOT se.Nom = "Cardiologie") AS S ON h.NumServ=S.NumService) AS Ho ON p.NumPat=Ho.NumPat',);
        $texte = array( '1. Quels sont les patients entrés à une date que l’on saisit ?',
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

        for ($i = 1; $i <= count($requetes);$i++){
            echo '<h2><u>Requête n°'.$i.':</u></h2>';
            echo '<p><h4>'.$texte[$i-1].'</h4></p>';
            echo '<a class="btn btn-info" href="requetes.php?request='.$i.'#tableau">Executer cette requête.</a>';
        };
        if(isset($_GET['request'])){
            $req = mysqli_query($base,$requetes[$_GET['request']-1])
                  or die("Message d'erreur : ".mysqli_error($base)."  ");

            ?>


            <form action="" method="GET">
                <table class="table table-hover">
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

        <?php  }$conn->close(); ?>
    </div><!--/row-->


  </body>
