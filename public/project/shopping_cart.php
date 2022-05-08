<head>
    <title>shopping cart</title>
</head>
<?php
include_once 'header.php';
?>
<h1>shopping cart</h1>
<?php
require('includes/functions.inc.php');
$sql = "SELECT * FROM shopping_cart WHERE usersId = '" .$_SESSION['userid']. "';";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: select.php?error=stmtfailed");
    exit();
}
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0) {
    while ($row = mysqli_fetch_assoc($result)) {       
        echo "product:" .productName($conn, $row['productsId']). "<br>";
        echo 'quantity: '.$row['productQ'] . "<br>";
        echo 'already paid: '.$row['cartOrder'] . "<br>";
        echo '<br>';
    }
}



include_once 'footer.php';
?>