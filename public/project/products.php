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
<a href="add_product.php">add product</a>

<?php
include_once 'footer.php'
?>