<head>
<title>profile</title>
</head>
<?php
include_once 'header.php';
$productid = $_GET['id'];
if ($_SESSION['ismanager'] !== 1) {
    header("location: ./products.php");
    exit();
}
$productname;
$productprice;
$productdescription;
require('includes/functions.inc.php');
$sql = "SELECT * FROM products WHERE productsId = '" .$productid. "';";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: products.php?error=stmtfailed");
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
        $productid = $row['productsId'];
    }
}
?>

<h1>change <?php echo $productname ?></h1>


<form action="includes/change_product.inc.php" method="POST" enctype="multipart/form-data">
    name: <input type="text" name="name"
    value=
    "<?php
    echo $productname
    ?>"
    ><br>
    price: <input type="number" name="price"
    value=
    "<?php
    echo $productprice
    ?>"
    ><br>
    
    description: <input type="text" name="description"
    value=
    <?php
    echo $productdescription
    ?>
    ><br>

    image: <input type="file" name="file"
    value=
    <?php
    echo $productimage
    ?>
    ><br>
    <input type="hidden" name="id"
    value=
    <?php
    echo $productid
    ?>
    ><br>
    <input type="checkbox" name="delete" value="delete">delete profile image<br>

    <button type="submit" name="submit">Change</button>
</form>

<?php
$imglink = "productimg/".$productimage;
if ($productimage != null) {
    ?>
    current product img
    <img src="<?php echo $imglink; ?>" alt="" height="100" width="100"><br>
    <?php
} else {
    echo 'there is no product image yet<br>';
}
echo 'id:';
echo $productid;
include_once 'footer.php';
?>
