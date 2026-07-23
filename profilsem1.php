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
        <li><a href='oceny.php'>Twoje oceny[sem II]</a></li>
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

  //              if($userId == "1"){
  //      echo "<ul>
  //      <li><a href='klasa4a.php'>Klasa IV A</a></li>
  //      <li><a href='klasa4c.php'>Klasa IV C</a></li>
  //      <li><a href='klasa4e.php'>Klasa IV E</a></li>
  //      <li><a href='klasa8a.php'>Klasa VIII A</a></li>
   //     <li><a href='klasa8b.php'>Klasa VIII B</a></li>
   //     <li><a href='klasa8d.php'>Klasa VIII D</a></li>
    //    </ul>";
    //           }
                $userquery = mysqli_query($conn, "SELECT * FROM users WHERE usersId=$userId");
                while($row = mysqli_fetch_assoc($userquery)){
                    $name = $row["usersName"];
                    $uname = $row["usersUid"];
                    $nrKl = $row["nrKlasy"];
                    $litKl = $row["litKlasy"];
                }
                $usersquery = mysqli_query($conn, "SELECT * FROM punktysem1 WHERE usersId='$userId'");
                while($row = mysqli_fetch_assoc($usersquery)){
                    $pkt = $row["pa"];
                    $kart1 = $row["pkart1"];
                    $kart2 = $row["pkart2"];
                    $kart3 = $row["pkart3"];
                    $kart4 = $row["pkart4"];
                    $kart5 = $row["pkart5"];
                    $kart6 = $row["pkart6"];
                    $kart7 = $row["pkart7"];
                    $kart8 = $row["pkart8"];
                    $klas1 = $row["pkklas1"];
                    $klas2 = $row["pkklas2"];
                    $klas3 = $row["pkklas3"];
                    $paToGet = $row["paToGet"];
                    $maxkart1 = $row["maxkart1"];
                    $maxkart2 = $row["maxkart2"];
                    $maxkart3 = $row["maxkart3"];
                    $maxkart4 = $row["maxkart4"];
                    $maxkart5 = $row["maxkart5"];
                    $maxkart6 = $row["maxkart6"];
                    $maxkart7 = $row["maxkart7"];
                    $maxklas1 = $row["maxklas1"];
                    $maxklas2 = $row["maxklas2"];
                    $maxklas3 = $row["maxklas3"];
                    $maxklas4 = $row["maxklas4"];
                    $ilbdb = $row["ilbdb"];
                    $ilcel = $row["ilcel"];
                    $ilpk = $row["ilpk"];
                    $ilpkl = $row["ilpkl"];
                    $nppkt = $row["nppkt"];
                }

                $usersquery = mysqli_query($conn, "SELECT * FROM ocenysem1 WHERE usersId='$userId'");
                    while($row = mysqli_fetch_assoc($usersquery)){

                    $np = $row["np"];
                    $datzgl = $row["datzgl"];
                    $datzgl2 = $row["datzgl2"];
                    $datzgl3 = $row["datzgl3"];

                }
                $kart = array($kart1, $kart2, $kart3, $kart4, $kart5, $kart6, $kart7, $kart8);
                $klas = array($klas1, $klas2, $klas3);
                $maxkart = array($maxkart1, $maxkart2, $maxkart3, $maxkart4, $maxkart5, $maxkart6, $maxkart7);
                $maxklas = array($maxklas1, $maxklas2, $maxklas3);
                $kartczwarte = array("Rachunki pamięciowe",
                "Kolejność wykonywania działań", "Działania na dużych liczbach", "Zamiana jednostek");
                $kartpiate = array("Rachunki pamięciowe", "Działania pisemne", "Dzielniki",
                "Ułamki zwykłe i liczby mieszane", "Dodawanie i odejmowanie ułamków", "Mnożenie i dzielenie ułamków");
                $kartsiodme = array("Lic        zby", "Procenty i ułamki", "Obliczenia procentowe", "Obliczanie miar kątów",
                "Działania na liczbach dodatnich", "Obliczenia procentowe złożone");
                $kartosme = array("System rzymski", "Porównywanie liczb niewymiernych" ,
                "Działania na liczbach wymiernych", "Kwadraty i sześciany liczb", "Działania na potęgach",
                "Działania na pierwiastkach", "Trójkąty i czworokąty");
                $klasczwarte = array("Liczby i działania", "Systemy zapisywania liczb", "Działania pisemne");
                $klaspiate = array("Liczby i działania", "Własności liczb naturalnych", "Ułamki zwykłe");
                $klassiodme = array("Liczby i działania", "Procenty", "Figury geometryczne");
                $klasosme = array("Liczby i działania", "Wyrażenia algebraiczne i równania",
                "Twierdzenie Pitagorasa");
            }
        ?>
          <div class="pusty">
          &nbsp
        </div>
          <div id="newsy">
            <div style="height:20px;"></div>
            <h1 class="malaramka">Twój profil [semestr 1]</h1>
            <div style="height:20px;"></div>
            <p class="duzaramka_profil" style="border: 2px solid rgba(20, 0, 133, 0.788);">
            Name:<?php echo $name; ?><br>
            Username:<?php echo $uname; ?><br>
            Klasa:<?php echo $nrKl . $litKl; ?><br>
            </p>
            <h2 class='malaramka' style='background: rgba(94, 32, 147, 0.788);'>Nieprzygotowania:</h2>
            <p class="duzaramka_profil" style="border: 2px solid rgba(20, 0, 133, 0.788);
            background: rgba(147, 52, 202, 0.733);">
            Ilość nieprzygotowań do użycia: <br> <?php echo $np ?>
            </p>
            <?php
            if($np < 3){
                echo "<p class='duzaramka_profil' style='border: 2px solid rgba(20, 0, 133, 0.788);
                background:rgba(147, 52, 202, 0.733);'>
                Pierwsze nieprzygotowanie zostało zgłoszone dnia:<br>". $datzgl . "</p>";
                if($np < 2){
                    echo "<p class='duzaramka_profil' style='border: 2px solid rgba(20, 0, 133, 0.788);
                    background:rgba(147, 52, 202, 0.733);'>
                    Drugie nieprzygotowanie zostało zgłoszone dnia:<br>". $datzgl2 . "<p>";
                    if($np < 1){
                        echo "<p class='duzaramka_profil' style='border: 2px solid rgba(20, 0, 133, 0.788);
                        background:rgba(147, 52, 202, 0.733);'>
                        Trzecie nieprzygotowanie zostało zgłoszone dnia:<br>". $datzgl3 . "</p>";
                    }
                }
            }

            if ($paToGet != NULL && $paToGet != 0){
            echo "<h2 class='malaramka' style='background: linear-gradient(180deg, rgb(102, 212, 214) 0%, rgb(104, 168, 121) 25%,
            rgb(176, 196, 139) 50%,  rgb(104, 168, 121) 75%, rgb(102, 212, 214) 100%')>Do odbioru</h2>";
            echo "<h2 class='duzaramka_profil' style='background: linear-gradient(180deg, rgb(102, 212, 214) 0%, rgb(104, 168, 121) 25%,
            rgb(176, 196, 139) 50%,  rgb(104, 168, 121) 75%, rgb(102, 212, 214) 100%'>Punkty aktywności do odbioru: ". $paToGet . "</h2>";
            }
            ?>
            <h2 class="malaramka">Punkty aktywności</h2>
            <p class="duzaramka_profil">Ilość punktów aktywności (ogółem): <?php echo $pkt; ?><br></p>
            <p class="duzaramka_profil">Ilość punktów aktywności (dostępnych):
                <?php if($nrKl==="4") echo $pkt - 5*$ilbdb - 10*$ilcel - 3*$ilpk - 6*$ilpkl - 10*$nppkt;
                else echo $pkt - 5*$ilbdb - 10*$ilcel - 5*$ilpk - 10*$ilpkl - 10*$nppkt; ?><br></p>

            <?php
if(($ilbdb2 != NULL && $ilbdb != 0) || ($ilcel != NULL && $ilcel != 0)
            || ($ilpk != NULL && $ilpk != 0) || ($ilpkl != NULL && $ilpkl != 0))
            echo "<h2 class='malaramka'>Sklepik:</h2><br>";
            if($ilbdb != NULL && $ilbdb != 0){
                echo "<p class='duzaramka_oceny'; style='flush:left; display:inline-block;border:2px solid;'>
                Ilość 5 z aktywności:</p>";
                echo "<p class='duzaramka_oceny'; style='flush:right;
                display:inline-block;position:absolute;right:15%;border:2px solid;'>" . $ilbdb. "</p><br><br>";
            }
            if($ilcel != NULL && $ilcel != 0){
            echo "<p class='duzaramka_oceny'; style='flush:left; display:inline-block; border:2px solid;'>
            Ilość 6 z aktywności:</p>";
            echo "<p class='duzaramka_oceny'; style='flush:right;
            display:inline-block;position:absolute;right:15%;border:2px solid;'>" . $ilcel. "</p><br><br>";
            }
            if($ilpk != NULL && $ilpk != 0){
                echo "<p class='duzaramka_oceny'; style='flush:left; display:inline-block;border:2px solid;'>
                Ilość poprawianych kartkówek:</p>";
                echo "<p class='duzaramka_oceny'; style='flush:right;
                display:inline-block;position:absolute;right:15%;border:2px solid;'>" . $ilpk. "</p><br><br>";
            }
            if($ilpkl != NULL && $ilpkl != 0){
                echo "<p class='duzaramka_oceny'; style='flush:left; display:inline-block;border:2px solid;'>
                Ilość poprawianych klasówek:</p>";
                echo "<p class='duzaramka_oceny'; style='flush:right;
                display:inline-block;position:absolute;right:15%;border:2px solid;'>" . $ilpkl. "</p><br><br>";
            }
            if($nppkt != NULL && $nppkt != 0){
                            echo "<p class='duzaramka_oceny'; style='flush:left; display:inline-block;border:2px solid;'>
                            Ilość dodatkowych nieprzygotowań:</p>";
                            echo "<p class='duzaramka_oceny'; style='flush:right;
                            display:inline-block;position:absolute;right:15%;border:2px solid;'>" . $nppkt. "</p><br><br>";
            }
            ?>
            <?php
            for($x = 0; $x < count($kart); $x++){
                if($kart[$x] === NULL) continue;
                else {
                    $pct=intval($kart[$x]/$maxkart[$x] * 100);
                    echo "<h2 class='malaramka' style='background-color: rgba(231, 192, 17, 0.7);'>Kartkówka ";
                    if ($nrKl === "4") {
                        echo "(".$kartczwarte[$x].")";
                    }
                    else if ($nrKl==="5"){
                        echo "(".$kartpiate[$x].")";
                    }
                    else if ($nrKl==="7"){
                        echo "(".$kartsiodme[$x].")";
                    }
                    else if ($nrKl==="8"){
                        echo "(".$kartosme[$x].")";
                    }
                    echo "</h2>";
                    if($kart[$x]==="-1.00"){
                        echo "<p class='duzaramka_profil' style='background-color: rgba(0, 0, 0, 0.588); color:white;;'>
                        Nieobecność</p>";
                    }
                    else {
                        echo "<p class='duzaramka_profil' style='background-color: rgba(231, 192, 17, 0.514);'>
                    Ilość punktów: " . $kart[$x] ."pkt/" . $maxkart[$x]. "pkt <br>" .
                    "Ilość procent: " . $pct. "% <br>" .
                    "Ocena: " . zwrocOcene($pct) ."<br> </p>";
                    }
                }
            }
            for($x = 0; $x < count($klas); $x++){
                if($klas[$x] === NULL) continue;
                else {
                    $pct=intval($klas[$x]/$maxklas[$x] * 100);
                    echo "<h2 class='malaramka' style='background-color: rgba(223, 12, 12, 0.7);'>Klasówka ";
                    if ($nrKl === "4") {
                        echo "(".$klasczwarte[$x].")";
                    }
                    else if ($nrKl==="5"){
                        echo "(".$klaspiate[$x].")";
                    }
                    else if ($nrKl==="7"){
                        echo "(".$klassiodme[$x].")";
                    }
                    else if ($nrKl==="8"){
                        echo "(".$klasosme[$x].")";
                    }
                    echo "</h2>";
                    if($pklas[$x]==="-1.00"){
                        echo "<p class='duzaramka_profil' style='background-color: rgba(223, 12, 12, 0.514);'>
                        Nieobecność</p>";
                    }
                    else {
                        echo "<p class='duzaramka_profil' style='background-color: rgba(223, 12, 12, 0.514);'>
                        Ilość punktów: " . $klas[$x] ."pkt/". $maxklas[$x] . "pkt<br>" .
                        "Ilość procent: " . $pct. "% <br>" .
                        "Ocena: " . zwrocOcene($pct)