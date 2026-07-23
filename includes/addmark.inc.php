<?php

if(isset($_POST["submit"])) {
   $mark = array($_POST["k1"]);


   require_once 'dbh.inc.php';
   require_once 'functions.inc.php';

   addMark($conn, $mark, $x);

}
else {
    header("location: ../profil.php");
}
?>