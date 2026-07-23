<br />
<b>Warning</b>:  Unknown: Input variables exceeded 1000. To increase the limit change max_input_vars in php.ini. in <b>Unknown</b> on line <b>0</b><br />
<?php
  session_start();
?>

<!DOCTYPE html>
<html>
<meta charset="utf-8">
    <head>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <?php echo "<link rel='stylesheet' href='mystyle.css'>";
              echo "<link rel='stylesheet' href='mystyle2.css'>"
        ?>
        <title>Mathematix</title>
    </head>
    <body>
    <div class="obrazek2">
            <img src="niebo2.jpg" style="width:100%; height:100%;">
            <div class="centered3">Mathemati(x)</div>
        </div>  
        <div>
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
                  <a href="./Klasa VI - Rozkład materiału.pdf" title="Rozkład materiału w klasie VI" target="_blank">Klasa VI</a>
                  <a href="./Klasa VII - Rozkład materiału.pdf" title="Rozkład materiału w klasie VII" target="_blank">Klasa VII</a>
                  <a href="./Klasa VIII - Rozkład materiału.pdf" title="Rozkład materiału w klasie VIII" target="_blank">Klasa VIII</a>
                </div></li>
                <li><a href='https://eduone.pl/bialystok' target='_blank'>Dziennik elektroniczny</a></li>
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
          <div class="pusty">
          &nbsp
        ?>
                </div>
        <div id="newsy">
        <a class="taskowe" href="./Zadania konkursowe - część 0.pdf" title="Zadania konkursowe - część 0" target="_blank" style="text-decoration:none;"><h2 class="trzy" >Zadania konkursowe - część 0</h2></a>
        <a class="taskowe" href="https://drive.google.com/drive/folders/1CU0Rg_iJurlC1X5WHu85nJgyGsHAGLgc?usp=sharing" title="Rozwiązania - część 0" target="_blank" style="text-decoration:none;"><h2 class="jeden" >Rozwiązania - część 0</h2></a>
        <a class="taskowe" href="./Zadania konkursowe część I.pdf" title="Zadania konkursowe - część I" target="_blank" style="text-decoration:none;"><h2 class="trzy" >Zadania konkursowe - część I</h2></a>
        <a class="taskowe" href="https://drive.google.com/drive/folders/1qPLr67V1h_a5l9prFGMaLB2rP6bvojnI?usp=sharing" title="Rozwiązania - część I" target="_blank" style="text-decoration:none;"><h2 class="jeden" >Rozwiązania - część I</h2></a>
        <a class="taskowe" href="./Zadania konkursowe część II.pdf" title="Zadania konkursowe - część II" target="_blank" style="text-decoration:none;"><h2 class="trzy" >Zadania konkursowe - część II</h2></a>
        <a class="taskowe" href="https://drive.google.com/drive/folders/1rIPiQwLp36qku1XOuIdEIXsddTSn4jaK?usp=sharing" title="Rozwiązania - część II" target="_blank" style="text-decoration:none;"><h2 class="jeden" >Rozwiązania - część II</h2></a>
        <a class="taskowe" href="./Zadania konkursowe część III.pdf" title="Zadania konkursowe - część III" target="_blank" style="text-decoration:none;"><h2 class="trzy" >Zadania konkursowe - część III</h2></a>
        <a class="taskowe" href="https://drive.google.com/drive/folders/19IQGC5kaIxILERziZeoFThVM6IszMmvK?usp=sharing" title="Rozwiązania - część III" target="_blank" style="text-decoration:none;"><h2 class="jeden" >Rozwiązania - część III</h2></a>
        <a class="taskowe" href="./Zadania konkursowe część IV.pdf" title="Zadania konkursowe - część IV" target="_blank" style="text-decoration:none;"><h2 class="trzy" >Zadania konkursowe - część IV</h2></a>
        <a class="taskowe" href="https://drive.google.com/drive/folders/1XWUqYY3FkJTmXLoSEumy-AuDWaO3GUk5?usp=sharing" title="Rozwiązania - część IV" target="_blank" style="text-decoration:none;"><h2 class="jeden" >Rozwiązania - część IV</h2></a>
        <a class="taskowe" href="./Zadania konkursowe część V.pdf" title="Zadania konkursowe - część V" target="_blank" style="text-decoration:none;"><h2 class="trzy" >Zadania konkursowe - część V</h2></a>
        <a class="taskowe" href="https://drive.google.com/drive/folders/1FKIom7M7rYGZkTu4MgRNw2fCT6B9pUp-?usp=sharing" title="Rozwiązania - część V" target="_blank" style="text-decoration:none;"><h2 class="jeden" >Rozwiązania - część V</h2></a>
        <a class="taskowe" href="./Zadania konkursowe część VI.pdf" title="Zadania konkursowe - część VI" target="_blank" style="text-decoration:none;"><h2 class="trzy" >Zadania konkursowe - część VI</h2></a>
        <a class="taskowe" href="https://drive.google.com/drive/folders/1xlqvEZvrwOlFbFmShebMrKdl6zD6kk5q?usp=sharing" title="Rozwiązania - część VI" target="_blank" style="text-decoration:none;"><h2 class="jeden" >Rozwiązania - część VI</h2></a>
        <a class="taskowe" href="./Zadania konkursowe część VII.pdf" title="Zadania konkursowe - część VII" target="_blank" style="text-decoration:none;"><h2 class="trzy" >Zadania konkursowe - część VII</h2></a>
        <a class="taskowe" href="https://drive.google.com/drive/folders/15tjX7N1J0DivWsCcgXBKRGG7LpFJugsi?usp=sharing" title="Rozwiązania - część VII" target="_blank"