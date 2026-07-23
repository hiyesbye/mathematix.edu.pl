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
        <li><a href='profil.php'>Twój profil</a></li>
        <li><a href='https://login.prymus.net/login' target="_blank">Dziennik elektroniczny</a></li>
        <li><a href='dodatkowe.php'>Taski</a></li>
        <li><a href='matlandia.php'>Matlandia</a></li>
        <li><a href='./PSO MATEMATYKA 2022_2023.pdf' target="_blank">PSO</a></li>
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
                $suma = 0; $sumawazona = 0;
                $ilkart = 0; $ilklas = 0; $ilakt = 0; $illek = 0; $ilad = 0; $ilmat = 0; $ilkon = 0;

                $kart = array($kart1, $kart2, $kart3, $kart4, $kart5, $kart6, $kart7, $kart8); 
                $klas = array($klas1, $klas2);
                $akt = array($akt1, $akt2, $akt3, $akt4, $akt5, $akt6, $akt7, $akt8, $akt9, $akt10, $akt11);
                $mat = array($mat1, $mat2, $mat3, $mat4, $mat5, $mat6);
                $kon = array($wkm, $alfik);
                $brakpd = array($brakpd1, $brakpd2, $brakpd3);

                $kartczwarte = array("Dodawanie i odejmowanie liczb", "Mnożenie i dzielenie liczb", 
                "Kolejność wykonywania działań", "Jednostki masy, długości, monetarne");
                $kartosme = array("System rzymski", "Porównywanie liczb niewymiernych" , 
                "Działania na liczbach wymiernych", "Kwadraty i sześciany liczb", "Działania na potęgach", 
                "Działania na pierwiastkach");
                $klasczwarte = array("Liczby i działania", "Systemy zapisywania liczb", "Działania pisemne");
                $klasosme = array("Liczby i działania", "Wyrażenia algebraiczne i równania", 
                "Twierdzenie Pitagorasa");        }
                $matczwarte = array("Matlandia - Liczby i działania", "Matlandia - Systemy zapisywania liczb",
            "Matlandia - Działania pisemne", "Matlandia - Figury geometryczne");
                $matosme = array("PowtórkoMat - Liczby i działania", "PowtórkoMat - Wyrażenia algebraiczne 
                i równania", "PowtórkoMat - Figury geometryczne na płaszczyźnie", 
                "PowtórkoMat - Zastosowania matematyki");
                $konkursy = array("Wojewódzki Konkurs Matematyczny", "Alfik", "Kangurek");
        ?>
          <div class="pusty">
            &nbsp
        </div>
          <div id="newsy">
            <div style="height:60px;"></div>
            <h1 class="malaramka">Twoje oceny</h1>
            <div style="height:20px;"></div>
            <?php 
            for($x = 0; $x < count($kart); $x++){
                if($kart[$x] === NULL) continue;
                else {
                    echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);flush:left;
                    display:inline-block;background-color: rgba(231, 192, 17, 0.514);'>
                    Kartkówka ";
                    if ($nrKl === "4") {
                        echo "(".$kartczwarte[$x]."):</p>";
                    } 
                    else if ($nrKl==="8"){
                        echo "(".$kartosme[$x]."):</p>";
                    }
                    if($kart[$x]==="nb"){
                        echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);
                    flush:right; display:inline-block;position:absolute;right:15%; 
                    background-color: rgba(0, 0, 0, 0.588);color:white;'>nb<br></p>";
                    echo "<div style='height:20px;'></div>";
                    }
                    else {
                        echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);
                    flush:right; display:inline-block;position:absolute;right:15%; 
                    background-color: rgba(231, 192, 17, 0.514);'>". $kart[$x] ."<br></p>";
                        echo "<div style='height:20px;'></div>";
                    }
                        $suma+=wartOceny($kart[$x]);
                        $sumawazona += 2*wartOceny($kart[$x]);
                        $ilkart ++;  

            }
        }
            for($x = 0; $x < count($klas); $x++){
                if($klas[$x] === NULL) continue;
                else {
                    echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);flush:left;
                    display:inline-block;background-color: rgba(223, 12, 12, 0.514);'>
                    Klasówka ";
                    if ($nrKl === "4") {echo "(".$klasczwarte[$x]."):</p>";} 
                    else if ($nrKl==="8"){echo "(".$klasosme[$x]."):</p>";}
                    if($klas[$x]==="nb"){
                        echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);
                    flush:right; display:inline-block;position:absolute;right:15%; 
                    background-color: rgba(0, 0, 0, 0.588);color:white;'>nb<br></p>";
                    echo "<div style='height:20px;'></div>";
                    }
                    else{
                    echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);
                    flush:right; display:inline-block;position:absolute;right:15%;
                    background-color: rgba(223, 12, 12, 0.514);'>". $klas[$x] ."<br></p>";
                    echo "<div style='height:20px;'></div>";
                    }
                    $suma+=wartOceny($klas[$x]);
                    $sumawazona+=3*wartOceny($klas[$x]);
                    $ilklas ++;
                }
            }
            for($x = 0; $x < count($akt); $x++){
                if($akt[$x] === NULL) continue;
                else {
                    echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);flush:left;
                    display:inline-block;background-color: rgba(48, 204, 17, 0.678);'>
                    Aktywność: </p>";
                    echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);
                    flush:right; display:inline-block;position:absolute;right:15%;
                    background-color: rgba(48, 204, 17, 0.678);'>". $akt[$x] ."<br></p>";
                    echo "<div style='height:20px;'></div>";
                    $suma+=wartOceny($akt[$x]);
                    $sumawazona+=wartOceny($akt[$x]);
                    $ilakt++;
                }
            }
                for($x = 0; $x < count($mat); $x++){
                    if($mat[$x] === NULL) continue;
                    else {
                        echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);flush:left;
                        display:inline-block;background-color: rgba(48, 204, 17, 0.678);'>";
                        if ($nrKl === "4") {echo "(".$matczwarte[$x]."):</p>";} else if ($nrKl==="8")
                        {echo "(".$matosme[$x]."):</p>";}
                        echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);
                        flush:right; display:inline-block;position:absolute;right:15%;
                        background-color: rgba(48, 204, 17, 0.678);'>". $mat[$x] ."<br></p>";
                        echo "<div style='height:20px;'></div>";
                        $suma+=wartOceny($mat[$x]);
                        $sumawazona+=wartOceny($mat[$x]);
                        $ilmat++;
                    }
            }
                if($lekcja != NULL){
                    echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);flush:left;
                    display:inline-block;background-color: rgba(231, 192, 17, 0.514);'>
                    Przeprowadzenie lekcji z matematyki: </p>";
                    echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);
                    flush:right; display:inline-block;position:absolute;right:15%; 
                    background-color: rgba(231, 192, 17, 0.514);'>". $lekcja ."<br></p>";
                    echo "<div style='height:20px;'></div>";
                    $suma+=wartOceny($lekcja);
                    $sumawazona+=2*wartOceny($lekcja);
                    $illek=1;
                }
                if($aktdod != NULL){
                    echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);flush:left;
                    display:inline-block;background-color: rgba(23, 105, 6, 0.678);'>
                    Aktywność dodatkowa: </p>";
                    echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);
                    flush:right; display:inline-block;position:absolute;right:15%; 
                    background-color: rgba(23, 105, 6, 0.678);'>". $aktdod ."<br></p>";
                    echo "<div style='height:20px;'></div>";
                    $suma+=wartOceny($aktdod);
                    $sumawazona+=wartOceny($aktdod);
                    $ilad=1;
                }
                for($x = 0; $x < count($brakpd); $x++){
                    if($brakpd[$x] === NULL) continue;
                    else{
                        echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);flush:left;
                        display:inline-block;background-color: rgba(209, 103, 21, 0.678);'>
                        Brak pracy domowej: </p>";
                        echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);
                        flush:right; display:inline-block;position:absolute;right:15%; 
                        background-color: rgba(209, 103, 21, 0.678);'>". $brakpd[$x] ."<br></p>";
                        echo "<div style='height:20px;'></div>";
                        $suma+=wartOceny($brakpd[$x]);
                        $sumawazona+=wartOceny($brakpd[$x]);
                        $ilpd++;
                }
            }
            for($x = 0; $x < count($kon); $x++){
                if($kon[$x] === NULL) continue;
                else {
                    echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);flush:left;
                    display:inline-block;background-color: rgba(23, 105, 6, 0.678);'>";
                    echo "(".$konkursy[$x]."):</p>";
                    echo "<p class='duzaramka_oceny' style='border: 5px solid rgba(20, 0, 133, 0.788);
                    flush:right; display:inline-block;position:absolute;right:15%; 
                    background-color: rgba(23, 105, 6, 0.678);'>". $kon[$x] ."<br></p>";
                    echo "<div style='height:20px;'></div>";
                    $suma+=wartOceny($kon[$x]);
                    $sumawazona+=wartOceny($kon[$x]);
                    $ilkon++;
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

            ?>
          </p>
    <script src="functions.js"></script>
    </body>
</html>