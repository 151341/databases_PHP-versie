<head>
<title>profile</title>
</head>
<?php
include_once 'header.php';
$productid = $_GET['id'];
$productname;
$productprice;
$productdescription;
require('includes/functions.inc.php');
$sql = "SELECT * FROM products WHERE productsId = '" .$productid. "';";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: products.php?error=stmtfailed");
    // change later!!!
    exit();
}
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck == 1) {
    while ($row = mysqli_fetch_assoc($result)) {
        // echo "<br>". $row['productsName'] . "<br>";
        $productname = $row['productsName'];
        $productprice = $row['productsPrice'];
        $productdescription = $row['productsDescription'];
        $productimage = $row['productsImage'];
    }
}
?>

<h1><?php echo $productname ?></h1>
<p><?php echo $productdescription ?></p>
<p>$<?php echo $productid ?></p>
<p><?php echo $productimage ?></p>
<?php
if ($productimage!=null) {
    $imglink = "productimg/".$productimage;
    echo $imglink. "<br>";
    ?>
    <img src="<?php echo $imglink; ?>" alt="" height="100" width="100">
    <?php
}

include_once 'footer.php';
?>

