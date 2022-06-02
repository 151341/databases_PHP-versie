<?php
if (isset($_POST["submit"])) {
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    $cartid = $_POST["cartid"];
    $sql = "DELETE FROM shopping_cart WHERE cartId ='" .$cartid. "';";
    mysqli_query($conn, $sql);
    header("location: ../shopping_cart.php");
    exit();
}