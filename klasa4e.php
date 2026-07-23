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
    <style>
table, th, td {
  border: 1px solid;
}

table {
  width: 100%;
}
</style>
    <body>
    <div class="obrazek2">
            <img src="niebo2.jpg" style="width:100%; height:100%;">
            <div class="centered3">Mathemati(x)</div>
        </div>
        <ul>
        <li><a href='oceny.php'>Twoje oceny</a></li>
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
                require_once 'includes/functions.inc.php';

                if($userId == "1"){
        echo "<ul>
        <li><a href='klasa4a.php'>Klasa IV A</a></li>
        <li><a href='klasa4c.php'>Klasa IV C</a></li>
        <li><a href='klasa4e.php'>Klasa IV E</a></li>
        <li><a href='klasa8a.php'>Klasa VIII A</a></li>
        <li><a href='klasa8b.php'>Klasa VIII B</a></li>
        <li><a href='klasa8d.php'>Klasa VIII D</a></li>
        </ul>";
                }
        ?>
        <div id="newsy" style="background-color: rgba(255, 255, 255, 1);width:100%;">
        <?php
echo "<h2>Klasa 4E - DZIENNIK</h2>";
echo "<table>
  <tr>
    <th>Name</th>
    <th>K1</th>
    <th>K2</th>
    <th>K3</th>
    <th>K4</th>
    <th>K5</th>
    <th>K6</th>
    <th>K7</th>
    <th>K8</th>
    <th>Klas1</th>
    <th>Klas2</th>
    <th>A1</th>
    <th>A2</th>
    <th>A3</th>
    <th>A4</th>
    <th>A5</th>
    <th>A6</th>
    <th>A7</th>
    <th>A8</th>
    <th>A9</th>
    <th>A10</th>
    <th>A11</th>
    <th>Mat1</th>
    <th>Mat2</th>
    <th>Mat3</th>
    <th>Mat4</th>
    <th>Mat5</th>
    <th>Mat6</th>
    <th>Lekcja</th>
    <th>AkDod</th>
    <th>Wkm</th>
    <th>Alfik</th>
    <th>Pd1</th>  
    <th>Pd2</th>  
    <th>Pd3</th>
  </tr>";   
  for($x=119; $x<=146; $x++){
    if($x==138 || $x ==145) continue;
                $userquery = mysqli_query($conn, "SELECT * FROM users WHERE usersId =$x");
                while($row = mysqli_fetch_assoc($userquery)){
                    $name = $row["usersName"];
                    $uname = $row["usersUid"];
                    $nrKl = $row["nrKlasy"];
                    $litKl = $row["litKlasy"];
                }
                $usersquery = mysqli_query($conn, "SELECT * FROM ocenysem1 WHERE usersId =$x");
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
            


echo "<tr>
<td>". $name ."</td>
<td>". $kart1 ."</td>
<td>". $kart2 ."</td>
<td>". $kart3 ."</td>
<td>". $kart4 ."</td>
<td>". $kart5 ."</td>
<td>". $kart6 ."</td>
<td>". $kart7 ."</td>
<td>". $kart8 ."</td>
<td>". $klas1 ."</td>
<td>". $klas2 ."</td>
<td>". $akt1 ."</td>
<td>". $akt2 ."</td>
<td>". $akt3 ."</td>
<td>". $akt4 ."</td>
<td>". $akt5 ."</td>
<td>". $akt6 ."</td>
<td>". $akt7 ."</td>
<td>". $akt8 ."</td>
<td>". $akt9 ."</td>
<td>". $akt10 ."</td>
<td>". $akt11 ."</td>
<td>". $mat1 ."</td>
<td>". $mat2 ."</td>
<td>". $mat3 ."</td>
<td>". $mat4 ."</td>
<td>". $mat5 ."</td>
<td>". $mat6 ."</td>
<td>". $lekcja ."</td>
<td>". $aktdod ."</td>
<td>". $wkm ."</td>
<td>". $alfik ."</td>
<td>". $brakpd1 ."</td>
<td>". $brakpd2 