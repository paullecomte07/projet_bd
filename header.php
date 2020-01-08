

<?php
    $tables = array("Infirmier" => array("NumInf","Nom","Adresse","Telephone"));

    $servername = "localhost";
  $username = "root";
  $password = "root";
  // Create connection
  $conn = new mysqli($servername, $username, $password);
  // Check connection
  if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
  }

?>
