


<body>
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
                            $id=0;
                            $req = mysqli_query($base,"SELECT * FROM ".$nom);
                            $attributs=array();
                            $row = mysqli_fetch_assoc($req);
                            foreach (array_keys($row) as $attribut){
                                echo '<th scope="col">'.$attribut.'</th>';
                                array_push($attributs,$attribut);
                            }
                            ?>
                            <th scope="col">Opération</th>
                        </tr><form method="post">
                        <tr>
                        
                            <?php
                            $i=0;
                            foreach (array_keys($row) as $attribut){
                                $var="champ".$i;
                                echo '<th scope="row"><input type="text" name='.$var.' /></th>';
                                $i++;
                            }
                            ?>
                            <th scope="row"><input type="submit" name="enregistrer" class="btn btn-primary" value="Enregistrer une nouvelle ligne"/></th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        ${'valeurs'.$id}=array();
                        echo '<tr id="id'.$id.'">';
                        $i=0;
                        foreach (array_keys($row) as $attribut){
                            $var='id'.$id.'champ'.$i;
                            
                            echo '<td scope="col"><input type="text" name='.$var.' placeholder="'.$row[$attribut].'" style="border: none";/></td>';
                            array_push(${'valeurs'.$id},$row[$attribut]);
                            $i++;
                        }
                        
                        
                        echo ('
                            <td><input type="submit" name="modifier'.$id.'" class="btn btn-primary" value="modifier"/> <input type="submit" class="btn btn-primary" name = "supprimer'.$id.'" value="supprimer"/></td>
                        </tr>');
                        $id++;
                        while ($row = mysqli_fetch_assoc($req)):
                            ${'valeurs'.$id}=array();
                            echo '<tr id="id'.$id.'">';
                            $i=0;
                            foreach (array_keys($row) as $attribut){
                                $var='id'.$id.'champ'.$i;
                                echo '<td scope="col"><input type="text" name='.$var.' placeholder="'.$row[$attribut].'" style="border: none";/></td>';
                                array_push(${'valeurs'.$id},$row[$attribut]);
                                $i++;
                            }
                            echo ('
                                <td><input type="submit" name="modifier'.$id.'" class="btn btn-primary" value="modifier"/> <input type="submit" class="btn btn-primary" name = "supprimer'.$id.'" value="supprimer"/></td>
                            </tr>');
                            $id++;
                        endwhile;

                        mysqli_free_result($req);
                        ?>
                        </form>
                    </tbody>

                </table>

            </div>
        </div>
    </body>
</html>


<?php
    if(array_key_exists('enregistrer', $_POST)){
        $data="";
        for ($j=0;$j<($i-1);$j++){
            $val=$_POST['champ'.$j];
            $data= $data."'$val',";
        }
        $j=$i-1;
        $val=$_POST['champ'.$j];
        $data=$data."'$val'";
        $sql = "INSERT INTO $nom values($data);";        
        if ($req = mysqli_query($base,$sql)){
            echo ('<script type="text/javascript">
                window.alert("La ligne a été ajoutée avec succès ! \n Veuillez raffraichir la page !");
 
            </script>');
            
        }else{
            echo ('<script type="text/javascript">window.alert("|'.$sql.'|  '.'Message d\'erreur : '.mysqli_error($base).'");</script>');
        }
    }

    for ($listid=0;$listid<$id;$listid++){

        if(array_key_exists('modifier'.$listid, $_POST)){
            $text="";
            $data="";
            for ($j=0;$j<($i);$j++){
                $text = $text.$attributs[$j]." = "."'".${'valeurs'.$listid}[$j]."'"." AND ";
                $val=$_POST['id'.$listid.'champ'.$j];
                if ($val != ''){
                    $data= $data.$attributs[$j]." = "."'$val',";
                }
            }
            $text = substr($text, 0, -4);
            $data = substr($data, 0, -1);
            $sql = "UPDATE $nom set $data where ($text);";
            //echo $sql;
            if ($req = mysqli_query($base,$sql)){
                echo ('<script type="text/javascript">
                window.alert("La ligne a été mise à jour avec succès ! \n Veuillez raffraichir la page !");
 
            </script>');
            }else{
                echo ('<script type="text/javascript">window.alert("|'.$sql.'|  '.'Message d\'erreur : '.mysqli_error($base).'");</script>');
            }

        }
        if(array_key_exists('supprimer'.$listid, $_POST)){
            $text="";
            foreach ($attributs as $key => $value){
                $text = $text.$value." = "."'".${'valeurs'.$listid}[$key]."'"." AND ";

            }
            $text = substr($text, 0, -4);
            
            $sql = "DELETE FROM $nom WHERE (".$text.")";
            //echo ($sql);
            
            if ($req = mysqli_query($base,$sql)){
                echo ('<script type="text/javascript">
                window.alert("La ligne a été supprimée avec succès ! \n Veuillez raffraichir la page !");
 
            </script>');
            }else{
                echo ('<script type="text/javascript">window.alert("|'.$sql.'|  '.'Message d\'erreur : '.mysqli_error($base).'");</script>');
            }

        }

    }


?>
