<?php

function emptyInputSignup($name/*, $email*/, $username, $pwd, $pwdRepeat, $nrKlasy, $litKlasy) {
    $result;
    if(empty($name) /* || empty($email) */ || empty($username) || empty($pwd) || empty($pwdRepeat) || empty($nrKlasy) || empty($litKlasy)) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function emptyGender($gender) {
    $result;
    if($gender === "M" || $gender === "K") {
        $result = false;
    }
    else {
        $result = true;
    }
    return $result;
}

function invalidUid($username) {
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function invalidCl($cl) {
    $result;
    if(!preg_match("/^[0-9A-Z]*$/", $cl)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}


// function invalidEmail($email) {
//     $result;
//     if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//         $result = true;
//     }
//     else{
//         $result = false;
//     }
//     return $result;
// }


function pwdMatch($pwd, $pwdRepeat) {
    $result;
    if($pwd !== $pwdRepeat) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}


function uidExists($conn, $username/*, $email*/) {
    $sql = "SELECT * FROM users WHERE usersUid = ? /* OR usersEmail = ?*/;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $username /*, $email*/);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);

}


function createUser($conn, $name/*, $email*/, $username, $pwd, $nrKlasy, $litKlasy, $gender) {
    $sql = "INSERT INTO users (usersName /*, usersEmail*/, usersUid, usersPwd, nrklasy, litklasy, gender) 
    VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    // $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssiss", $name/*, $email*/, $username,/*$hashedPwd*/
     $pwd, $nrKlasy, $litKlasy, $gender);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
    exit();
}

// function addMark($conn, $mark, $x){
        
//     $sql = "UPDATE ocenysem1 SET kart1 = ? WHERE usersId =$x;";
    

//     $stmt = mysqli_stmt_init($conn);

//     if(!mysqli_stmt_prepare($stmt, $sql)){
//         header("location: ../profil.php?error=stmtfailed");
//         exit();
//     }

//     mysqli_stmt_bind_param($stmt, "s", $mark);
//     mysqli_stmt_execute($stmt);

//     mysqli_stmt_close($stmt);
//     header("location: ../profil.php?error=none");
//     exit();
// }

function emptyInputLogin($username, $pwd) {
    $result;
    if(empty($username) || empty($pwd)) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function loginUsers($conn, $username, $pwd) {
$uidExists = uidExists($conn, $username/*, $username*/);

    if($uidExists === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    /* $pwdHashed */ $pass = $uidExists["usersPwd"];
    // $checkPwd = password_verify($pwd, $pwdHashed);

    if($pwd !== $pass) {
        header("location: ../login.php?error=wrongpwd");
        exit();
    }
    else if($pwd === $pass) { 
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["useruid"] = $uidExists["usersUid"];

        header("location: ../index.php");
        exit();

    }
}

function zwrocOcene($pct){
    if($pct<30){return "1";}
    else if($pct>=30 && $pct<33){return "1+";}
    else if($pct===33) {return "2-";}
    else if($pct>33 && $pct<45){return "2";}
    else if($pct>=45 && $pct<50){return "2+";}
    else if($pct===50){return "3-";}
    else if($pct>50 && $pct<65){return "3";}
    else if($pct>=65 && $pct<70){return "3+";}
    else if($pct===70){return "4-";}
    else if($pct>70 && $pct<80){return "4";}
    else if($pct>=80 && $pct<85){return "4+";}
    else if($pct===85){return "5-";}
    else if($pct>85 && $pct<=90){return "5";}
    else if($pct>=91 && $pct<=95){return "5+";}
    else if($pct>=96 && $pct<=97){return "6-";}
    else if($pct>=98 && $pct<=100){return "6";}
}

function wartOceny($mark){
    if($mark === "1"){return 1 ;}
    else if($mark === "1+"){return 1.5 ;}
    else if($mark === "2-") {return 1.75;}
    else if($mark === "2"){return 2;}
    else if($mark === "2+"){return 2.5;}
    else if($mark === "3-"){return 2.75;}
    else if($mark === "3"){return 3;}
    else if($mark === "3+"){return 3.5;}
    else if($mark === "4-"){return 3.75;}
    else if($mark === "4"){return 4;}
    else if($mark === "4+"){return 4.5;}
    else if($mark === "5-"){return 4.75;}
    else if($mark === "5"){return 5;}
    else if($mark === "5+"){return 5.5;}
    else if($mark === "6-"){return 5.75;}
    else if($mark === "6"){return 6;}
}

function wartSredniej($average){
    if($average < 1.60){return "niedostateczny (1)" ;}
    else if($average >= 1.60 && $average < 2.60){return "dopuszczający (2)" ;}
    else if($average >= 2.60 && $average < 3.60){return "dostateczny (3)" ;}
    else if($average >= 3.60 && $average < 4.60){return "dobry (4)" ;}
    else if($average >= 4.60 && $average < 5.50){return "bardzo dobry (5)" ;}
    else if($average >= 5.50){return "celujący (6)" ;}
}