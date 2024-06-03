<?php 
    include("php/db_connect.php");

    //ha módosítás céljával kerültünk ide, akkor a kiválasztott tétel adatait lekérjük,
    //hogy a lejjebbi inputokba belekerülhessenek
    if (isset($_POST["modosit"]) && isset($_POST["tetelid"])) {
        $tetel = $conn->query("SELECT tetelek.id AS tetelid, targyak.nev AS targy, sorszam, cim, vazlat, kidolgozas FROM tetelek INNER JOIN targyak ON tetelek.tantargyid = targyak.id WHERE tetelek.id = ".$_POST["tetelid"])->fetch_assoc();
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

    <script defer>
        function elvetes() {
            //Figyelmeztető a módosítások elvetéséről.
            if (confirm("Biztosan kilép?\nA módosítások elvetésre kerülnek.")) {
                window.open("index.php", "_self");
            }
        }
        function torles() {
            //Figyelmeztető a törlésről
            if (confirm("Biztosan törölni szeretné? A művelet nem visszavonható!")) {
                document.querySelector("#torol").submit();
            }
        }
    </script>

    <div class="tartalom">
        <header>
            <h1>Tételkezelő</h1>
        </header>
        <main>
            <!--Menü-->
            <nav>
                <h2><a href="index.php">Menü</a></h2>
                <a href="manual.html">Kézikönyv</a>
            </nav>
            <!--Módosítás form-->
            <form action="<?=$_SERVER["PHP_SELF"]?>" method="post" class="keres modosit">
              <fieldset>
                <legend>Tétel hozzáadása / módosítása</legend>
                <label for="tantargy">Tantárgy:</label>
                <input type="text" name="tantargy" id="tantargy" list="targy" value="<?=$tetel["targy"] ?? $_POST["tantargy"] ?? ""?>" required>
                <datalist name="targy" id="targy">
                    <?php 
                        //tantárgyak lekérése az adatbázisból
                        $result = $conn->query("SELECT nev FROM targyak ORDER BY nev ASC")->fetch_all(MYSQLI_ASSOC);
                        foreach ($result as $targy):
                        ?>
                        <option><?=$targy["nev"]?></option>
                        <?php endforeach;
                    ?>
                </datalist>
                <br>
                <label for="sorszam">Tétel sorszáma:</label> <input type="number" min=1 name="sorszam" id="sorszam" value="<?=$tetel["sorszam"] ?? $_POST["sorszam"] ?? ""?>" required>
                <br>
                <label for="cim">Tétel címe:</label> <input type="text" name="cim" id="cim" value="<?=$tetel["cim"] ?? $_POST["cim"] ?? ""?>" required>
                <br>
                <label for="vazlat">Vázlat:</label> <textarea name="vazlat" id="vazlat" rows="5" required><?=$tetel["vazlat"] ?? $_POST["vazlat"] ?? ""?></textarea>
                <br>
                <label for="kidolgozas">Kidolgozás:</label> <textarea name="kidolgozas" id="kidolgozas" rows="5" required><?=$tetel["kidolgozas"] ?? $_POST["kidolgozas"] ?? ""?></textarea>
                
                <div class="modositgombok">
                    <button type="submit" name="ment" value="1" onclick="mentes()">Mentés</button>
                    <button type="button" name="megsem" value="1" onclick="elvetes()">Mégsem</button>
                    <button type="button" name="torol" value="1" onclick="torles()" class="torol" id="torolgomb">Törlés</button>
                </div>
              </fieldset>
            <?php 
            //a jelenlegi tétel azonosítójának tárolása
            //ha új tételt adunk hozzá, akkor a legmagasabb azonosító+1-es azonosítót kapja
            if (!isset($_POST["tetelid"])) {
                $tetelid = intval($conn->query("SELECT MAX(id) AS maxid FROM tetelek;")->fetch_assoc()["maxid"]) + 1;
                echo '<script>document.querySelector("#torolgomb").disabled=true;</script>';
            } else {
                $tetelid = $tetel["tetelid"] ?? $_POST["tetelid"];
                echo '<script>document.querySelector("#torolgomb").disabled=false;</script>';
            }
            ?>
            <input type="hidden" name="tetelid" value="<?=$tetelid?>">
            </form>
        </main>
    </div>

    <form action="modify.php" method="post" id="torol">
        <input type="hidden" name="tetelid" value="<?=$tetelid?>">
        <input type="hidden" name="torol" value="1">
    </form>

    <?php
    if (isset($_POST["ment"])) {
        try {
            //lekérjük a megadott nevű tantárgyak számát...
            switch( intval($conn->query("SELECT COUNT(*) AS db FROM targyak WHERE nev = '".$_POST["tantargy"]."'")->fetch_assoc()["db"]) ) {
                case 0:
                    //...ha nincs ilyen, akkor (úgyszint a legnagyobb+1-es azonosítóval) hozzáadjuk.
                    $targyid = intval( $conn->query("SELECT MAX(id) AS maxid FROM targyak")->fetch_assoc()["maxid"] ) + 1;
                    $conn->query("INSERT INTO targyak VALUES ($targyid, '".$_POST["tantargy"]."')");
                    break;
                default:
                    //...ha van, akkor az első előforduló azonosítóját használjuk.
                    $targyid = intval( $conn->query("SELECT id FROM targyak WHERE nev = '".$_POST["tantargy"]."'")->fetch_assoc()["id"] );
                    break;
            }
            //a tétel hozzáadása/frissítése (a REPLACE INTO mindkettőre képes (^v^) )
            $conn->query("REPLACE INTO tetelek (id, tantargyid, sorszam, cim, vazlat, kidolgozas, modositva) VALUES (".$_POST["tetelid"].", ".$targyid.", ".$_POST["sorszam"].", '".htmlentities($_POST["cim"])."', '".htmlentities($_POST["vazlat"])."', '".htmlentities($_POST["kidolgozas"])."', '".date("Y-m-d")."')");
            echo '<script>alert("A változtatások mentésre kerültek."); window.open("index.php", "_self")</script>';
        } catch (Exception $ä) {
            //hiba esetén jelezzük a hibát, és nem léptetjük vissza a felhasználót a főoldalra
            echo '<script>alert("Hiba történt a feltöltés során. A változások nem kerültek mentésre.\nHiba: '.$ä->getMessage().'")</script>';
        }
    }

    if (isset($_POST["torol"]) && isset($_POST["tetelid"])) {
        if ($conn->query("SELECT COUNT(*) AS db FROM tetelek WHERE id = ".$_POST["tetelid"])->fetch_assoc()["db"] > 0) {
            $conn->query("DELETE FROM tetelek WHERE id = ".$_POST["tetelid"]);
        }
        echo '<script>alert("Tétel sikeresen törölve!"); window.open("index.php","_self")</script>';
    }
    ?>
</body>
</html>