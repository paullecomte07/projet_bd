<?php
  // Définition des fonctions
  $base = mysqli_connect ('localhost', 'root', '')
    or die("Impossible de se connecter : " . mysqli_error());
  
  $sql= "DROP DATABASE IF EXISTS bddplnvk";
  $req = mysqli_query($base,$sql);

  $sql="CREATE DATABASE bddplnvk CHARACTER SET 'utf8';";
  $req = mysqli_query($base,$sql);
  mysqli_select_db ($base,'bddplnvk') ;


  /*mysqli_select_db ($base,'voitures') ;
  $sql = "SELECT voitures.* FROM voitures where Nom=\"".$voiture."\"";
  $req = mysqli_query($base,$sql)
    or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($base));*/

  function creerTables () 
{
  $instructionSQL1="CREATE TABLE Service(
    NumService INT(1) NOT NULL,
    Nom VARCHAR(50) NOT NULL,
    Batiment VARCHAR(1) NOT NULL,
    NumMed INT(2) NOT NULL,
    PRIMARY KEY (NumService)
  );";

  $instructionSQL2='CREATE TABLE Salle(
    NumSalle INT(5) NOT NULL,
    NumService INT(5) NOT NULL,
    Nblits Int(5) NOT NULL,
    NumInf INT(5) NOT NULL,
    PRIMARY KEY (numSalle)
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
    global $base;
    //echo "Information d'hôte : " . mysqli_get_host_info($base) . PHP_EOL;

    $sql= ${'instructionSQL'.$i};
    //echo($sql);
    $req = mysqli_query($base,$sql)
      or die("Impossible de créer la table : ".$i);
    
  }
  return TRUE;
}

function ajouterElement () 
{
  global $base;
}

function supprimerBDD () 
{
  global $base;
  $sql= "DROP DATABASE IF EXISTS bddplnvk";
  $req = mysqli_query($base,$sql);
  return TRUE;
}


?>
