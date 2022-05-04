<?php
if (isset($_POST["submit"])) {
    require('dbh.inc.php');
    require_once 'functions.inc.php';  
    if (!empty($_POST["products"])) {
        $deleted_products = $_POST["products"];
        foreach ($deleted_products as $deleted_product){
            deleteProduct($conn, $deleted_product);          
        }
    header("location: ../products.php");
    exit();
    }
}
