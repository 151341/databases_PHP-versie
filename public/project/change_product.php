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
    }
}
?>

<h1>change <?php echo $productname ?></h1>


<form action="includes/change_product.inc.php" method="POST">
    name: <input type="text" name="name"
    value=
    "<?php
    echo $productname
    ?>"
    ><br>
    price: <input type="number" name="price"
    value=
    <?php
    echo $productprice
    ?>
    ><br>
    description: <input type="text" name="description"
    value=
    <?php
    echo $productdescription
    ?>
    ><br>
    <input type="hidden" name="id"
    value=
    <?php
    echo $productid
    ?>
    ><br>
    <button type="submit" name="submit">Change</button>

</form>
<?php
echo "<p>userid:  " . $_SESSION["userid"] . "</p>";
echo "<p>name:  " . $_SESSION["username"] . "</p>";
echo "<p>username:  " . $_SESSION["useruid"] . "</p>";
echo "<p>email:  " . $_SESSION["useremail"] . "</p>";
echo "<p>profile image:  " . $_SESSION["profileimg"] . "</p>";

if ($_SESSION["ismanager"] === 1) {
echo "you are a manager";
}
include_once 'footer.php';
?>

