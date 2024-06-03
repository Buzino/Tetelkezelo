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
            <nav>
                <h2>Menü</h2>
                <a href="">Kézikönyv</a>
            </nav>
            <form action="" method="post" class="keres modosit">
              <fieldset>
                <legend>Tétel hozzáadása / módosítása</legend>
                <label for="tantargy">Tantárgy:</label>
                <input type="text" name="tantargy" id="tantargy" list="targy">
                <datalist name="targy" id="targy">
                    <?php 
                        $result = $conn->query("SELECT nev FROM targyak ORDER BY nev ASC")->fetch_all(MYSQLI_ASSOC);
                        foreach ($result as $targy):
                    ?>
                    <option value="<?=$targy["nev"]?>" <?php if (($_POST["targy"] ?? false) == $targy["nev"]) echo "selected"?>></option>
                    <?php endforeach;?>
                </datalist>
                <br>
                <label for="cim">Tétel címe:</label> <input type="text" name="cim" id="cim" value="<?=$_POST["cim"] ?? ""?>">
                <br>
                <label for="vazlat">Vázlat:</label> <textarea name="vazlat" id="vazlat" rows="5"><?=$_POST["vazlat"] ?? ""?></textarea>
                <br>
                <label for="kidolgozas">Kidolgozás:</label> <textarea name="kidolgozas" id="kidolgozas" rows="5"><?=$_POST["vazlat"] ?? ""?></textarea>
                
                <div class="modositgombok">
                    <button type="submit" name="modosit" value="1">Mentés</button>
                    <button type="button" name="megsem" value="1" onclick="elvetes()">Mégsem</button>
                </div>
              </fieldset>
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
</body>
</html>