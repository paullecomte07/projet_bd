<?php
  ini_set('auto_detect_line_endings',TRUE);
  header('Content-Type: text/html; charset=UTF-8');
  // Définition des fonctions
  $base = mysqli_connect ('localhost', 'root', 'root')
    or mysqli_connect ('localhost', 'root', 'root')
      or die("Impossible de se connecter : " . mysqli_error());

  /*$sql= "DROP DATABASE IF EXISTS bddplnvk"; //mauvaise idée !!! une page web se raffraichit h24
  $req = mysqli_query($base,$sql);*/

  $sql="CREATE DATABASE bddplnvk CHARACTER SET 'utf8';";
  $req = mysqli_query($base,$sql);
  mysqli_select_db ($base,'bddplnvk') ;

  /*mysqli_select_db ($base,'voitures') ;
  $sql = "SELECT voitures.* FROM voitures where Nom=\"".$voiture."\"";
  $req = mysqli_query($base,$sql)
    or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($base));*/

  function creerTables ()
{
  global $base;

  $instructionSQL1="CREATE TABLE Service(
    NumService INT(1) NOT NULL,
    Nom VARCHAR(50) NOT NULL,
    Batiment VARCHAR(1) NOT NULL,
    NumMed INT(2) NOT NULL,
    PRIMARY KEY (NumService)
  );";

  $instructionSQL2='CREATE TABLE Salle(
    NumSalle INT(5) NOT NULL,
    NumServ INT(5) NOT NULL,
    Nblits Int(5) NOT NULL,
    NumInf INT(5) NOT NULL,
    PRIMARY KEY (numSalle,numServ)
  );';
  $instructionSQL3='CREATE TABLE Infirmier (
    NumInf INT(5) NOT NULL,
    Nom VARCHAR(50) NOT NULL,
    Adresse VARCHAR(50) NOT NULL,
    Telphone INT(10) NOT NULL,
    PRIMARY KEY (NumInf)
  );';
  $instructionSQL4='CREATE TABLE Patient(
    NumPat INT(5) NOT NULL,
    Nom VARCHAR(50) NOT NULL,
    Prenom VARCHAR(50) NOT NULL,
    Mutuelle VARCHAR(50) NOT NULL,
    PRIMARY KEY (NumPat)
  );';
  $instructionSQL5='CREATE TABLE Medecin(
    NumMed INT(5) NOT NULL,
    nom VARCHAR(50) NOT NULL,
    Specialite VARCHAR(50) NOT NULL,
    PRIMARY KEY (NumMed)
  );';
  $instructionSQL6='CREATE TABLE Hospitalisation(
    NumPat INT(5) NOT NULL,
    DateEntree VARCHAR(10) NOT NULL,
    NumSalle INT(5) NOT NULL,
    NumService INT(5) NOT NULL,
    DateSortie VARCHAR(10) NOT NULL,
    PRIMARY KEY (NumPat, DateEntree, NumSalle)
  );';
  $instructionSQL7='CREATE TABLE Acte(
    NumMed INT(5) NOT NULL,
    NumPat INT(5) NOT NULL,
    DateAct VARCHAR(10) NOT NULL,
    NumService INT(5) NOT NULL,
    Description VARCHAR(50) NOT NULL,
    PRIMARY KEY (NumMed, NumPat, DateAct)
  );';

  for ($i = 1; $i <= 7; $i++) {

    //echo "Information d'hôte : " . mysqli_get_host_info($base) . PHP_EOL;

    $sql= ${'instructionSQL'.$i};
    //echo($sql);
    $req = mysqli_query($base,$sql)
      //or die("Impossible de créer la table : ".$i);
      or die("Message d'erreur : ".mysqli_error($base)."  ");

  }
  return TRUE;
}

function majTables()
{
  global $base;

  foreach(array("Service","salle","infirmier","patient") as $filename)
  {
    $file = fopen("Enregistrements/".$filename.".csv", "r");
    $titres=$emapData = fgetcsv($file, 10000, ";");
    while (($emapData = fgetcsv($file, 10000, ";")) !== FALSE)
    {
      $sql = "INSERT INTO $filename values('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]');";
      $sql = utf8_encode($sql);
      $req = mysqli_query($base,$sql)
        or die("|".$sql."|  "."Message d'erreur : ".mysqli_error($base)."  ");

      //echo($sql."<br/>");

    }
    fclose($file);
  }

  foreach(array("Acte","Hospitalisation") as $filename)
  {
    $file = fopen("Enregistrements/".$filename.".csv", "r");
    $titres=$emapData = fgetcsv($file, 10000, ";");
    while (($emapData = fgetcsv($file, 10000, ";")) !== FALSE)
    {
      $sql = "INSERT INTO $filename values('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]');";
      $sql = utf8_encode($sql);
      $req = mysqli_query($base,$sql)
        or die("|".$sql."|  "."Message d'erreur : ".mysqli_error($base)."  ");

      //echo($sql."<br/>");

    }
    fclose($file);
  }
  $filename ="Medecin";
  $file = fopen("Enregistrements/".$filename.".csv", "r");
  $titres=$emapData = fgetcsv($file, 10000, ";");
  while (($emapData = fgetcsv($file, 10000, ";")) !== FALSE)
  {
    $sql = "INSERT INTO $filename values('$emapData[0]','$emapData[1]','$emapData[2]');";
    $sql = utf8_encode($sql);
    $req = mysqli_query($base,$sql)
      or die("|".$sql."|  "."Message d'erreur : ".mysqli_error($base)."  ");

    //echo($sql."<br/>");

  }
  fclose($file);

}

function supprimerBDD ()
{
  global $base;

  $sql= "DROP DATABASE IF EXISTS bddplnvk";
  $req = mysqli_query($base,$sql);
  return TRUE;
}


?>
