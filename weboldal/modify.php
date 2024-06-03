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
                <a href="">Új tétel</a>
                <a href="">Kézikönyv</a>
            </nav>
            <form action="" method="post" class="keres modosit">
              <fieldset>
                <legend>Tétel hozzáadása / módosítása</legend>
                <div class="modositgombok">
                    <button type="submit" name="modosit" value="1">Mentés</button>
                    <button type="submit" name="megsem" value="1">Mégsem</button>
                </div>
                <label for="szoveg">Keresés szövege:</label> <input type="text" name="szoveg" id="szoveg" value="<?=($_POST["szoveg"] ?? '')?>">
                <br>
              </fieldset>
            </form>
        </main>
    </div>
</body>
</html>