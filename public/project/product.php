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
        $productquantity = $row['productsQuantity'];
        $productimage = $row['productsImage'];
        $productid = $row['productsId'];


        $productcreator;
        $sql = "SELECT * FROM users WHERE usersId = '" .$row['productAddedByUserId']. "';";
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
                $productcreator = $row['usersEmail'];
            }
        }
    }
}
?>

<h1><?php echo $productname ?></h1>
<p><?php echo $productdescription ?></p>
<p>$<?php echo $productprice ?></p>
<p>in stock: <?php echo $productquantity ?></p>
<p>id: <?php echo $productid ?></p>
<p><?php echo $productimage ?></p>
<p>created by <?php echo $productcreator ?></p>

<?php
if ($productimage!=null) {
    $imglink = "productimg/".$productimage;
    echo $imglink. "<br>";
    ?>
    <img src="<?php echo $imglink; ?>" alt="" height="100" width="100">
    <?php
}
?>
<h1>reviews</h1>
<?php
$sql = "SELECT * FROM reviews WHERE productsId='" . $productid . "';";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: products.php?error=stmtfailed");
    exit();
}
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<br>". $row['reviewsName'] . "<br>";
    }
}
include_once 'footer.php';
?>

