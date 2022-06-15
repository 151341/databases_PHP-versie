<head>
    <title>Delete products</title>
</head>
<?php
include_once 'header.php';
if ($_SESSION['ismanager'] !== 1) {
    header("location: ./products.php");
    exit();
}
?>
<?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == "none") {
        echo "product was succesfully inserted";
    }
}
?>
<h2>Delete products</h2>

<div class="content">
  <div class="column side">
    

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
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0) {?>
    <section>
        <form action="includes/delete_product.inc.php" method="POST">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <input type="checkbox" 
                
                id='products'
                name="products[]" 

                value=
                "<?php
                echo $row["productsName"] 
                ?>"
                />

                <label
                for='products'
                >
                    <?php
                    echo $row['productsName'] . "<br>";
                    ?>
                </label><br />
                <?php
            }
            ?>
            <button type="submit" name="submit">Delete</button>
        </form>
    </section>
</div>

<div class="column side">

  </div>
</div>

<?php
}
include_once 'footer.php'
?>
