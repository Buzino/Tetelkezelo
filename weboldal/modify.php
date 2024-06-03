<?php 
    include("php/db_connect.php");

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
    <div class="tartalom">
        <header>
            <h1>Tételkezelő</h1>
        </header>
        <main>
            <nav>
                <h2>Menü</h2>
                <a href="">Kézikönyv</a>
            </nav>
            <form action="" method="post" class="keres modosit">
              <fieldset>
                <legend>Tétel hozzáadása / módosítása</legend>
                <label for="tantargy">Tantárgy:</label>
                <input type="text" name="tantargy" id="tantargy" list="targy" value="<?=$tetel["targy"] ?? $_POST["tantargy"] ?? ""?>" required>
                <datalist name="targy" id="targy">
                    <?php 
                        $result = $conn->query("SELECT nev FROM targyak ORDER BY nev ASC")->fetch_all(MYSQLI_ASSOC);
                        foreach ($result as $targy):
                    ?>
                    <option><?=$targy["nev"]?></option>
                    <?php endforeach;?>
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
                </div>
              </fieldset>
            <?php 
            if (!isset($_POST["tetelid"])) {
                $tetelid = intval($conn->query("SELECT MAX(id) AS maxid FROM tetelek;")->fetch_assoc()["maxid"]) + 1;
            } else {
                $tetelid = $tetel["tetelid"] ?? $_POST["tetelid"];
            }
            ?>
            <input type="hidden" name="tetelid" value="<?=$tetelid?>">
            </form>
        </main>
    </div>
    <script defer>
        function elvetes() {
            if (confirm("Biztosan kilép?\nA módosítások elvetésre kerülnek.")) {
                window.open("index.php", "_self");
            }
        }
    </script>
    <?php
    if (isset($_POST["ment"])) {
        switch( intval($conn->query("SELECT COUNT(*) AS db FROM targyak WHERE nev = '".$_POST["tantargy"]."'")->fetch_assoc()["db"]) ) {
            case 0:
                $targyid = intval( $conn->query("SELECT MAX(id) AS maxid FROM targyak")->fetch_assoc()["maxid"] ) + 1;
                $conn->query("INSERT INTO targyak VALUES ($targyid, '".$_POST["tantargy"]."')");
                break;
            default:
                $targyid = intval( $conn->query("SELECT id FROM targyak WHERE nev = '".$_POST["tantargy"]."'")->fetch_assoc()["id"] );
                break;
        }
        $conn->query("REPLACE INTO tetelek (id, tantargyid, sorszam, cim, vazlat, kidolgozas) VALUES (".$_POST["tetelid"].", ".$targyid.", ".$_POST["sorszam"].", '".$_POST["cim"]."', '".$_POST["vazlat"]."', '".$_POST["kidolgozas"]."')");
    }
    ?>
</body>
</html>