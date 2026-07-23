<?php

if(isset($_POST["submit"])) {
   $name = $_POST["name"];
//    $email = $_POST["email"];
   $username = $_POST["uid"];
   $pwd = $_POST["pwd"];
   $pwdRepeat = $_POST["pwdrepeat"];
   $nrKlasy = $_POST["nrklasy"];
   $litKlasy = $_POST["litklasy"];
   $gender = $_POST["gender"];

   require_once 'dbh.inc.php';
   require_once 'functions.inc.php';

    if(emptyInputSignup($name/*, $email*/, $username, $pwd, $pwdRepeat, $nrKlasy, $litKlasy) !== false){
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    if(invalidUid($username) !== false){
        header("location: ../signup.php?error=invaliduid");
        exit();
    }
    // if(invalidEmail($email) !== false){
    //     header("location: ../signup.php?error=invalidemail");
    //     exit();
    // }
    if(pwdMatch($pwd, $pwdRepeat) !== false){
        header("location: ../signup.php?error=passwordsdontmatch");
        exit();
    }
    if(uidExists($conn, $username/*, $email*/) !== false){
        header("location: ../signup.php?error=usernametaken");
        exit();
    }
    if(invalidCl($litKlasy) !== false){
        header("location: ../signup.php?error=invalidclassletter");
        exit();
    }
    if(emptyGender($gender)!==false){
        header("location: ../signup.php?error=emptygender");
        exit();
    }

    createUser($conn, $name/*, $email*/, $username, $pwd, $nrKlasy, $litKlasy, $gender);

}
else {
    header("location: ../signup.php");
}