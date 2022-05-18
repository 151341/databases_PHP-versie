<?php
if ($_POST["like"]) {
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    $userid = $_POST["userid"];
    $reviewid = $_POST["reviewid"];
    $productid = $_POST["productid"];
    likeReview($conn, $reviewid, $userid, $productid);
}