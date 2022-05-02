<?php
// if (isset($_POST["submit"])) {
//     echo 'hoi';

//     $test = $_POST["foo"];
//     echo $test;
//     $deleteproductid = $_POST["deleteproductid"];
//     if ($_SESSION["ismanager"] === 1) {
//         require_once 'dbh.inc.php';
//         require_once 'functions.inc.php';
//         deleteProduct($conn, $deleteproductid);
//     }
//     else {
//         header("location: ../products.php?error=notallowed");
//         exit();
//     }
// }


if (isset($_POST["submit"])) {
    if ($_POST["delete"] == 'delete') {
        echo 'hoi';
    }
}