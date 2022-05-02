<head>
    <title>products</title>
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
<h1>all products</h1>
<a href="add_product.php">add product</a><br>


<?php

require('includes/functions.inc.php');
$sql = "SELECT * FROM products;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: select.php?error=stmtfailed");
    exit();
}
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0) {
    ?>
    <section>
        <form action="includes/delete_product.inc.php" method="POST">
            <input type="checkbox" id="delete" name="delete" value="delete" />
            <label for="delete"> test</label><br />
            <button class="btn btn--main" type="submit">Submit</button>
        </form>
    </section>
    <?php
}

include_once 'footer.php'
?>
