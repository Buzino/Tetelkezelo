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
        <header>
            <h1>Tételkezelő</h1>
        </header>
        <main>
            <!--Menü-->
            <nav>
                <h2><a href="index.php">Menü</a></h2>
                <a href="modify.php">Új tétel</a>
                <a href="">Kézikönyv</a>
            </nav>
            <!--Keresés form-->
            <form action="<?=$_SERVER["PHP_SELF"]?>" method="post" class="keres">
              <fieldset>
                <legend>Keresés</legend>
                <label for="szoveg">Keresés szövege:</label> <input type="text" name="szoveg" id="szoveg" value="<?php if (isset($_POST["szurotorol"])) echo ""; else echo ($_POST["szoveg"] ?? '');?>">
                <br>
                <label for="targy">Szűrés tantárgyra:</label>
                <select name="targy" id="targy">
                    <!--tantárgyak lekérése az adatbázisból-->
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
                <button type="submit" class="torol" name="szurotorol" value="1">Szűrők törlése</button>
              </fieldset>
            </form>
            <!--A találatok kilistázása-->
            <div class="talalatok">
                <h2><?=isset($_POST["keres"]) ? "Talált tételek" : "Tételek"?></h2>
                
                <?php
                $lekeres = "SELECT tetelek.id AS tetelid, targyak.nev AS targy, sorszam, modositva, cim, vazlat, kidolgozas FROM tetelek INNER JOIN targyak ON tetelek.tantargyid = targyak.id ";
                if (isset($_POST["keres"])) {
                    $lekeres .= "WHERE ";
                    
                    if ($_POST["szoveg"] != "") {
                        if (is_numeric($_POST['szoveg'])) {
                            //ha a keresőmezőben szám van, akkor sorszám alapján keresünk...
                            $lekeres .= ' sorszam = '.$_POST["szoveg"].' ';
                        } else {
                            //...egyébként a tétel címében
                            $lekeres .= ' cim LIKE "%'.$_POST["szoveg"].'%" ';
                        }
                        $kellés = true; //logikai érték, hogy kell-e 'AND' a következő feltételhez
                    }

                    if ($_POST["targy"] != "") {
                        if ($kellés ?? false) $lekeres .= ' AND ';
                        $lekeres .= ' tantargyid = '.$_POST["targy"];
                        $kellés = true; //logikai érték, hogy kell-e 'AND' a következő feltételhez
                    }

                    if ($kellés ?? false) $lekeres .= ' AND ';
                    $lekeres .= "1";    //1-es hozzáadása, ha feltétel nélkül szűrnénk
                }

                //echo $lekeres;

                $result = $conn -> query($lekeres);
                while (($r = $result->fetch_assoc()) != null):
                ?>
                <form action="view.php" method="post" class="tetel">
                    <h3><?=$r["sorszam"]?>. <?=$r["cim"]?></h3>
                    <p>
                        Tantárgy: <b><?=$r["targy"]?></b>
                        <br>
                        Legutoljára módosítva: <b><?=$r["modositva"]?></b>
                    </p>
                    <p class="maxnsor" style="--maxnsor:5"><?=str_replace("\r\n","<br>", $r["vazlat"])?></p>    <!--a sortörések megjelenítése érdekes...-->
                    <p class="maxnsor" style="--maxnsor:5"><?=str_replace("\r\n","<br>", $r["kidolgozas"])?></p>
                    <p><button type="submit" name="tetelid" value="<?=$r["tetelid"]?>">Tovább a tételre</button></p>
                </form>
                <?php endwhile;?>
            </div>
        </main>
    </div>
</body>
</html>