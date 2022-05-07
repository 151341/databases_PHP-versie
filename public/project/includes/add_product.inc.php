<?php

if (isset($_POST["submit"])) {
    $productname = $_POST["productname"];
    $productdesc = $_POST["productdesc"];
    $price = $_POST["price"];
    $adderid = intval($_SESSION['userid']);

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputAddProduct($productname, $productdesc, $price) !== false) { 
        header("location: ../add_product.php?error=emptyinput");
        exit();
    }
    if (invalidProductName($productname) !== false) {
        header("location: ../add_product.php?error=invalidproductname");
        exit();
    }
    if (productNameExists($conn, $productname) !== false) {
        header("location: ../add_product.php?error=productnametaken");
        exit();
    }
    $file = $_FILES['file'];
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
                    $fileDestination = '../productimg/'.$fileNameNew;
                    move_uploaded_file($fileTmpName,$fileDestination);
    
                }
                else {
                    header("location: ../add_product.php?error=imgtoobig");
                    exit();
                }
            }
            else {
                header("location: ../add_product.php?error=unknown");
                exit();
            }
        }
        else {
            echo 'you cannot upload this file';
            header("location: ../add_product.php?error=typeunaccept");
            exit();
        }
    }
    





    
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
    //             $profile_image_destination = 'productimg/'.$profile_image_name_new;
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



    
    // if (notInt($price) !== false){
    //     header("location: ../add_product.php?error=notint");
    //     exit();
    // }
    // if (invalidImage($profile_image) !== false) {
    //     header("location: ../signup.php?error=invalidimage");
    //     exit();
    // }
    
    createProduct($conn, $productname, $price, $adderid, $productdesc, $fileNameNew);
}
else {
    header("location: ../add_product.php");
    exit();
}
