<?php
require('includes/functions.inc.php');
require('includes/dbh.inc.php');
$productNewCount = $_POST['productNewCount'];
if ($conn) {
    // echo 'success';
    $sql = "SELECT * FROM reviews LIMIT $productNewCount";
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0) {
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

            if ($_SESSION["useruid"]=!null) {
            ?>
            <form action="includes/like_review.inc.php" method="POST">
                <input type="hidden" name="userid" placeholder="userid" value=<?php echo $_SESSION["userid"]  ?>>
                <input type="hidden" name="reviewid" placeholder="reviewid" value=<?php echo $row["reviewsId"] ?>>
                <input type="hidden" name="productid" placeholder="productid" value=<?php echo $productid ?>>
                
                <?php
                echo 'revid '. $row['reviewsId'] .'<br>';
                echo "<p>userid:  " . $_SESSION["userid"] . "</p>";
                if (isLiked($conn, $row['reviewsId'], $_SESSION["userid"])) {
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
}