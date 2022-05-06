<head>
    <title>products</title>
</head>
<?php
include_once 'header.php';
?>
<?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == "none") {
        echo "product was succesfully inserted";
    }
}
?>
<h1>all products</h1>
<?php
if ($_SESSION['ismanager'] === 1) {
    ?>
    <a href="add_product.php">add product</a><br>
    <a href="delete_product.php">delete product</a><br>
    <?php
}
?>


<?php
require('includes/functions.inc.php');
$sql = "SELECT * FROM products;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: select.php?error=stmtfailed");
    exit();
}
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<br>". $row['productsName'] . "<br>";  
        if ($_SESSION['ismanager'] === 1) {
            print '<a href="change_product.php?id=' . $row['productsId'] . '">Change product</a>';
        }
        print '<a href="product.php?id=' . $row['productsId'] . '">View product</a>';
    }
}
include_once 'footer.php'
?>
