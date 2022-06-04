<?php
if (isset($_POST["submit"])) {
    require('dbh.inc.php');
    require_once 'functions.inc.php';   
    $cartid = $_POST["cartid"];
    $productq = $_POST["productq"];

    echo $cartid;
    echo $productq;
    $sql = "UPDATE shopping_cart SET productQ='" . $productq . "' WHERE cartId='" .$cartid. "' ";
    mysqli_query($conn, $sql);
    header("location: ../shopping_cart.php");
    exit();
}
else {
    header("location: ../shopping_cart.php");
    exit();
}
