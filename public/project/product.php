<head>
<title>product</title>
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
<hr>
<hr>
<hr>
<h1>reviews</h1>
<?php
if (isset($_SESSION['useruid'])) {
    date_default_timezone_set("Europe/Amsterdam");
    $time = date('Y-m-d H:i:s');
    echo $time;
    echo '<br>';
    echo date("Y-m-d H:i:s");
    echo '<br>';
?>
<section>
    <form action="includes/review.inc.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="reviewname" placeholder="name review"><br>
        <input type="number" name="stars" min="1" max="5" placeholder="stars"><br>
        <input type="text" name="reviewcontent" placeholder="your review...."><br>
        <input type="hidden" name="userid" placeholder="userid" value=<?php echo $_SESSION["userid"]  ?>><br>
        <input type="hidden" name="productid" placeholder="productid" value=<?php echo $productid ?>><br>
        <input type="hidden" name="time" placeholder="time" value=<?php echo $time ?>><br>
        <input type="file" name="file">
        <button type="submit" name="submit">Add</button>
    </form>
</section>
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
        echo countLikesReview($conn, intval($row['reviewsId'])) . " likes <br>";
        echo '<hr>';
        echo '<br>';
    }
}
include_once 'footer.php';
?>

