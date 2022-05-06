<?php
if (isset($_POST["submit"])) {
    require('dbh.inc.php');
    require_once 'functions.inc.php';   
    $productname = $_POST["name"];
    $productprice = $_POST["price"];
    $productdescription = $_POST["description"];
    $file = $_POST["file"];
    $productid = $_POST["id"];
    
    if (emptyInputAddProduct($productname, $productdescription, $productprice) !== false) { 
        header("location: ../change_product.php?id=' . $productid . '?error=emptyinput");
        exit();
    }
    
    updateProduct($conn, $productname, $productprice, $productdescription, $productid, $file);
}
else {
    header("location: ../product.php?id=' . $productid . '");
    exit();
}
