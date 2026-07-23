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
        <?php 
        echo "<link rel='stylesheet' href='loginsignup.css'>";
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
                  <a href="klasa IV.html">Klasa IV</a>
                  <a href="#">Klasa V</a>
                  <a href="#">Klasa VI</a>
                  <a href="klasa VII.html" title="Filmiki z klasy VII">Klasa VII</a>
                  <a href="klasa VIII.html" title="Filmiki z klasy VIII">Klasa VIII</a>
                </div></li>
            <li><a href="#">Zadania</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Rozkłady materiału</a>
                <div class="dropdown-content">
                  <a href="#">Klasa IV</a>
                  <a href="#">Klasa V</a>
                  <a href="#">Klasa VI</a>
                  <a href="./Klasa VII - Rozkład materiału.pdf" title="Rozkład materiału w klasie VII" target="_blank">Klasa VII</a>
                  <a href="./Klasa VIII - Rozkład materiału.pdf" title="Rozkład materiału w klasie VIII" target="_blank">Klasa VIII</a>
                </div></li>
                <li><a href='https://login.prymus.net/login' target='_blank'>Dziennik elektroniczny</a></li>
                <?php
                  if (isset($_SESSION["useruid"])) {
                    echo "<li><a href='profil.php'>Twój profil<br>[" 
                    .$_SESSION['useruid'] . "]</a></li>";
                    echo "<li><a href='includes/logout.inc.php'>Wyloguj się</a></li>";
                    if($_SESSION["userid"] == "1"){
                      echo "<li><a href='signup.php'>Zarejestruj się</a></li>";
                    }
                  }
                  else {
                    echo "<li><a href='login.php'>Zaloguj się</a></li>";
                  }
                ?>
          </ul>
                </div>
          </ul>
          <div class="pusty">&nbsp</div>
          <div id="newsy">
            <div class="toform">
            <h2>Rejestracja:</h2><br>
                <form action="includes/signup.inc.php" method="post">
                    
                <label for="fname">Imię i nazwisko:</label>
                <input type="text" name="name" placeholder="Imię i nazwisko...">
<!-- 
                <label for="fname">E-mail:</label>
                <input type="text" name="email" placeholder="Email..."> -->

                <label for="fname">Nazwa użytkownika:</label>
                <input type="text" name="uid" placeholder="Nazwa użytkownika...">

                <label for="fname">Hasło:</label>
                <input type="password" name="pwd" placeholder="Hasło...">

                <label for="fname">Powtórz hasło:</label>
                <input type="password" name="pwdrepeat" placeholder="Powtórz hasło...">

                <label for="fname">Klasa:</label>
                <input type="number" name="nrklasy" placeholder="liczba" min="1" max="8">
                <input type="text" id="cl" name="litklasy" placeholder="Wielka litera..." maxlength="1" pattern="[A-Z]{1}"> <br>


                <label for="fname">Płeć:</label><br>
                <input type="radio" name="gender" id="fname1" value="K">
                <label for="fname1" style="font-size:20px;">Kobieta</label><br>
                <input type="radio" name="gender" id="fname2" value="M">
                <label for="fname2" style="font-size:20px;">Mężczyzna</label>
                <button type="submit" name="submit">Zarejestruj się</button>
                </form>           
          <?php
            if(isset($_GET["error"])){
                if($_GET["error"] == "emptyinput"){
                    echo "<p>Wypełnij wszystkie pola!</p>";
                }
                else if($_GET["error"] == "invaliduid"){
                    echo "<p>Podaj poprawną nazwę użytkownika!</p>";
                }
                else if($_GET["error"] == "invalidemail"){
                    echo "<p>Podaj poprawny adres mailowy!</p>";
                }
                else if($_GET["error"] == "passwordsdontmatch"){
                    echo "<p>Powtórzone hasło się nie zgadza!</p>";
                }
                else if($_GET["error"] == "stmtfailed"){
                    echo "<p>Coś poszło nie tak, spróbój ponownie.</p>";
                }
                else if($_GET["error"] == "usernametaken"){
                    echo "<p>Podana nazwa użytkownika jest już zajęta!</p>";
                }
                else if($_GET["error"] == "none"){
                    echo "<p>Zarejestrowałeś się poprawnie!</p>";
                }
                else if($_GET["error"] == "emptygender"){
                    echo "<p>Za