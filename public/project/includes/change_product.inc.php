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
        header("location: ../change_product.php?id=' . $productid . '?error=emptyinput");
        exit();
    }
    echo $productname;
    echo '<br>';
    echo $productprice;
    echo '<br>';

    echo $productdescription;
    echo '<br>';

    echo $file;
    echo '<br>';

    echo $productid;
    
    updateProduct($conn, $productid, $productname, $productprice, $productdescription, $file);
}
else {
    header("location: ../product.php?id=' . $productid . '");
    exit();
}
