<?php 
    include("php/db_connect.php");
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
        <div class="szin">
            <span class="grad"></span>
            <input type="range" name="h" id="h" min=0 max=359 step=1 value=230 onchange="szin()">
        </div>
        <header>
            <h1>Tételkezelő</h1>
        </header>
        <!--Menü-->
        <nav>
            <ul>
                <li><h2><a href="index.php">Menü</a></h2></li>
                <li><a href="manual.php">Kézikönyv</a></li>
            </ul>
        </nav>
        <main>
            <!--A tétel-->
            <?php
            if (!isset($_POST["tetelid"])):
                echo '<p>Hiba történt. <button type="button" onclick="window.open("index.php","_self")">Vissza</button></p>';
            else:
                //az oldal többi része csak abban az esetben jelenik meg,
                //ha az oldal helyesen nyílt meg.
                $t = $conn->query("SELECT tetelek.id AS tetelid, targyak.nev AS targy, modositva, sorszam, cim, vazlat, kidolgozas FROM tetelek INNER JOIN targyak ON tetelek.tantargyid = targyak.id WHERE tetelek.id = ".$_POST["tetelid"])->fetch_assoc();
            ?>
            
            <h1><?=$t["sorszam"]?>. <?=$t["cim"]?></h1>
            <p>Tantárgy: <b><?=$t["targy"]?></b></p>
            <p>Utoljára módosítva: <b><?=$t["modositva"]?></b></p>
            
            <h2>Műveletek</h2>
            <div class="gombok">
                <button type="button" onclick="vissza()" >Vissza a főoldalra</button>
                <button type="button" onclick="modosit()">Tétel módosítása</button>
            </div>
            
            <h2>Vázlat</h2>
            <p><?=str_replace("\r\n","<br>",$t["vazlat"])?></p>
            
            <h2>Kidolgozás</h2>
            <p><?=str_replace("\r\n","<br>",$t["kidolgozas"])?></p>
                
            <form action="modify.php" method="post" id="modosit">
                <input type="hidden" name="tetelid" value="<?=$t["tetelid"]?>">
                <input type="hidden" name="modosit" value="1">
            </form>
            <script defer>
                function vissza() {window.open("index.php","_self");}
                function modosit() {document.querySelector('#modosit').submit();}
            </script>

            <?php endif;?>
        </main>
    </div>

    <script defer src="app.js"></script>
</body>
</html>