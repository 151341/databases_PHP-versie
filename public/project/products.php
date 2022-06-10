<head>
    <title>Products</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var productCount = 0;
            var userid = "<?php echo $_SESSION["userid"];?>";
            // var userid = 1;
            
            $("#prodbut").click(function() {
                productCount = productCount + 2;
                userid = userid;
                $("#products").load("load-products.php", {
                    productNewCount: productCount,
                    userid: userid

                    // productid: $productid
                });
            });
        });
    </script>
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
<h2>All products</h2>
<?php
if ($_SESSION['ismanager'] === 1) {
    ?>
    <a href="add_product.php">add product</a><br>
    <a href="delete_product.php">delete product</a><br>
    <?php
}
?>
<div class="content">
    <div class="column side">
    <p>leeg</p>
    </div>

    <div class="column mid">
        <?php
        require('includes/functions.inc.php');
        $sql = "SELECT * FROM products;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: select.php?error=stmtfailed");
            exit();
        }
        ?>
        <div class="productengalerij">
            <?php
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            
            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>                  
                    <div class="producten">
                        <?php
                        if ($row['productsImage']!=null) {
                            $imglink = "productimg/".$row['productsImage'];
                            ?>
                            <img src="<?php echo $imglink; ?>" alt="" height="150" width="150">
                            <?php
                        }
                        echo "<h3>". $row['productsName'] . "</h3>";    
                        echo "<price>$". $row['productsPrice'] . "</price><br>";  
                        if ($_SESSION['ismanager'] === 1) {
                            print '<a href="change_product.php?id=' . $row['productsId'] . '">Change product</a><br>';
                        }
                        print '<a href="product.php?id=' . $row['productsId'] . '">View product</a>';
                        if ($_SESSION['userid']!=null) {
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
            ?>
        </div>
    </div>

    <div class="column side">
    <p>leeg</p>
    </div>
</div>
<div id="products"></div>
<!-- <button id="prodbut">see more</button> -->


<?php
include_once 'footer.php'
?>
