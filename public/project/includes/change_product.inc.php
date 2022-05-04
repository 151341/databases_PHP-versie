<?php
if (isset($_POST["submit"])) {
    require('dbh.inc.php');
    require_once 'functions.inc.php';   
    $productname = $_POST["name"];
    $productprice = $_POST["price"];
    $productdescription = $_POST["description"];
    $productid = $_POST["id"];
    
    if (emptyInputAddProduct($productname, $productdescription, $productprice) !== false) { 
        header("location: ../change_product.php?id=' . $productid . '?error=emptyinput");
        exit();
    }
    
    updateUser($conn, $name, $email, $username, $userid, $pwdHashed);
}
else {
    header("location: ../profile.php");
    exit();
}
