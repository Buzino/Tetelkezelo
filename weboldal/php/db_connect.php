<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "tetelkezelo";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Creating database
futtatParancs($conn, file_get_contents("create.sql"));

// Update connection
$conn = mysqli_connect($servername, $username, $password, $database);

function futtatParancs($connection, $sql) {
    $sql = explode(";",$sql);
    foreach ($sql as $command) {
        if (strlen($command) > 0 && !$connection->query($command)) {
            //echo "womp womp: ".$command."\n";
            echo "<script>console.log(\"womp womp: ".$command."\n\");</script>";
        }
    }
    //echo "Kész a eskuel.";
}

//szinhez
session_start();
$_SESSION["h"] = $_POST["hue"] ?? 230;