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
        <li><a href='profilsem1.php'>Profil[sem I]</a></li>
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

                $usersquery = mysqli_query($conn, "SELECT * FROM ocenysem2 WHERE usersId='$userId'");
                    while($row = mysqli_fetch_assoc($usersquery)){
                    
                    $np2 = $row["np2"];
                    $datzgl12 = $row["datzgl12"];
                    $datzgl22 = $row["datzgl22"];
                    $datzgl32 = $row["datzgl32"];
                    
                }

                 $usersquery = mysqli_query($conn, "SELECT * FROM punktysem2 WHERE usersId='$userId'");
                                while($row = mysqli_fetch_assoc($usersquery)){
                                    $pkt2 = $row["pa2"];
                                    $kart12 = $row["pkart12"];
                                    $kart22 = $row["pkart22"];
                                    $kart32 = $row["pkart32"];
                                    $kart42 = $row["pkart42"];
                                    $kart52 = $row["pkart52"];
                                    $kart62 = $row["pkart62"];
                                    $kart72 = $row["pkart72"];
                                    $kart82 = $row["pkart82"];
                                    $klas12 = $row["pkklas12"];
                                    $klas22 = $row["pkklas22"];
                                    $klas32 = $row["pkklas32"];
                                    $paToGet2 = $row["paToGet2"];
                                    $maxkart12 = $row["maxkart12"];
                                    $maxkart22 = $row["maxkart22"];
                                    $maxkart32 = $row["maxkart32"];
                                    $maxkart42 = $row["maxkart42"];
                                    $maxkart52 = $row["maxkart52"];
                                    $maxkart62 = $row["maxkart62"];
                                    $maxkart72 = $row["maxkart72"];
                                    $maxklas12 = $row["maxklas12"];
                                    $maxklas22 = $row["maxklas22"];
                                    $maxklas32 = $row["maxklas32"];
                                    $maxklas42 = $row["maxklas42"];
                                    $ilbdb2 = $row["ilbdb2"];
                                    $ilcel2 = $row["ilcel2"];
                                    $ilpk2 = $row["ilpk2"];
                                    $ilpkl2 = $row["ilpkl2"];
                                    $nppkt2 = $row["nppkt2"];
                                }


                $kart = array($kart1, $kart2, $kart3, $kart4, $kart5, $kart6, $kart7, $kart8);
                $klas = array($klas1, $klas2, $klas3);
                $kartt = array($kart12, $kart22, $kart32, $kart42, $kart52, $kart62, $kart72, $kart82);
                $klass = array($klas12, $klas22, $klas32);
                $maxkart = array($maxkart1, $maxkart2, $maxkart3, $maxkart4, $maxkart5, $maxkart6, $maxkart7);
                $maxklas = array($maxklas1, $maxklas2,$maxklas3);
                $maxkartt = array($maxkart12, $maxkart22, $maxkart32, $maxkart42, $maxkart52, $maxkart62, $maxkart72);
                $maxklass = array($maxklas12, $maxklas22, $maxklas32);
                $kartczwarte = array("");
                $kartpiate = array("");
                $kartsiodme = array("");
                $kartosme = array("");
                $klasczwarte = array("Figury geometryczne", "Ułamki zwykłe", "Ułamki dziesiętne", "Pola figur",
                "Prostopadłościany i sześciany");
                $klaspiate = array("Figury na płaszczyźnie", "Ułamki dziesiętne", "Pola Figur", "Liczby całkowite",
                "Graniastosłupy");
                $klassiodme = array("Wyrażenia algebraiczne", "Równania", "Potęgi i pierwiastki", "Graniastosłupy", "Statystyka");
                $klasosme = array("Liczby i działania", "Wyrażenia algebraiczne i równania", 
                "Twierdzenie Pitagorasa");        
            }
        ?>
          <div class="pusty">
          &nbsp
        </div>
          <div id="newsy">
            <div style="height:20px;"></div>
            <h1 class="malaramka">Twój profil [semestr 2]</h1>
            <div style="height:20px;"></div>
            <p class="duzaramka_profil" style="border: 2px solid rgba(20, 0, 133, 0.788);">
            Name:<?php echo $name; ?><br>
            Username:<?php echo $uname; ?><br>
            Klasa:<?php echo $nrKl . $litKl; ?><br>
            </p>
            <h2 class='malaramka' style='background: rgba(94, 32, 147, 0.788);'>Nieprzygotowania:</h2>
            <p class="duzaramka_profil" style="border: 2px solid rgba(20, 0, 133, 0.788);
            background: rgba(147, 52, 202, 0.733);">
            Ilość nieprzygotowań do użycia: <br> <?php echo $np2 ?>
            </p>
            <?php
            if($np2 < 3){
                echo "<p class='duzaramka_profil' style='border: 2px solid rgba(20, 0, 133, 0.788); 
                background:rgba(147, 52, 202, 0.733);'>
                Pierwsze nieprzygotowanie zostało zgłoszone dnia:<br>". $datzgl12 . "</p>";
                if($np2 < 2){
                    echo "<p class='duzaramka_profil' style='border: 2px solid rgba(20, 0, 133, 0.788); 
                    background:rgba(147, 52, 202, 0.733);'>
                    Drugie nieprzygotowanie zostało zgłoszone dnia:<br>". $datzgl22 . "<p>";
                    if($np2 < 1){
                        echo "<p class='duzaramka_profil' style='border: 2px solid rgba(20, 0, 133, 0.788); 
                        background:rgba(147, 52, 202, 0.733);'>
                        Trzecie nieprzygotowanie zostało zgłoszone dnia:<br>". $datzgl32 . "</p>";
                    }
                }
            }

            if ($paToGet2 != NULL && $paToGet2 != 0){
            echo "<h2 class='malaramka' style='background: linear-gradient(180deg, rgb(102, 212, 214) 0%, rgb(104, 168, 121) 25%,
            rgb(176, 196, 139) 50%,  rgb(104, 168, 121) 75%, rgb(102, 212, 214) 100%')>Do odbioru</h2>";
            echo "<h2 class='duzaramka_profil' style='background: linear-gradient(180deg, rgb(102, 212, 214) 0%, rgb(104, 168, 121) 25%,
            rgb(176, 196, 139) 50%,  rgb(104, 168, 121) 75%, rgb(102, 212, 214) 100%'>Punkty aktywności do odbioru: ". $paToGet . "</h2>";
            }
            ?>
            <h2 class="malaramka">Punkty aktywności</h2>
            <p class="duzaramka_profil">Ilość punktów aktywności (ogółem): <?php echo $pkt2; ?><br></p>
            <p class="duzaramka_profil">Ilość punktów aktywności (dostępnych): 
                <?php if($nrKl==="4") echo $pkt2 - 5*$ilbdb2 - 10*$ilcel2 - 3*$ilpk2 - 6*$ilpkl2 - 10*$nppkt2;
                else echo $pkt2 - 5*$ilbdb2 - 10*$ilcel2 - 5*$ilpk2 - 10*$ilpkl2 - 10*$nppkt2; ?><br></p>

            <?php
            if(($ilbdb2 != NULL && $ilbdb2 != 0) || ($ilcel2 != NULL && $ilcel2 != 0)
            || ($ilpk2 != NULL && $ilpk2 != 0) || ($ilpkl2 != NULL && $ilpkl2 != 0))
            echo "<h2 class='malaramka'>Sklepik:</h2><br>";
            if($ilbdb2 != NULL && $ilbdb2 != 0){
                echo "<p class='duzaramka_oceny'; style='flush:left; display:inline-block;border:2px solid;'>
                Ilość 5 z aktywności:</p>";
                echo "<p class='duzaramka_oceny'; style='flush:right; 
                display:inline-block;position:absolute;right:15%;border:2px solid;'>" . $ilbdb2. "</p><br><br>";
            }
            if($ilcel2 != NULL && $ilcel2 != 0){
            echo "<p class='duzaramka_oceny'; style='flush:left; display:inline-block; border:2px solid;'>
            Ilość 6 z aktywności:</p>";
            echo "<p class='duzaramka_oceny'; style='flush:right; 
            display:inline-block;position:absolute;right:15%;border:2px solid;'>" . $ilcel2. "</p><br><br>";
            }
            if($ilpk2 != NULL && $ilpk2 != 0){
                echo "<p class='duzaramka_oceny'; style='flush:left; display:inline-block;border:2px solid;'>
                Ilość poprawianych kartkówek:</p>";
                echo "<p class='duzaramka_oceny'; style='flush:right; 
                display:inline-block;position:absolute;right:15%;border:2px solid;'>" . $ilpk2. "</p><br><br>";
            }
            if($ilpkl2 != NULL && $ilpkl2 != 0){
                echo "<p class='duzaramka_oceny'; style='flush:left; display:inline-block;border:2px solid;'>
                Ilość poprawianych klasówek:</p>";
                echo "<p class='duzaramka_oceny'; style='flush:right; 
                display:inline-block;position:absolute;right:15%;border:2px solid;'>" . $ilpkl2. "</p><br><br>";
            }
            if($nppkt2 != NULL && $nppkt2 != 0){
                            echo "<p class='duzaramka_oceny'; style='flush:left; display:inline-block;border:2px solid;'>
                            Ilość dodatkowych nieprzygotowań:</p>";
                            echo "<p class='duzaramka_oceny'; style='flush:right;
                            display:inline-block;position:absolute;right:15%;border:2px solid;'>" . $nppkt2. "</p><br><br>";
            }
            ?>
            <?php 
            for($x = 0; $x < count($kartt); $x++){
                if($kartt[$x] === NULL) continue;
                else {
                    $pct=intval($kartt[$x]/$maxkartt[$x] * 100);
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
                    if($kartt[$x]==="-1.00"){
                        echo "<p class='duzaramka_profil' style='background-color: rgba(0, 0, 0, 0.588); color:white;;'>
                        Nieobecność</p>";
                    }
                    else {
                        echo "<p class='duzaramka_profil' style='background-color: rgba(231, 192, 17, 0.514);'>
                    Ilość punktów: " . $kartt[$x] ."pkt/" . $maxkartt[$x]. "pkt <br>" .
                    "Ilość procent: " . $pct. "% <br>" .
                    "Ocena: " . zwrocOcene($pct) ."<br> </p>";
                    }
                }
            }
            for($x = 0; $x < count($klass); $x++){
                if($klass[$x] === NULL) continue;
                else {
                    $pct=intval($klass[$x]/$maxklass[$x] * 100);
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
                    if($pklass[$x]==="-1.00"){
                        echo "<p class='duzaramka_profil' style='background-color: rgba(223, 12, 12, 0.514);'>
                        Nieobecność</p>";
                    }
                    else {
                        echo "<p class='duzaramka_profil' style='background-color: rgba(223, 12, 12, 0.514);'>
                        Ilość punktów: " . $klass[$x] ."pkt/". $maxklass[$x] . "pkt<br>" .
                        "Ilość procent: " . $pct. "% <br>" .
                        "Ocena: " . zwrocOcene($pct)