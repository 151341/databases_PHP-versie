<?php

if (isset($_POST["submit"])) {
    $reviewname = $_POST["reviewname"];
    $reviewTime = $_POST["time"];
    $stars = $_POST["stars"];
    $reviewcontent = $_POST["reviewcontent"];
    $userid = $_POST["userid"];
    $productid = $_POST["productid"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputAddProduct($reviewname, $stars, $reviewcontent) !== false) { 
        header("location: ../product.php?id=' . $productid . '");
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
                    $fileDestination = '../reviewimg/'.$fileNameNew;
                    move_uploaded_file($fileTmpName,$fileDestination);
    
                }
                else {
                    header("location: ../product.php?id=' . $productid . '");
                    exit();
                }
            }
            else {
                header("location: ../product.php?id=' . $productid . '");
                exit();
            }
        }
        else {
            echo 'you cannot upload this file';
            header("location: ../product.php?id=' . $productid . '");
            exit();
        }
    }
    // echo $fileNameNew;
    createReview($conn, $reviewname, $stars, $reviewTime, $reviewcontent, $userid, $productid, $fileNameNew);
    // change later!!
    header("location: ../product.php?id=' . $productid . '");
    exit();
}
else {
    header("location: ../add_product.php");
    exit();
}
