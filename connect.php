<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flux_colis";

global $conn;

try {

  # MySQL with PDO_MYSQL
  $DBH = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);

}
catch(PDOException $e) {
    echo 'Connexion échouée : ' . $e->getMessage();
}


?>