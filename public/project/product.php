<?php
$productid = $_GET['id'];
if ($productid == null) {
    header("location: products.php");
    exit();
}
$userid = $_SESSION["userid"];
?>
<head>
<title>Product</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script type="text/javascript">
        $(document).ready(function() {
            var productCount = 0;
            var userid = "<?php echo $userid;?>";
            // var userid = 1;
            
            $("#revbut").click(function() {
                productCount = productCount + 2;
                $("#productreviews").load("load-reviews.php", {
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




<div class="productname">
<?php echo $productname ?>
</div>


    <div class="content">

    <div class="column side">
    <p>leeg</p>
    </div>




<div class="column mid product">


<?php
if ($productimage!=null) {
    $imglink = "productimg/".$productimage;
    ?>
    <img class="productimg" src="<?php echo $imglink; ?>" alt="" >
    <?php
}
?>



<div class="productinfo">
<productprice>$<?php echo $productprice ?></productprice>



<h4>Productbeschrijving:</h4>
<p class="addtocart"><?php echo $productdescription?></p>
<p>id: <?php echo $productid ?></p>
<?php
if ($_SESSION['ismanager']==1) {
    ?>
    <p>Created by <?php echo $productcreator ?></p>
    <?php
}
?><?php
if ($_SESSION['userid']!=null) {
    ?>
    <form class="addtocart" method="post" action="includes/shopping_cart.inc.php">
        <p style="color: green;">Voor 23:59 uur besteld, vrijdag in huis</p>
        <p>In stock: <?php echo $productquantity ?></p>

        <input class="loginform"type="number" name="productq" placeholder="quantity" value="1" min="1">
        <input class="loginform"type="hidden" name="userid" placeholder="userid" value=<?php echo $_SESSION["userid"] ?>>
        <input class="loginform"type="hidden" name="productid" placeholder="productid" value=<?php echo $productid ?>>
        <button type="submit" name="submit">Add to cart</button>
        <ul style="display: block;">
    <li>Inclusief verzendkosten, verstuurd door bol.com</li><br>
    <li>Ophalen bij een bol.com afhaalpunt mogelijk</li><br>
    <li>30 dagen bedenktijd en gratis retourneren</li><br>
    <li>Dag en nacht klantenservice</li><br>
    <li>Doordeweeks ook ’s avonds in huis</li>
</ul>
    </form>
    <?php
}
?>
</div>
</div>
<div>
<h1>Reviews</h1>
<?php
if (isset($_SESSION['useruid'])) {
    date_default_timezone_set("Europe/Amsterdam");
    $time = date('Y-m-d H:i:s');
    echo $time;
    echo '<br>';

?>
<section>
    <form action="includes/review.inc.php" method="POST" enctype="multipart/form-data">
        <input class="loginform"type="text" name="reviewname" placeholder="name review"><br>
        <input class="loginform"type="number" name="stars" min="1" max="5" placeholder="stars"><br>
        <input class="loginform"type="text" name="reviewcontent" placeholder="your review...."><br>
        <input class="loginform"type="hidden" name="userid" placeholder="userid" value=<?php echo $_SESSION["userid"]  ?>><br>
        <input class="loginform"type="hidden" name="productid" placeholder="productid" value=<?php echo $productid ?>><br>
        <input class="loginform"type="hidden" name="time" placeholder="time" value=<?php echo $time ?>><br>
        <input class="loginform"type="file" name="file">
        <button type="submit" name="submit">Add</button>
    </form>
</section><hr>
<?php
}
?>
<div id="productreviews">
</div>
<button id="revbut">see more</button>
</div>
</div>
</div>


<?php
include_once 'footer.php';
?>

