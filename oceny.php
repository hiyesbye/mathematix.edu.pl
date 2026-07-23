<br />
<b>Warning</b>:  Unknown: Input variables exceeded 1000. To increase the limit change max_input_vars in php.ini. in <b>Unknown</b> on line <b>0</b><br />
<?php
  session_start();
?>

<!DOCTYPE html>
<html>
<meta charset="utf-8">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php echo "<link rel='stylesheet' href='mystyle.css'>" ?>
        <title>Mathematix</title>
    </head>
    <body>
    <div class="obrazek2">
            <img src="niebo2.jpg" style="width:100%; height:100%;">
            <div class="centered3">Mathemati(x)</div>
        </div> 
        <ul>
        <li><a href='profil.php'>Twój profil[sem II]</a></li>
        <li><a href='profilsem1.php'>Twój profil[sem I]</a></li>
        <li><a href='ocenysem1.php'>Oceny[sem I]</a></li>
        <li><a href='https://eduone.pl/bialystok' target="_blank">Dziennik elektroniczny</a></li>
        <li><a href='dodatkowe.php'>Taski</a></li>
        <li><a href='matlandia.php'>Matlandia</a></li>
        <li><a href='./PSO MATEMATYKA 2023_2024.pdf' target="_blank">PSO</a></li>
        <li><a href='index.php'>Powrót</a></li>

        </ul> 
        <?php   if (isset($_SESSION["useruid"])) {
                $userId = $_SESSION["userid"];
                require_once 'includes/dbh.inc.php';  
                require_once 'includes/functions.inc.php';  

                $userquery = mysqli_query($conn, "SELECT * FROM users WHERE usersId=$userId");
                while($row = mysqli_fetch_assoc($userquery)){
                    $name = $row["usersName"];
                    $uname = $row["usersUid"];
                    $nrKl = $row["nrKlasy"];
                    $litKl = $row["litKlasy"];
                }
                $usersquery = mysqli_query($conn, "SELECT * FROM ocenysem1 WHERE usersId='$userId'");
                while($row = mysqli_fetch_assoc($usersquery)){
                    $kart1 = $row["kart1"];
                    $kart2 = $row["kart2"];
                    $kart3 = $row["kart3"];
                    $kart4 = $row["kart4"];
                    $kart5 = $row["kart5"];
                    $kart6 = $row["kart6"];
                    $kart7 = $row["kart7"];
                    $kart8 = $row["kart8"];
                    $klas1 = $row["klas1"];
                    $klas2 = $row["klas2"];
                    $klas3 = $row["klas3"];
                    $akt1 = $row["akt1"];
                    $akt2 = $row["akt2"];
                    $akt3 = $row["akt3"];
                    $akt4 = $row["akt4"];
                    $akt5 = $row["akt5"];
                    $akt6 = $row["akt6"];
                    $akt7 = $row["akt7"];
                    $akt8 = $row["akt8"];
                    $akt9 = $row["akt9"];
                    $akt10 = $row["akt10"];
                    $akt11 = $row["akt11"];
                    $lekcja = $row["lekcja"];
                    $aktdod = $row["aktdod"];
                    $mat1 = $row["mat1"];
                    $mat2 = $row["mat2"];
                    $mat3 = $row["mat3"];
                    $mat4 = $row["mat4"];
                    $mat5 = $row["mat5"];
                    $mat6 = $row["mat6"];
                    $wkm = $row["wkm"];
                    $alfik = $row["alfik"];
                    $brakpd1 = $row["brakpd1"];
                    $brakpd2 = $row["brakpd2"];
                    $brakpd3 = $row["brakpd3"];
                }

                $usersquery = mysqli_query($conn, "SELECT * FROM ocenysem2 WHERE usersId='$userId'");
                                while($row = mysqli_fetch_assoc($usersquery)){
                                    $kart12 = $row["kart12"];
                                    $kart22 = $row["kart22"];
                                    $kart32 = $row["kart32"];
                                    $kart42 = $row["kart42"];
                                    $kart52 = $row["kart52"];
                                    $kart62 = $row["kart62"];
                                    $kart72 = $row["kart72"];
                                    $kart82 = $row["kart82"];
                                    $klas12 = $row["klas12"];
                                    $klas22 = $row["klas22"];
                                    $klas32 = $row["klas32"];
                                    $akt12 = $row["akt12"];
                                    $akt22 = $row["akt22"];
                                    $akt32 = $row["akt32"];
                                    $akt42 = $row["akt42"];
                                    $akt52 = $row["akt52"];
                                    $akt62 = $row["akt62"];
                                    $akt72 = $row["akt72"];
                                    $akt82 = $row["akt82"];
                                    $akt92 = $row["akt92"];
                                    $aktA2 = $row["aktA2"];
                                    $aktB2 = $row["aktB2"];
                                    $lekcja2 = $row["lekcja2"];
                                    $aktdod2 = $row["aktdod2"];
                                    $mat12 = $row["mat12"];
                                    $mat22 = $row["mat22"];
                                    $mat32 = $row["mat32"];
                                    $mat42 = $row["mat42"];
                                    $mat52 = $row["mat52"];
                                    $mat62 = $row["mat62"];
                                    $kangur = $row["kangur"];
                                    $brakpd12 = $row["brakpd12"];
                                    $brakpd22 = $row["brakpd22"];
                                    $brakpd32 = $row["brakpd32"];
                                }

                $suma = 0; $sumawazona = 0;
                $ilkart = 0; $ilklas = 0; $ilakt = 0; $illek = 0; $ilad = 0; $ilmat = 0; $ilkon = 0;

                $kart = array($kart1, $kart2, $kart3, $kart4, $kart5, $kart6, $kart7, $kart8); 
                $klas = array($klas1, $klas2, $klas3);
                $kartt = array($kart12, $kart22, $kart32, $kart42, $kart52, $kart62, $kart72, $kart82);
                $klass = array($klas12, $klas22, $klas32);
                $akt = array($akt1, $akt2, $akt3, $akt4, $akt5, $akt6, $akt7, $akt8, $akt9, $akt10, $akt11);
                $aktt = array($akt12, $akt22, $akt32, $akt42, $akt52, $akt62, $akt72, $akt82, $akt92, $aktA2, $aktB2);
                $mat = array($mat1, $mat2, $mat3, $mat4, $mat5, $mat6);
                $matt = array($mat12, $mat22, $mat32, $mat42, $mat52, $mat62);
                $kon = array($wkm, $alfik, $kangur);
                $brakpd = array($brakpd1, $brakpd2, $brakpd3);
                $brakpdd = array($brakpd12, $brakpd22, $brakpd32);

                $kartczwarte = array("Rachunki pamięciowe", "Kolejność wykonywania działań",
                "Działania na dużych liczbach", "Zamiana jednostek");
                $kartpiate = array("Rachunki pamięciowe", "Działania pisemne", "Dzielniki",
                "Ułamki zwykłe i liczby mieszane", "Dodawanie i odejmowanie ułamków", "Mnożenie i dzielenie ułamków");
                $kartsiodme = array("Liczby", "Procenty i ułamki", "Obliczenia procentowe", "Obliczanie miar kątów",
                "Działania na liczbach dodatnich", "Obliczenia procentowe złożone");
                $kartosme = array("System rzymski", "Porównywanie liczb niewymiernych" , 
                "Działania na liczbach wymiernych", "Kwadraty i sześciany liczb", "Działania na potęgach", 
                "Działania na pierwiastkach");
                $klasczwarte = array("Liczby i działania", "Systemy zapisywania liczb", "Działania pisemne");
                $klaspiate = array("Liczby i działania", "Własności liczb naturalnych", "Ułamki zwykłe");
                $klassiodme = array("Liczby i działania", "Procenty", "Figury geometryczne");
                $klasosme = array("Liczby i działania", "Wyrażenia algebraiczne i równania", 
                "Twierdzenie Pitagorasa");        
                $matczwarte = array("Matlandia - Liczby i działania", "Matlandia - Systemy zapisywania liczb",
                "Matlandia - Działania pisemne", "Matlandia - Figury geometryczne");
                $matpiate = array("Matlandia - Liczby i działania", "Matlandia - Własności liczb naturalnych",
                 "Matlandia - Ułamki zwykłe");
                $matsiodme = array("Matlandia - Liczby i działania", " Matlandia - Procenty",
                "Matlandia - Figury geometryczne");
                $matosme = array("PowtórkoMat - Liczby i działania", "PowtórkoMat - Wyrażenia algebraiczne 
                i równania", "PowtórkoMat - Figury geometryczne na płaszczyźnie", 
                "PowtórkoMat - Zastosowania matematyki");
                $konkursy = array("Wojewódzki Konkurs Matematyczny", "Alfik", "Kangurek");


                $karttczwarte = array("");
                $karttpiate = array("");
                $karttsiodme = array("");
                $karttosme = array("");
                $klassczwarte = array("Figury geometryczne", "Ułamki zwykłe", "Ułamki dziesiętne", "Pola figur",
                "Prostopadłościany i sześciany");
                $klasspiate = array("Figury na płaszczyźnie", "Ułamki dziesiętne", "Pola Figur", "Liczby całkowite",
                "Graniastosłupy");
                $klasssiodme = array("Wyrażenia algebraiczne", "Równania", "Potęgi i pierwiastki", "Graniastosłupy", "Statystyka");
                $klassosme = array("Liczby i działania", "Wyrażenia algebraiczne i równania",
                "Twierdzenie Pitagorasa");
                $mattczwarte = array("Matlandia - Figury geometryczne", "Matlandia - Ułamki zwykłe",
                "Matlandia - Ułamki dziesiętne", "Matlandia - Pola figur", "Matlandia - Prostopadłościany i sześciany");
                $mattpiate = array("Matlandia - Figury na płaszczyźnie", "Matlandia - Ułamki dziesiętne",
                 "Matlandia - Pola Figur", "Matlandia - Liczby całkowite", "Matlandia - Graniastosłupy");
                $mattsiodme = array("Matlandia - Wyrażenia algebraiczne", " Matlandia - Równania",
                "Matlandia - Potęgi i pierwiastki", "Matlandia - Graniastosłupy", "Matlandia - Statystyka");
                $mattosme = ("");
                }
        ?>
          <div class="pusty">
            &nbsp
        </div>
          <div id="newsy">
            <div style="height:60px;"></div>
            <h1 class="malaramka">Twoje oceny [semestr 2]</h1>
            <div style="height:20px;"></div>
            <?php 
            for($x = 0; $x < count($kart); $x++){
                if($kart[$x] === NULL) continue;
                else if($kart[$x] === 'nb') continue;
                else{
                $suma+=wartOceny($kart[$x]);
                $sumawazona += 2*wartOceny($kart[$x]);
                $ilkart ++;
                }
            }
            for($x = 0; $x < count($kartt); $x++){
                if($kartt[$x] === NULL) continue;
                else {
                    echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);flush:left;
                    display:inline-block;background-color: rgba(231, 192, 17, 0.514);'>
                    Kartkówka ";
                    if ($nrKl === "4") {
                        echo "(".$karttczwarte[$x]."):</p>";
                    }
                    else if ($nrKl === "5") {
                        echo "(".$karttpiate[$x]."):</p>";
                    }
                    else if ($nrKl === "7") {
                        echo "(".$karttsiodme[$x]."):</p>";
                    }  
                    else if ($nrKl==="8"){
                        echo "(".$karttosme[$x]."):</p>";
                    }
                    if($kartt[$x]==="nb"){
                        echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);
                        flush:right; display:inline-block;position:absolute;right:15%;
                        background-color: rgba(0, 0, 0, 0.588);color:white;'>nb<br></p>";
                        echo "<div style='height:20px;'></div>";
                        continue;
                    }
                    else {
                        echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);
                        flush:right; display:inline-block;position:absolute;right:15%;
                        background-color: rgba(231, 192, 17, 0.514);'>". $kartt[$x] ."<br></p>";
                        echo "<div style='height:20px;'></div>";
                    }
                        $suma+=wartOceny($kartt[$x]);
                        $sumawazona += 2*wartOceny($kartt[$x]);
                        $ilkart ++;  

                }
            }
            for($x = 0; $x < count($klas); $x++){
                if($klas[$x] === NULL) continue;
                if($klas[$x] === 'nb') continue;
                else{
                    $suma+=wartOceny($klas[$x]);
                    $sumawazona+=3*wartOceny($klas[$x]);
                    $ilklas ++;
                }
            }
            for($x = 0; $x < count($klass); $x++){
                if($klass[$x] === NULL) continue;
                else {
                    echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);flush:left;
                    display:inline-block;background-color: rgba(223, 12, 12, 0.514);'>
                    Klasówka ";
                    if ($nrKl === "4") {echo "(".$klassczwarte[$x]."):</p>";}
                    else if ($nrKl === "5") {echo "(".$klasspiate[$x]."):</p>";}
                    else if ($nrKl === "7") {echo "(".$klasssiodme[$x]."):</p>";}
                    else if ($nrKl==="8"){echo "(".$klassosme[$x]."):</p>";}
                    if($klass[$x]==="nb"){
                        echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);
                        flush:right; display:inline-block;position:absolute;right:15%;
                        background-color: rgba(0, 0, 0, 0.588);color:white;'>nb<br></p>";
                        echo "<div style='height:20px;'></div>";
                        continue;
                    }
                    else{
                        echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);
                        flush:right; display:inline-block;position:absolute;right:15%;
                        background-color: rgba(223, 12, 12, 0.514);'>". $klass[$x] ."<br></p>";
                        echo "<div style='height:20px;'></div>";
                    }
                    $suma+=wartOceny($klass[$x]);
                    $sumawazona+=3*wartOceny($klass[$x]);
                    $ilklas ++;
                }
            }
            for($x = 0; $x < count($akt); $x++){
                if($akt[$x] === NULL) continue;
                else{
                    $suma+=wartOceny($akt[$x]);
                    $sumawazona+=wartOceny($akt[$x]);
                    $ilakt++;
                }
            }
            for($x = 0; $x < count($akt); $x++){
                if($aktt[$x] === NULL) continue;
                else {
                    echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);flush:left;
                    display:inline-block;background-color: rgba(48, 204, 17, 0.678);'>
                    Aktywność: </p>";
                    echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);
                    flush:right; display:inline-block;position:absolute;right:15%;
                    background-color: rgba(48, 204, 17, 0.678);'>". $aktt[$x] ."<br></p>";
                    echo "<div style='height:20px;'></div>";
                    $suma+=wartOceny($aktt[$x]);
                    $sumawazona+=wartOceny($aktt[$x]);
                    $ilakt++;
                }
            }
                for($x = 0; $x < count($mat); $x++){
                    if($mat[$x] === NULL) continue;
                    else{
                        $suma+=wartOceny($mat[$x]);
                        $sumawazona+=wartOceny($mat[$x]);
                        $ilmat++;
                    }
                }
                for($x = 0; $x < count($matt); $x++){
                    if($matt[$x] === NULL) continue;
                    else {
                        echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);flush:left;
                        display:inline-block;background-color: rgba(48, 204, 17, 0.678);'>";
                        if ($nrKl === "4") {echo "(".$mattczwarte[$x]."):</p>";}
                        if ($nrKl === "5") {echo "(".$mattpiate[$x]."):</p>";}
                        if ($nrKl === "7") {echo "(".$mattsiodme[$x]."):</p>";}
                        else if ($nrKl==="8")
                        {echo "(".$mattosme[$x]."):</p>";}
                        echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);
                        flush:right; display:inline-block;position:absolute;right:15%;
                        background-color: rgba(48, 204, 17, 0.678);'>". $matt[$x] ."<br></p>";
                        echo "<div style='height:20px;'></div>";
                        $suma+=wartOceny($matt[$x]);
                        $sumawazona+=wartOceny($matt[$x]);
                        $ilmat++;
                    }
                }
                if($lekcja2 != NULL){
                    echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);flush:left;
                    display:inline-block;background-color: rgba(231, 192, 17, 0.514);'>
                    Przeprowadzenie lekcji z matematyki: </p>";
                    echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);
                    flush:right; display:inline-block;position:absolute;right:15%; 
                    background-color: rgba(231, 192, 17, 0.514);'>". $lekcja2 ."<br></p>";
                    echo "<div style='height:20px;'></div>";
                    $suma+=wartOceny($lekcja2);
                    $sumawazona+=2*wartOceny($lekcja2);
                    $illek++;
                    if($lekcja != NULL){
                        $suma+=wartOceny($lekcja);
                        $sumawazona+=2*wartOceny($lekcja);
                        $illek++;
                    }
                }
                if($aktdod != NULL){
                    $suma+=wartOceny($aktdod);
                    $sumawazona+=wartOceny($aktdod);
                    $ilad=1;
                }
                if($aktdod2 != NULL){
                    echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);flush:left;
                    display:inline-block;background-color: rgba(23, 105, 6, 0.678);'>
                    Aktywność dodatkowa: </p>";
                    echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);
                    flush:right; display:inline-block;position:absolute;right:15%;
                    background-color: rgba(23, 105, 6, 0.678);'>". $aktdod2 ."<br></p>";
                    echo "<div style='height:20px;'></div>";
                    $suma+=wartOceny($aktdod2);
                    $sumawazona+=wartOceny($aktdod2);
                    if($lekcja != NULL) $ilad=2;
                    else $ilad=1;
                }
                for($x = 0; $x < count($brakpd); $x++){
                    if($brakpd[$x] === NULL) continue;
                    else {
                        $suma+=wartOceny($brakpd[$x]);
                        $sumawazona+=wartOceny($brakpd[$x]);
                        $ilpd++;
                    }
                }
                for($x = 0; $x < count($brakpdd); $x++){
                    if($brakpdd[$x] === NULL) continue;
                    else{
                        echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);flush:left;
                        display:inline-block;background-color: rgba(209, 103, 21, 0.678);'>
                        Brak pracy domowej: </p>";
                        echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);
                        flush:right; display:inline-block;position:absolute;right:15%; 
                        background-color: rgba(209, 103, 21, 0.678);'>". $brakpdd[$x] ."<br></p>";
                        echo "<div style='height:20px;'></div>";
                        $suma+=wartOceny($brakpdd[$x]);
                        $sumawazona+=wartOceny($brakpdd[$x]);
                        $ilpd++;
                    }
                }
                for($x = 0; $x < count($kon); $x++){
                    if($kon[$x] === NULL) continue;
                    else {
                        $suma+=wartOceny($kon[$x]);
                        $sumawazona+=wartOceny($kon[$x]);
                        $ilkon++;
                        if($kon[$x] === $kangur){
                            echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);flush:left;
                            display:inline-block;background-color: rgba(23, 105, 6, 0.678);'>";
                            echo "(".$konkursy[$x]."):</p>";
                            echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);
                            flush:right; display:inline-block;position:absolute;right:15%;
                            background-color: rgba(23, 105, 6, 0.678);'>". $kon[$x] ."<br></p>";
                            echo "<div style='height:20px;'></div>";
                        }
                    }
                }
            echo "<br><br><br><div>
            <p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788); 
            display:inline-block;'> Średnia arytmetyczna: </p>"; 
            echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788); 
            display:inline-block;position:absolute;right:15%;'>" . 
            round($suma/($ilkart + $ilklas + $ilakt + $ilmat + $ilad + $illek + $ilkon + $ilpd),2) 
            . "</div><br><br>";
            echo "<div><p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788); 
            display:inline-block;'> Średnia ważona: ";
            echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788); 
            display:inline-block;position:absolute;right:15%;'>" 
            . round($sumawazona/(2*$ilkart + 3*$ilklas + $ilakt + $ilmat + $ilad + 2*$illek 
            + $ilkon + $ilpd),2) . "</p></div><br><br>";
            echo "<div><p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788); 
            display:inline-block;'> Ocena proponowana: ";
            echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788); 
            display:inline-block;position:absolute;right:15%;'>" 
            . wartSredniej(round($sumawazona/(2*$ilkart + 3*$ilklas + $ilakt + $ilmat + $ilad + 2*$illek + 
            $ilkon + $ilpd),2)) ."</p></div><br><br>" ;
            echo "<div style='height:20px;'></div>";
            /*echo "<p> ilkart ".$ilkart. "<br>ilklas ".$ilklas. "<br>ilakt: " .$ilakt. "<br>ilmat: " .$ilmat.
             "<br ilad: " .$ilad. "<br> illek: ".$illek. "<br> ilkon: " .$ilkon. "<br> ilpd: " .$ilpd.
             "<br> suma wazona: " .$sumawazona. "<br> suma: " .$suma. "</p>";
             echo (2*$ilkart + 3*$ilklas + $ilakt + $ilmat 