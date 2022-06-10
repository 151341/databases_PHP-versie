<?php
require('includes/functions.inc.php');
require('includes/dbh.inc.php');
$productNewCount = $_POST['productNewCount'];
$userid = $_POST['userid'];

if ($conn) {
    $sql = "SELECT * from products LIMIT $productNewCount";
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // echo $row["productsName"]. "<br>";
            ?>                  
            <div class="producten">
            <?php
                if ($row['productsImage']!=null) {
                    $imglink = "productimg/".$row['productsImage'];
                    ?>
                    <img src="<?php echo $imglink; ?>" alt="" height="150" width="150">
                    <?php
                }
                echo "<h2>". $row['productsName'] . "</h2>";    
                echo "<price>$". $row['productsPrice'] . "</price><br>";  
                if ($_SESSION['ismanager'] === 1) {
                    print '<a href="change_product.php?id=' . $row['productsId'] . '">Change product</a><br>';
                }
                print '<a href="product.php?id=' . $row['productsId'] . '">View product</a>';
                if ($userid!=null) {
                    ?>
                    <form method="post" action="includes/shopping_cart.inc.php">
                        <input class="loginform"type="number" name="productq" placeholder="quantity" value="1" min="1">
                        <input class="loginform"type="hidden" name="userid" placeholder="userid" value=<?php echo $_SESSION["userid"] ?>>
                        <input class="loginform"type="hidden" name="productid" placeholder="productid" value=<?php echo $row['productsId'] ?>>
                        <button class="buttoncard"  type="submit" name="submit">Add to cart</button>
                    </form>
                    <?php
            }
            ?>
            </div>
            <?php
        }
    }
}