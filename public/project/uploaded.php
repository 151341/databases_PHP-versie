<?php
if (isset($_POST['sumbit'])) {
    $file = $_FILES['file'];
    print_r($file);
    

    // $fileName = $_FILES['file']['name'];
    // $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    if ($fileSize==0) {
        echo 'null';
    }
    // $fileError = $_FILES['file']['error'];
    // $fileType = $_FILES['file']['type'];

    // $fileExt = explode('.', $fileName);
    // $fileActualExt = strtolower(end($fileExt));

    // $allowed = array('jpg','jpeg','png','pdf');

    // if (in_array($fileActualExt, $allowed)) {
    //     if ($fileError === 0) {
    //         if ($fileSize < 2000000) {
    //             $fileNameNew = uniqid('', true).".".$fileActualExt;
    //             $fileDestination = 'productimg/'.$fileNameNew;
    //             move_uploaded_file($fileTmpName,$fileDestination);
    //             header("location: upload.php?uploadsuccess");
    //         }
    //         else {
    //             // header("location: ../signup.php?error=imgtoobig");
    //             // exit();
    //             echo 'file too big';
    //         }
    //     }
    //     else {
    //         header("location: ../signup.php?error=unknown");
    //         exit();
    //     }
    // }
    // else {
    //     echo 'you cannot upload this file';
    // }
}