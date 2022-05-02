<?php
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];
    
    // $profile_image = $_FILES["file"]; 

    // $profile_image_name = $_FILES['file']['name'];
    // $profile_image_tmpname = $_FILES['file']['tmp_name'];
    // $profile_image_size = $_FILES['file']['size'];
    // $profile_image_error = $_FILES['file']['error'];
    // $profile_image_type = $_FILES['file']['type'];

    // $profile_image_ext = explode('.', $profile_image_name);
    // $profile_image_actualext = strtolower(end($profile_image_ext));

    // $allowed = array('jpg','jpeg','png','pdf');

    // if (in_array($profile_image_actualext, $allowed)) {
    //     if ($profile_image_error === 0) {
    //         if ($profile_image_size < 1000000) {
    //             $profile_image_name_new = uniqid('', true).".".$profile_image_actualext;
    //             $profile_image_destination = 'uploads/'.$profile_image_name_new;
    //             move_uploaded_file($profile_image_tmpname,$profile_image_destination);
    //             // header("location: ../index.php?uploadsuccess");
    //         }
    //         else {
    //             header("location: ../signup.php?error=imgtoobig");
    //             exit();
    //         }
    //     }
    //     else {
    //         header("location: ../signup.php?error=unknown");
    //         exit();
    //     }
    // }
    // else {
    //     header("location: ../signup.php?error=typeunaccepted");
    //     exit();
    // }



    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) !== false) { 
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    if (invalidUid($username) !== false) {
        header("location: ../signup.php?error=invaliduid");
        exit();
    }
    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidemail");
        exit();
    }
    if (pwdMatch($pwd, $pwdRepeat) !== false) {
        header("location: ../signup.php?error=pwdnotmatch");
        exit();
    }
    if (usernameExists($conn, $username) !== false) {
        header("location: ../signup.php?error=usernametaken");
        exit();
    }
    if (emailExists($conn, $email) !== false) {
        header("location: ../signup.php?error=emailtaken");
        exit();
    }


    // if (invalidImage($profile_image) !== false) {
    //     header("location: ../signup.php?error=invalidimage");
    //     exit();
    // }
    
    createUser($conn, $name, $email, $username, $pwd);
}
else {
    header("location: ../signup.php");
    exit();
}