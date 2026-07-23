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
        <ul>
        <li><a href='profil.php'>Twój profil[sem II]</a></li>
        <li><a href='profilsem1.php'>Profil[sem I]</a></li>
        <li><a href='oceny.php'>Twoje oceny[sem II]</a></li>
        <li><a href='ocenysem1.php'>Oceny[sem I]</a></li>
        <li><a href='https://eduone.pl/bialystok' target="_blank">Dziennik elektroniczny</a></li>
        <li><a href='matlandia.php'>Matlandia</a></li>
        <li><a href='./PSO MATEMATYKA 2023_2024.pdf' target="_blank">PSO</a></li>
        <li><a href='index.php'>Powrót</a></li>
        </ul>
          <div class="pusty">
          &nbsp
        ?>
                </div>
        <div id="newsy">
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
        echo "<a href='./Task 20 [klasa IV]_2023-24.pdf' title='Task 20'
        target='_blank' style='text-decoration:none;'><h2 class='trzy' >Task 20 [do 13 czerwca 16:00]</h2></a>";
        }
        else if($nrKl=='5'){
          echo "<a href='./Task 20 [klasa V]_2023-24.pdf' title='Task 20'
          target='_blank' style='text-decoration:none;'><h2 class='trzy' >Task 20 [do 13 czerwca 16:00]</h2></a>";
        }else if($nrKl=='7'){
          echo "<a href='./Task 20 [klasa VII]_2023-24.pdf' title='Task 20'
          target='_blank' style='text-decoration:none;'><h2 class='trzy' >Task 20 [do 13 czerwca 16:00]</h2></a>";
        }

        else if($nrKl=='8'){
          echo "<a href='./Task 22 [klasa VIII].pdf' title='Task 22' 
          target='_blank' style='text-decoration