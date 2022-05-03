<?php
if (isset($_POST["submit"])) {
    require('dbh.inc.php');
    require_once 'functions.inc.php';   
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $userid = $_POST["id"];
    $pwdHashed = $_POST["pwd"];
    if (invalidEmail($email) !== false) {
        header("location: ../profile.php?error=invalidemail");
        exit();
    }
    if (emptyInputProfile($name, $email, $username, $pwd, $pwdRepeat) !== false) { 
        header("location: ../profile.php?error=emptyinput");
        exit();
    }
    if (usernameExistsProfile($conn, $username, $userid) !== false) {
        header("location: ../profile.php?error=usernametaken");
        exit();
    }
    if (emailExistsProfile($conn, $email, $userid) !== false) {
        header("location: ../profile.php?error=emailtaken");
        exit();
    }
    updateUser($conn, $name, $email, $username, $userid, $pwdHashed);
}
else {
    header("location: ../profile.php");
    exit();
}
