<?php
if (isset($_POST["submit"])) {
    require('dbh.inc.php');
    require_once 'functions.inc.php';   
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $userid = $_POST["id"];
    $pwdHashed = $_POST["pwd"];
    $file = $_POST["file"];
    

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
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $fileDelete = isset($_POST['delete']);

    // echo $name. '<br>';
    // echo $email. '<br>';
    // echo $username. '<br>';
    // echo $userid. '<br>';
    // echo $pwdHashed. '<br>';
    // echo $file;
    // if ($fileSize!=0) {
    //     echo $file. '<br>';
    //     echo $fileName. '<br>';
    //     echo $fileTmpName. '<br>';
    //     echo $fileSize. '<br>';
    //     echo $fileError. '<br>';
    //     echo $fileType. '<br>';
    //     echo $fileDelete. '<br>';    
        
    // }
    // if ($fileDelete!=true) {
    //     echo 'not delete';
    // }
    updateUser($conn, $name, $email, $username, $userid, $pwdHashed, $fileName, $fileTmpName, $fileSize, $fileError, $fileDelete);
}
else {
    header("location: ../profile.php");
    exit();
}
