<?php
$serverName = "localhost";
$dbUserName = "root";
$dbPassword = "";
$dbName = "phpproject01";

$conn = mysqli_connect($serverName, $dbUserName,$dbPassword,$dbName);

if (!$conn) {
    die("connection failed" . mysqli_connect_error());
}

// <?php
// $servernaam = "localhost";
// $gebruikersnaam = "username";
// $wachtwoord = "password";