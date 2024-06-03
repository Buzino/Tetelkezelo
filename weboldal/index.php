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

function futtatLekerdezes($connection, $sql) {
    return $connection->query($sql);
}

?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tételkezelő</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="tartalom">
        <header>
            <h1>Tételkezelő</h1>
            
        </header>
        <main>
            <nav>
                <h2>Menü</h2>
                <a href="">Új tétel</a>
                <a href="">Kézikönyv</a>
            </nav>
            <form action="" method="post" class="keres">
              <fieldset>
                <legend>Keresés</legend>
                <label for="szoveg">Keresés szövege:</label> <input type="text" name="szoveg" id="szoveg" value="<?=($_POST["szoveg"] ?? '')?>">
                <br>
                <label for="targy">Szűrés tantárgyra:</label>
                <select name="targy" id="targy">
                    <option value="" <?php if (($_POST["targy"] ?? "") == "") echo "selected";?>>Nincs megadva</option>
                    <?php 
                        $result = $conn->query("SELECT id, nev FROM targyak ORDER BY nev ASC")->fetch_all(MYSQLI_ASSOC);
                        foreach ($result as $targy):
                    ?>
                    <option value="<?=$targy["id"]?>" <?php if (($_POST["targy"] ?? false) == $targy["id"]) echo "selected"?>><?=$targy["nev"]?></option>
                    <?php endforeach;?>
                </select>
                <br>
                <button type="submit" name="keres" value="1">Keres</button>
                <br>
                <button type="submit" name="torolszuro" value="1">Szűrők törlése</button>
              </fieldset>
            </form>
            <div class="talalatok">
                <h2><?=isset($_POST["keres"]) ? "Talált tételek" : "Tételek"?></h2>
                <!--Találatok legenerálása-->
                <div class="tetel">
                    <h3>Tétel címe</h3>
                    <p>Tantárgy: <br>Feltöltve: </p>
                    <p>3 sor a vázlatból</p>
                    <p>3 sor a kidolgozásból</p>
                    <p><a href="">Tovább a tételre</a></p>
                </div>
            </div>
        </main>
    </div>
</body>
</html>