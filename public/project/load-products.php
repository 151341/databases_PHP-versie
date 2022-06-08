<?php
require('includes/functions.inc.php');
require('includes/dbh.inc.php');
$productNewCount = $_POST['productNewCount'];
if ($conn) {
    // echo 'success';
    $sql = "SELECT * from reviews LIMIT $productNewCount";
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row["reviewsName"]. "<br>";
        }
    }
}