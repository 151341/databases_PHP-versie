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