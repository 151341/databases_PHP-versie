<?php
if (isset($_POST["submit"])) {
    require('dbh.inc.php');
    require_once 'functions.inc.php';  
    $productname = $_POST["name"];
    $productprice = $_POST["price"];
    $productdescription = $_POST["description"];
    $productquantity = $_POST["stock"];
    $file = $_POST["file"];
    // $file = $_FILES["file"];
    $productid = $_POST["id"];
    
    if (emptyInputAddProduct($productname, $productdescription, $productprice) !== false) { 
        header("location: ../index.php");
        // header("location: ../change_product.php?id=' . $productid . '");
        exit();
    }
    
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];
    $fileDelete = isset($_POST['delete']);
    // updateProduct($conn, $productid, $productname, $productprice, $productdescription, $fileNameNew);
    updateProduct2($conn, $productname, $productprice, $productdescription,$productquantity, $productid,$fileName, $fileTmpName, $fileSize, $fileError, $fileDelete);

}
else {
    header("location: ../change_product.php?id=' . $productid . '");
    exit();
}
