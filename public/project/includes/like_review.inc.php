<?php
if (isset($_POST["submit"])) {
    require('dbh.inc.php');
    require_once 'functions.inc.php';
    $test = $_POST["submit"];
    echo 'hoi';
    echo $test;
}