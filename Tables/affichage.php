        
<body>
    <form method="post">
        <div class="row">
            <div class="col-md-1 d-flex align-items-center text-center">
                <a href="../index.php" class="btn btn-primary" role="button" aria-disabled="true">Retour</a>
            </div>
            <div class="col-md-10 text-center">
                <h1>Table <?php echo $nom; ?></h1>
            </div>
        </div>        
        <div class="row">
            <div class="col">
                <table class="table table-bordered table-hover">

                    <thead class="thead-dark">
                        <tr>
                            <?php
                            $row = mysqli_fetch_assoc($req);
                            foreach (array_keys($row) as $attribut){echo '<th scope="col">'.$attribut.'</th>';}
                            ?>
                            <th scope="col">Opération</th>
                        </tr>
                        <tr>
                            <?php
                            
                            foreach (array_keys($row) as $attribut){echo '<th scope="row"><input type="text" name="nom" /></th>';}
                            ?>
                            <th scope="row"><button type="button" class="btn btn-primary">Enregistrer une nouvelle ligne</button></th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        <?php
                        echo '<tr>';
                        foreach (array_keys($row) as $attribut){echo '<td scope="col">'.$row[$attribut].'</td>';}
                        echo ('
                            <td><button type="button" class="btn btn-primary">Modifier</button> <button type="button" class="btn btn-primary">Supprimer</button></td>
                        </tr>');
                        while ($row = mysqli_fetch_assoc($req)):
                            echo '<tr>';
                            foreach (array_keys($row) as $attribut){echo '<td scope="col">'.$row[$attribut].'</td>';}
                            echo ('
                                <td><button type="button" class="btn btn-primary">Modifier</button> <button type="button" class="btn btn-primary">Supprimer</button></td>
                            </tr>');
                        endwhile;
                        ?>

                    </tbody>

                </table>

            </div>
        </div>


    </form>
    </body>
</html>

<?php
mysqli_free_result($req);
?>