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
        <?php echo "<link rel='stylesheet' href='mystyle.css'>";
        echo "<link rel='stylesheet' href='mystyle2.css'>" ?>

        <title>Mathematix</title>
    </head>
    <body>
    <div class="obrazek2">
            <img src="niebo2.jpg" style="width:100%; height:100%;">
            <div class="centered3">Mathemati(x)</div>
        </div>
        <ul>
        <li><a href='profil.php'>Twój profil[sem II]</a></li>
        <li><a href='profilsem1.php'>Profil[sem I]</a></li>
        <li><a href='oceny.php'>Twoje oceny[sem II]</a></li>
        <li><a href='ocenysem1.php'>Oceny[sem I]</a></li>
        <li><a href='https://eduone.pl/bialystok' target="_blank">Dziennik elektroniczny</a></li>
        <li><a href='dodatkowe.php'>Taski</a></li>
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
                    $matlog = $row["matlog"];
                    $matpass = $row["matpass"];
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
                }

                $usersquery = mysqli_query($conn, "SELECT * FROM ocenysem1 WHERE usersId='$userId'");
                    while($row = mysqli_fetch_assoc($usersquery)){
                    $maxkart1 = $row["maxkart1"];
                    $maxkart2 = $row["maxkart2"];
                    $maxkart3 = $row["maxkart3"];
                    $maxkart4 = $row["maxkart4"];
                    $maxkart5 = $row["maxkart5"];
                    $maxkart6 = $row["maxkart6"];
                    $maxkart7 = $row["maxkart7"];
                    $np = $row["np"];
                    $datzgl = $row["datzgl"];
                    $datzgl2 = $row["datzgl2"];
                    $datzgl3 = $row["datzgl3"];
                }
                $kart = array($kart1, $kart2, $kart3, $kart4, $kart5, $kart6, $kart7, $kart8); 
                $klas = array($klas1, $klas2, $klas3);
                $maxkart = array($maxkart1, $maxkart2, $maxkart3, $maxkart4, $maxkart5, $maxkart6, $maxkart7);
                $kartczwarte = array("Dodawanie i odejmowanie liczb", "Mnożenie i dzielenie liczb", 
                "Cztery działania na liczbach", "Zapisywanie i odczytywanie liczb");
                $kartosme = array("System rzymski", "Porównywanie liczb niewymiernych" , "Działania na liczbach wymiernych",
                "Działania na ułamkach", "Działania na potęgach", 
                "Działania na pierwiastkach");
                $klasczwarte = array("Liczby i działania", "Systemy zapisywania liczb", "Działania pisemne");
                $klasosme = array("Liczby i działania", "Wyrażenia algebraiczne i równania", "Twierdzenie Pitagorasa");
        }
        ?>
          <div class="pusty">
          &nbsp
        </div>
          <div id="newsy">
            <div style="height:20px;"></div>
            <h1 class="malaramka">Twój profil</h1>
            <div style="height:20px;"></div>
            <p class="duzaramka_profil" style="border: 2px solid rgba(20, 0, 133, 0.788);">
            Name:<?php echo $name; ?><br>
            Username:<?php echo $uname; ?><br>
            Klasa:<?php echo $nrKl . $litKl; ?><br>
            </p>
            <div style="height:20px;"></div>
            <h1 class="malaramka">Matlandia</h1>
            <p class="duzaramka_profil" style="border: 2px solid rgba(20, 0, 133, 0.788);">
            Login: <?php echo $matlog ?><br>
            Hasło: <?php echo $matpass ?><br>
            </p>
            <div style="height:20px;"></div>
            <h1 class="malaramka">Instrukcja</h1>
            <p class="duzaramka_profil" style="border: 2px solid rgba(20, 0, 133, 0.788);">
            Na początku, żeby odpalić aplikację musisz podać swoje imię i nazwisko, a następnie zatwierdzić w prawym dolnym rogu ekranu.
            Przekieruje Cię to do strony z aplikacją
            <?php
            if (isset($_SESSION["useruid"])) {
                $userId = $_SESSION["userid"];
                require_once 'includes/dbh.inc.php';
                require_once 'includes/functions.inc.php';
                $userquery = mysqli_query($conn, "SELECT * FROM users WHERE usersId=$userId");
                while($row = mysqli_fetch_assoc($userquery)){
                    $name = $row["usersName"];
                    $uname = $row["usersUid"];
                    $nrKl = $row["nrKlasy"];
                }
            }
            if($nrKl=='4'){
                echo "Matlandia. Klasa 4. ";
            }
            else if($nrKl=='8'){
                echo "PowtórkoMat 8. Dostęp na 1 rok. ";
            }
            ?>
            Aby rozpocząć pracę w aplikacji, kliknij START.
            </p>
            <div style="height:20px;"></div>
            <h1 class="malaramka">Link do Matlandii:</h1>
            <a href='https://moje.gwo.pl/uzytkownik/' title='Matlandia' 
        target='_blank' 