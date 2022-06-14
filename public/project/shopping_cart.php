<head>
    <title>Shopping cart</title>
</head>
<?php
include_once 'header.php';
if (!isset($_SESSION["useremail"])) {
    header("location: ./products.php");
    exit();
}
?>
<h1>Shopping cart</h1>
<div class="content">
  <div class="column side">
    

</div>

<div class="column mid">
<div class="productinfo">
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
        if (productName($conn, $row['productsId']) == null) {
            deleteFromSC($conn, $row["cartId"]);
        } else {
            echo "<h3>" .productName($conn, $row['productsId']). "</h3>";
            echo "Price: " .idToPrice($conn, $row['productsId']). "<br>";
            echo 'Quantity: '.$row['productQ'] . "<br>";
            ?>
            <form action="includes/change_cart.inc.php"  method="POST">
                Quantity: 
                <input type="number" name="productq" min="1"
                value=
                "<?php
                echo $row['productQ'];
                ?>"
                >
                <input type="hidden" name="cartid" placeholder="cartid" value=<?php echo $row["cartId"] ?>>
                <button type="submit" name="submit">change</button>
    
                
            </form>
            <?php
            echo 'already paid: '.$row['cartOrder'] . "<br>";
            ?>
            <form method="post" action="includes/delete_cart.inc.php">
                <!-- <input type="number" name="productq" placeholder="quantity" value="1" min="1"> -->
                <input type="hidden" name="cartid" placeholder="cartid" value=<?php echo $row["cartId"] ?>>
                <button type="submit" name="submit">Delete</button>
            </form>
            <hr>
            <?php
            $totalPrice = $totalPrice + idToPrice($conn, $row["productsId"]) * $row['productQ'];
        }
        
    }
    ?>
    
    <h1>Total price: <?php echo $totalPrice ?></h1>
</div>
</div>
<div class="column side">

  </div>
</div>

    <?php
}
include_once 'footer.php';
?>