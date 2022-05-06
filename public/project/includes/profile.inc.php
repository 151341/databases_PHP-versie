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
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg','jpeg','png','pdf');
    if ($fileSize!=0) {
        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 2000000) {
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    $fileDestination = '../profileimg/'.$fileNameNew;
                    move_uploaded_file($fileTmpName,$fileDestination);
                }
                else {
                    header("location: ../profile.php?error=imgtoobig");
                    exit();
                }
            }
            else {
                header("location: ../profile.php?error=unknown");
                exit();
            }
        }
        else {
            echo 'you cannot upload this file';
            header("location: ../profile.php?error=typeunaccept");
            exit();
        }
    }
    if (isset($_POST['delete'])){
        $fileNameNew = null;
    }
    updateUser($conn, $name, $email, $username, $userid, $pwdHashed, $fileNameNew);
}
else {
    header("location: ../profile.php");
    exit();
}
