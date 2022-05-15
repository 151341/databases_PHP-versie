<head>
    <title>test page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var productCount = 2;
            $("button").click(function() {
                productCount = productCount + 2;
                $("#products").load("load-products.php", {
                    productNewCount: productCount
                });
            });
        });
    </script>
</head>
<?php
include_once 'header.php';
require('includes/functions.inc.php');
require('includes/dbh.inc.php');
if ($conn) {
    $sql = "SELECT * from products limit 2";
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row["productsName"]. "<br>";
        }
    }
}
?>
<div id="products">
</div>
<button>show more products</button>
<?php
include_once 'footer.php';
?>