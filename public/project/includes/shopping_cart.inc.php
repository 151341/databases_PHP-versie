<?php
if (isset($_POST["submit"])) {
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    $userid = $_POST["userid"];
    $productid = $_POST["productid"];
    $productq = $_POST["productq"];
    if ($productq==null) {
        header("location: ../product.php?id=' . $productid. '");
        exit();
    }
    else {
        addToShoppingCart($conn, $userid, $productid, $productq);
        // echo 'hoi';
    }
}