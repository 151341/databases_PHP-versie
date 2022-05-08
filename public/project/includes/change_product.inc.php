<?php
if (isset($_POST["submit"])) {
    require('dbh.inc.php');
    require_once 'functions.inc.php';  
    $productname = $_POST["name"];
    $productprice = $_POST["price"];
    $productdescription = $_POST["description"];
    $file = $_FILES["file"];
    $productid = $_POST["id"];
    
    if (emptyInputAddProduct($productname, $productdescription, $productprice) !== false) { 
        header("location: ../change_product.php?id=' . $productid . '");
        exit();
    }
    
    // $fileName = $_FILES['file']['name'];
    // $fileTmpName = $_FILES['file']['tmp_name'];
    // $fileSize = $_FILES['file']['size'];
    // $fileError = $_FILES['file']['error'];
    // $fileType = $_FILES['file']['type'];
    // $fileDelete = isset($_POST['delete']);

    
    // echo $productname;
    // echo '<br>';
    // echo $productprice;
    // echo '<br>';

    // echo $productdescription;
    // echo '<br>';

    // echo $file;
    // echo '<br>';

    // echo $productid;
    
    // updateProduct($conn, $productid, $productname, $productprice, $productdescription, $fileNameNew);
}
else {
    header("location: ../product.php?id=' . $productid . '");
    exit();
}
