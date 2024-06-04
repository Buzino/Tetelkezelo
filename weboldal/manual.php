<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tételkezelő</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="tartalom manual">
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
                <li><h2><a style="pointer-events: none;">Menü</a></h2></li>
                <li><a href="index.php">Vissza a főoldalra</a></li>
            </ul>
        </nav>
        <main>
            <!--Leírás-->
            <h1>Használati útmutató</h1>
            <p>Ez az oldal egy használói utmutatóként szolgál a tételkezelő webes és asztali alkalmazáshoz.</p>
            
            <h2>A főoldal</h2>
            <p>A főoldalon indításkor a keresővel, és egy összes tételt tartalmazó felsorolással találkozhatunk.</p>
            
            <h3>Keresés</h3>
            <p>Ha keresni szeretnénk a tételek között, azt a főoldalon tehetjük meg. A keresőben két beviteli mezővel és két gombbal találkozunk:</p>
                <ul>
                    <li>a felső, „Keresett szöveg” felirattal ellátott szövegmezőben a tételek címében való keresést érhetjük el. Ha csak egy egy- vagy kétjegyű számot írunk be, akkor a program a tételek sorszámában keres, egyébként a címekben próbálja megkeresni a beírt szöveget.</li>
                    <li>az alsó, „Szűrés tantárgyra” feliratú egy lenyíló menü, melyben az adatbázisban szereplő tantárgyak közül választhatunk egyet, mely tantárgy tételei közt szeretnénk a keresést folytatni. „Nincs megadva” érték esetén a program nem szűr tantárgyra.</li>
                </ul>
                <!--kép a beviteli mezőkről-->
            <p>Természetesen lehet egyszerre mindkét szempont alapján szűrni.</p>
            <p>Miután beírtuk/kiválasztottuk a kívánt feltételeket, a „Keres” gombra nyomva szűrhetjük ki a tételeket.</p>
            <!--képek 4 szűrésről - egyik-másik-mindkettő feltétel és egy, ahol nincs megfelelő elem-->

            <h3>Tételek böngészése</h3>
            <p>A keresés űrlap alatt a tételeket láthatjuk felsorolva. Megjelenik a tételek sorszáma, címe, tantárgya, az utolsó módosítás dátuma, majd a vázlat és a kidolgozás első 3 sora.</p>
            <p>A tételek „kártyáinak” alján láthatunk egy „Tovább a tételre” gombot, mellyel a tétel egésze tárul a szemünk elé.</p>

            <h2>A tételek olvasása oldal</h2>
            <p>Ezen az oldalon a tételek részletesen láthatóak. Látható a teljes vázlat és kidolgozás, melyet az adott tételhez feltöltöttek. A vázlat fölött azonban „Műveletek” címszóval lehetőségünk akad visszatérni a főoldalra, vagy módosítani a tételen.</p>

            <h3>Tételek módosítása</h3>
            <p>Erre az oldalra a teljes tételt bemutató oldalról, vagy a főoldalon a menüből az „Új tétel” gombbal juthatunk el.</p>

            <h2>Új tétel hozzáadása</h2>
            <p>Új tételt a főoldalon lévő menüben található „Új tétel” gombbal hozhatunk létre.</p>

            <h3>Tantárgy</h3>
            <p>A „Tantárgy” mezőben a program felajánlja a már meglévő tantárgyakat, ám akár újat is megadhatunk - melyet a mentéskor létrehoz.</p>

            <h3>Sorszám</h3>
            <p>A „Tétel sorszáma” mezőben egy 0-tól nagyobb számot adhatunk meg. Ha a szám nem felel meg ennek a kritériumnak, akkor mentés előtt szól a program erről.</p>

            <h3>Cím</h3>
            <p>A tétel címét egy egyszerű szöveges mezővel vihetjük be.</p>

            <h3>Vázlat és kidolgozás</h3>
            <p>A vázlat a tétel rövid összefoglalását hivatott szolgálni.</p>
            <p>A bevitel egy szövegdobozban történik, melyben túlcsordulás esetén görgetősáv jelenik meg.</p>
            <p>A doboz függőlegesen átméretezhető, ha a szöveg nagyobb részét szeretnénk átlátni.</p>
            <p>A kidolgozás bevitele ugyanígy működik. A kidolgozás a vázlattal szemben egy hosszabb, egybefüggő szöveg hivatott lenni a tételről.</p>

            <h3>Mentés</h3>
            <p>Ha végeztünk az adatok kitöltésével, akkor a „Mentés” gombra kattintva feltölthetjük az adatbázisba.</p>
            <p>Ha valami probléma van a kitöltött űrlappal, akkor a program ezt jelzi. Ha a feltöltés során lenne gond, akkor erről egy párbeszédablakot kapunk a hibával, és a szerkesztőben maradunk.</p>
            <p>Sikeres mentés esetén egy párbeszédablakot kapunk a sikerességről, majd a főoldalra irányít minket a program.</p>

            <h2>Tételek módosítása</h2>
            <p>A tételek egészét bemutató oldalakon lévő „Tétel módosítása” gombbal érhetjük el a módosító felületet.</p>
            <p>Ilyenkor a következőkben tárgyalt beviteli mezőket a program kitölti az aktuális tétel adataival.</p>
            <p>Az adatok módosítása ezután ugyanazon módszerekkel/feltételekkel működik, mint a hozzáadásnál.</p>
            
            <h3>Kilépés mentés nélkül</h3>
            <p>Ha csak véletlen léptünk erre az oldalra, vagy meggondoltuk magunkat, és nem módosítanánk az adott tételt, akkor a „Mégse” gombra nyomva kiléphetünk a szerkesztőből.</p>
            <p>A program a főoldalra való visszatérés előtt megerősítés gyanánt egy párbeszédablakban még egyszer megkérdez, hogy biztos ki szeretnénk-e lépni. „Nem” válasz esetén a szerkesztőben maradunk, „Igen” esetén a program változtatás nélkül visszairányít minket a főoldalra. </p>
            
            <h3>Törlés</h3>
            <p>Ha az adott tételt törölni szeretnénk, az oldal alján lévő „Törlés” gombra nyomva tehetjük meg.</p>
            <p>Ekkor egy megerősítő kérdést kapunk, hogy biztos törölni szeretnénk-e, mivel ez egy nem visszafordítható folyamat. „Nem” válasz esetén a szerkesztőben maradunk, „Igen” esetén a program törli a tételt és visszairányít minket a főoldalra.</p>
            
            <h3>Mentés</h3>
            <p>A módosítások elvégzése után a „Mentés” gombra kattintva a program megkísérli frissíteni az adatbázist.</p>
            <p>A program párbeszédablakban jelzi a sikeres feltöltést, vagy az éppen kialakult problémát. Sikeres feltöltés esetén a főoldalra kerülünk vissza.</p>
        </main>
    </div>
    
    <script defer src="app.js"></script>
</body>
</html>