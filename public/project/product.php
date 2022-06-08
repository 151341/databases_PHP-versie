<head>
<title>Product</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script>
        $(document).ready(function() {
            var productCount = 0;
            $("#revbut").click(function() {
                productCount = productCount + 2;
                $("#testreviews").load("load-reviews.php", {
                    productNewCount: productCount
                });
            });
        });
    </script>
</head>
<?php
include_once 'header.php';
$productid = $_GET['id'];
if ($productid == null) {
    header("location: products.php");
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



<div id="testreviews">
</div>
<button id="revbut">see more</button>
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
    <p>In stock: <?php echo $productquantity ?></p>
        <input class="loginform"type="number" name="productq" placeholder="quantity" value="1" min="1">
        <input class="loginform"type="hidden" name="userid" placeholder="userid" value=<?php echo $_SESSION["userid"] ?>>
        <input class="loginform"type="hidden" name="productid" placeholder="productid" value=<?php echo $productid ?>>
        <button type="submit" name="submit">Add to cart</button>
    </form>
    <?php
}
?>
</div>


</div>
<div class="productreviews">

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
        echo $row['reviewsName'] . "<br>";
        echo 'by ' .returnEmail($conn,$row["usersId"]). '<br>';
        $imglink = "reviewimg/".$row['reviewsImage'];
        if ($row['reviewsImage'] != null) {
            ?>
            <img src="<?php echo $imglink; ?>" alt="" height="100" width="100"><br>
            <?php
        }
        
        echo $row['reviewsContent'] . "<br>";
        echo "date: ". $row['reviewsDate'] . "<br>";
        echo 'productsid: '. intval($row['productsId']) . "<br>";
        echo 'reviewssid: '. intval($row['reviewsId']) . "<br>";
        echo 'stars: '. $row['stars'] . "<br>";
        if (isset($_SESSION["useruid"])) {
        ?>
        <form action="includes/like_review.inc.php" method="POST">
            <input type="hidden" name="userid" placeholder="userid" value=<?php echo $_SESSION["userid"]  ?>><br>
            <input type="hidden" name="reviewid" placeholder="reviewid" value=<?php echo $row["reviewsId"] ?>><br>
            <input type="hidden" name="productid" placeholder="productid" value=<?php echo $productid ?>><br>
            <?php
            if (isLiked($conn, $row['reviewsId'], $_SESSION["userid"])){
                ?>
                <button type="submit" class="button" name="unlike" value="unlike">Unlike</button>
                <?php
            } else {
                ?>
                <button type="submit" class="button" name="like" value="like">Like</button>
                <?php
            }
            ?>

        </form>
        <?php
        }
        echo countLikesReview($conn, intval($row['reviewsId'])) . " likes <br>";
        echo '<hr>';
        echo '<br>';
    }
}
?>

</div>
</div>
</div>


<?php
include_once 'footer.php';
?>

