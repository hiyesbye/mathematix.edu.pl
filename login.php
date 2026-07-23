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
        <?php echo "<link rel='stylesheet' href='loginsignup.css'>";
        echo "<link rel='stylesheet' href='mystyle.css'>"; ?>

        <title>Mathematix</title>
    </head>
    <body>
    <div class="obrazek2">
            <img src="niebo2.jpg" style="width:100%; height:100%;">
            <div class="centered3">Mathemati(x)</div>
        </div> 
        </div>
        <ul id="navbar">
            <li><a href="index.php">Aktualności</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Filmy instruktażowe</a>
                <div class="dropdown-content">
                  <a href="klasa IV.html" title="Filmy z klasy IV">Klasa IV</a>
                  <a href="klasa V.html" title="Filmy z klasy V">Klasa V</a>
                  <a href="klasa VI.html" title="Filmy z klasy VI">Klasa VI</a>
                  <a href="klasa VII.html" title="Filmiki z klasy VII">Klasa VII</a>
                  <a href="klasa VIII.html" title="Filmiki z klasy VIII">Klasa VIII</a>
                </div></li>
                <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Zadania</a>
                <div class="dropdown-content">
                  <a href="konkurs.php" title="Zadania konkursowe" style="font-size:80%;">Zadania konkursowe</a>
                  <a href="taski.php" title="Zadania dodatkowe" style="font-size:80%;">Zadania dodatkowe</a>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Rozkłady materiału</a>
                <div class="dropdown-content">
                  <a href="./Klasa IV - Rozkład materiału.pdf" title="Rozkład materiału w klasie IV" target="_blank">Klasa IV</a>
                  <a href="./Klasa V - Rozkład materiału.pdf" title="Rozkład materiału w klasie V" target="_blank">Klasa V</a>
                  <a href="#">Klasa VI</a>
                  <a href="./Klasa VII - Rozkład materiału.pdf" title="Rozkład materiału w klasie VII" target="_blank">Klasa VII</a>
                  <a href="./Klasa VIII - Rozkład materiału.pdf" title="Rozkład materiału w klasie VIII" target="_blank">Klasa VIII</a>
                </div></li>
                <li><a href='https://eduone.pl/bialystok' target='_blank'>Dziennik elektroniczny</a></li>
            <!-- <li><a href="signup.php">Zarejestruj się</a></li> -->
            <li><a href="login.php">Zaloguj się</a></li>

          </ul>
          <div class="pusty">&nbsp</div>
          <div id="newsy">
            <div class="toform">
            <h2>Zaloguj się:</h2><br>
                <form action="includes/login.inc.php" method="post">
                <label for="fname">Nazwa użytkownika:</label>
                <input type="text" name="uid" placeholder="Nazwa użytkownika...">
                <label for="fname">Hasło:</label>
                <input type="password" name="pwd" placeholder="Hasło...">
                <button type="submit" name="submit">Zaloguj się</button>
                </form>
                <?php
                    if(isset($_GET["error"])){
                        if($_GET["error"] == "emptyinput"){
                            echo "<p>Wypełnij wszystkie pola!</p>";
                        }
                        else if($_GET["error"] == "wronglogin"){
                            echo "<p>Niepoprawna nazwa użytkownika!</p>";
                        }
                        else if($_GET["error"] == "wrongpwd"){
                            echo "<p>Niepoprawne hasło!</p>";
  