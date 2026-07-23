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
        <h1 class="trzy">Klasa IV [2023/2024]:</h1>
        <div style="height:20px;"></div>
        <a class="taskowe" href="./Task 1 [klasa IV]_2023-24.pdf" title="Task 1 [klasa IV]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 1 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 2 [klasa IV]_2023-24.pdf" title="Task 2 [klasa IV]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 2 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 3 [klasa IV]_2023-24.pdf" title="Task 3 [klasa IV]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 3 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 4 [klasa IV]_2023-24.pdf" title="Task 4 [klasa IV]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 4 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 5 [klasa IV]_2023-24.pdf" title="Task 5 [klasa IV]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 5 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 6 [klasa IV]_2023-24.pdf" title="Task 6 [klasa IV]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 6 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 7 [klasa IV]_2023-24.pdf" title="Task 7 [klasa IV]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 7 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 8 [klasa IV]_2023-24.pdf" title="Task 8 [klasa IV]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 8 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 9 [klasa IV]_2023-24.pdf" title="Task 9 [klasa IV]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 9 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 10 [klasa IV]_2023-24.pdf" title="Task 10 [klasa IV]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 10 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 11 [klasa IV]_2023-24.pdf" title="Task 11 [klasa IV]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 11 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 12 [klasa IV]_2023-24.pdf" title="Task 12 [klasa IV]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 12 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 13 [klasa IV]_2023-24.pdf" title="Task 13 [klasa IV]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 13 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 14 [klasa IV]_2023-24.pdf" title="Task 14 [klasa IV]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 14 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 15 [klasa IV]_2023-24.pdf" title="Task 15 [klasa IV]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 15 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 16 [klasa IV]_2023-24.pdf" title="Task 16 [klasa IV]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 16 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 17 [klasa IV]_2023-24.pdf" title="Task 17 [klasa IV]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 17 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 18 [klasa IV]_2023-24.pdf" title="Task 18 [klasa IV]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 18 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 19 [klasa IV]_2023-24.pdf" title="Task 19 [klasa IV]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 19 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 20 [klasa IV]_2023-24.pdf" title="Task 20 [klasa IV]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 20 [klasa IV]</h2></a>




        <div style="height:20px;"></div>
        <h1 class="trzy">Klasa V [2023/2024]:</h1>
        <a class="taskowe" href="./Task 1 [klasa V]_2023-24.pdf" title="Task 1 [klasa V]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 1 [klasa V]</h2></a>

        <a class="taskowe" href="./Task 2 [klasa V]_2023-24.pdf" title="Task 2 [klasa V]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 2 [klasa V]</h2></a>

        <a class="taskowe" href="./Task 3 [klasa V]_2023-24.pdf" title="Task 3 [klasa V]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 3 [klasa V]</h2></a>

        <a class="taskowe" href="./Task 4 [klasa V]_2023-24.pdf" title="Task 4 [klasa V]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 4 [klasa V]</h2></a>

        <a class="taskowe" href="./Task 5 [klasa V]_2023-24.pdf" title="Task 5 [klasa V]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 5 [klasa V]</h2></a>

        <a class="taskowe" href="./Task 6 [klasa V]_2023-24.pdf" title="Task 6 [klasa V]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 6 [klasa V]</h2></a>

        <a class="taskowe" href="./Task 7 [klasa V]_2023-24.pdf" title="Task 7 [klasa V]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 7 [klasa V]</h2></a>

        <a class="taskowe" href="./Task 8 [klasa V]_2023-24.pdf" title="Task 8 [klasa V]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 8 [klasa V]</h2></a>

        <a class="taskowe" href="./Task 9 [klasa V]_2023-24.pdf" title="Task 9 [klasa V]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 9 [klasa V]</h2></a>

        <a class="taskowe" href="./Task 10 [klasa V]_2023-24.pdf" title="Task 10 [klasa V]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 10 [klasa V]</h2></a>

         <a class="taskowe" href="./Task 11 [klasa V]_2023-24.pdf" title="Task 11 [klasa V]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 11 [klasa V]</h2></a>

         <a class="taskowe" href="./Task 12 [klasa V]_2023-24.pdf" title="Task 12 [klasa V]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 12 [klasa V]</h2></a>

         <a class="taskowe" href="./Task 13 [klasa V]_2023-24.pdf" title="Task 13 [klasa V]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 13 [klasa V]</h2></a>

         <a class="taskowe" href="./Task 14 [klasa V]_2023-24.pdf" title="Task 14 [klasa V]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 14 [klasa V]</h2></a>

         <a class="taskowe" href="./Task 15 [klasa V]_2023-24.pdf" title="Task 15 [klasa V]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 15 [klasa V]</h2></a>

         <a class="taskowe" href="./Task 16 [klasa V]_2023-24.pdf" title="Task 16 [klasa V]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 16 [klasa V]</h2></a>

         <a class="taskowe" href="./Task 17 [klasa V]_2023-24.pdf" title="Task 17 [klasa V]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 17 [klasa V]</h2></a>

         <a class="taskowe" href="./Task 18 [klasa V]_2023-24.pdf" title="Task 18 [klasa V]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 18 [klasa V]</h2></a>

         <a class="taskowe" href="./Task 19 [klasa V]_2023-24.pdf" title="Task 19 [klasa V]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 19 [klasa V]</h2></a>

         <a class="taskowe" href="./Task 20 [klasa V]_2023-24.pdf" title="Task 20 [klasa V]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 20 [klasa V]</h2></a>




        <div style="height:20px;"></div>
        <h1 class="trzy">Klasa VII [2023/2024]:</h1>
        <a class="taskowe" href="./Task 1 [klasa VII]_2023-24.pdf" title="Task 1 [klasa VII]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 1 [klasa VII]</h2></a>

        <a class="taskowe" href="./Task 2 [klasa VII]_2023-24.pdf" title="Task 2 [klasa VII]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 2 [klasa VII]</h2></a>

        <a class="taskowe" href="./Task 3 [klasa VII]_2023-24.pdf" title="Task 3 [klasa VII]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 3 [klasa VII]</h2></a>

        <a class="taskowe" href="./Task 4 [klasa VII]_2023-24.pdf" title="Task 4 [klasa VII]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 4 [klasa VII]</h2></a>

        <a class="taskowe" href="./Task 5 [klasa VII]_2023-24.pdf" title="Task 5 [klasa VII]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 5 [klasa VII]</h2></a>

        <a class="taskowe" href="./Task 6 [klasa VII]_2023-24.pdf" title="Task 6 [klasa VII]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 6 [klasa VII]</h2></a>

        <a class="taskowe" href="./Task 7 [klasa VII]_2023-24.pdf" title="Task 7 [klasa VII]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 7 [klasa VII]</h2></a>

        <a class="taskowe" href="./Task 8 [klasa VII]_2023-24.pdf" title="Task 8 [klasa VII]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 8 [klasa VII]</h2></a>

        <a class="taskowe" href="./Task 9 [klasa VII]_2023-24.pdf" title="Task 9 [klasa VII]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 9 [klasa VII]</h2></a>

        <a class="taskowe" href="./Task 10 [klasa VII]_2023-24.pdf" title="Task 10 [klasa VII]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 10 [klasa VII]</h2></a>

        <a class="taskowe" href="./Task 11 [klasa VII]_2023-24.pdf" title="Task 11 [klasa VII]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 11 [klasa VII]</h2></a>

        <a class="taskowe" href="./Task 12 [klasa VII]_2023-24.pdf" title="Task 12 [klasa VII]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 12 [klasa VII]</h2></a>

        <a class="taskowe" href="./Task 13 [klasa VII]_2023-24.pdf" title="Task 13 [klasa VII]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 13 [klasa VII]</h2></a>

        <a class="taskowe" href="./Task 14 [klasa VII]_2023-24.pdf" title="Task 14 [klasa VII]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 14 [klasa VII]</h2></a>

        <a class="taskowe" href="./Task 15 [klasa VII]_2023-24.pdf" title="Task 15 [klasa VII]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 15 [klasa VII]</h2></a>

        <a class="taskowe" href="./Task 16 [klasa VII]_2023-24.pdf" title="Task 16 [klasa VII]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 16 [klasa VII]</h2></a>

        <a class="taskowe" href="./Task 17 [klasa VII]_2023-24.pdf" title="Task 17 [klasa VII]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 17 [klasa VII]</h2></a>

        <a class="taskowe" href="./Task 18 [klasa VII]_2023-24.pdf" title="Task 18 [klasa VII]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 18 [klasa VII]</h2></a>

        <a class="taskowe" href="./Task 19 [klasa VII]_2023-24.pdf" title="Task 19 [klasa VII]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 19 [klasa VII]</h2></a>

        <a class="taskowe" href="./Task 20 [klasa VII]_2023-24.pdf" title="Task 20 [klasa VII]"
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 20 [klasa VII]</h2></a>



        <div style="height:20px;"></div>
        <h1 class="trzy">Klasa IV:</h1>

        <a class="taskowe" href="./Task 1 [klasa IV].pdf" title="Task 1 [klasa IV]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 1 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 2 [klasa IV].pdf" title="Task 2 [klasa IV]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 2 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 3 [klasa IV].pdf" title="Task 3 [klasa IV]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 3 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 4 [klasa IV].pdf" title="Task 4 [klasa IV]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 4 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 5 [klasa IV].pdf" title="Task 5 [klasa IV]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 5 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 6 [klasa IV].pdf" title="Task 6 [klasa IV]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 6 [klasa IV]</h2></a>
        
        <a class="taskowe" href="./Task 7 [klasa IV].pdf" title="Task 7 [klasa IV]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 7 [klasa IV]</h2></a>
                
        <a class="taskowe" href="./Task 8 [klasa IV].pdf" title="Task 8 [klasa IV]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 8 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 9 [klasa IV].pdf" title="Task 9 [klasa IV]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 9 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 10 [klasa IV].pdf" title="Task 10 [klasa IV]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 10 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 11 [klasa IV].pdf" title="Task 11 [klasa IV]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 11 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 12 [klasa IV].pdf" title="Task 12 [klasa IV]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 12 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 13 [klasa IV].pdf" title="Task 13 [klasa IV]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 13 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 14 [klasa IV].pdf" title="Task 14 [klasa IV]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 14 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 15 [klasa IV].pdf" title="Task 15 [klasa IV]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 15 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 16 [klasa IV].pdf" title="Task 16 [klasa IV]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 16 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 17 [klasa IV].pdf" title="Task 17 [klasa IV]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 17 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 18 [klasa IV].pdf" title="Task 18 [klasa IV]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 18 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 19 [klasa IV].pdf" title="Task 19 [klasa IV]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 19 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 20 [klasa IV].pdf" title="Task 20 [klasa IV]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 20 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 21 [klasa IV].pdf" title="Task 21 [klasa IV]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 21 [klasa IV]</h2></a>

        <a class="taskowe" href="./Task 22 [klasa IV].pdf" title="Task 22 [klasa IV]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 22 [klasa IV]</h2></a>

        <div style="height:20px;"></div>
        <h1 class="trzy">Klasa VIII:</h1>
        <div style="height:20px;"></div>
        <a class="taskowe" href="./Task 1 [klasa VIII].pdf" title="Task 1 [klasa VIII]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 1 [klasa VIII]</h2></a>

        <a class="taskowe" href="./Task 2 [klasa VIII].pdf" title="Task 2 [klasa VIII]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 2 [klasa VIII]</h2></a>

        <a class="taskowe" href="./Task 3 [klasa VIII].pdf" title="Task 3 [klasa VIII]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 3 [klasa VIII]</h2></a>

        <a class="taskowe" href="./Task 4 [klasa VIII].pdf" title="Task 4 [klasa VIII]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 4 [klasa VIII]</h2></a>

        <a class="taskowe" href="./Task 5 [klasa VIII].pdf" title="Task 5 [klasa VIII]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 5 [klasa VIII]</h2></a>

        <a class="taskowe" href="./Task 6 [klasa VIII].pdf" title="Task 6 [klasa VIII]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 6 [klasa VIII]</h2></a>

        <a class="taskowe" href="./Task 7 [klasa VIII].pdf" title="Task 7 [klasa VIII]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 7 [klasa VIII]</h2></a>
        
        <a class="taskowe" href="./Task 8 [klasa VIII].pdf" title="Task 8 [klasa VIII]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 8 [klasa VIII]</h2></a>

        <a class="taskowe" href="./Task 9 [klasa VIII].pdf" title="Task 9 [klasa VIII]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 9 [klasa VIII]</h2></a>

        <a class="taskowe" href="./Task 10 [klasa VIII].pdf" title="Task 10 [klasa VIII]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 10 [klasa VIII]</h2></a>

        <a class="taskowe" href="./Task 11 [klasa VIII].pdf" title="Task 11 [klasa VIII]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 11 [klasa VIII]</h2></a>

        <a class="taskowe" href="./Task 12 [klasa VIII].pdf" title="Task 12 [klasa VIII]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 12 [klasa VIII]</h2></a>

        <a class="taskowe" href="./Task 13 [klasa VIII].pdf" title="Task 13 [klasa VIII]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 13 [klasa VIII]</h2></a>

        <a class="taskowe" href="./Task 14 [klasa VIII].pdf" title="Task 14 [klasa VIII]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 14 [klasa VIII]</h2></a>

        <a class="taskowe" href="./Task 15 [klasa VIII].pdf" title="Task 15 [klasa VIII]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 15 [klasa VIII]</h2></a>

        <a class="taskowe" href="./Task 16 [klasa VIII].pdf" title="Task 16 [klasa VIII]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 16 [klasa VIII]</h2></a>

        <a class="taskowe" href="./Task 17 [klasa VIII].pdf" title="Task 17 [klasa VIII]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 17 [klasa VIII]</h2></a>

        <a class="taskowe" href="./Task 18 [klasa VIII].pdf" title="Task 18 [klasa VIII]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 18 [klasa VIII]</h2></a>

        <a class="taskowe" href="./Task 19 [klasa VIII].pdf" title="Task 19 [klasa VIII]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 19 [klasa VIII]</h2></a>

        <a class="taskowe" href="./Task 20 [klasa VIII].pdf" title="Task 20 [klasa VIII]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 20 [klasa VIII]</h2></a>

        <a class="taskowe" href="./Task 21 [klasa VIII].pdf" title="Task 21 [klasa VIII]" 
        target="_blank" style="text-decoration:none;"><h2 class="trzy" >Task 21 [klasa VIII]</h2></a>

        <a class="taskowe" href="./Task 22 [klasa VIII].pdf" title="Task 22 [klasa VIII]" 
        target="_blank" style="text-decoration:none;"><h2 