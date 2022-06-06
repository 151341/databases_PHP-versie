<head>
    <title>test page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script>
        // $(document).ready(function() {
        //     var productCount = 2;
        //     $("button").click(function() {
        //         productCount = productCount + 2;
        //         $("#products").load("load-products.php", {
        //             productNewCount: productCount
        //         });
        //     });
        // });
    </script>
</head>
<?php
$productname;
$productprice;
$productdescription;

include_once 'header.php';
require('includes/functions.inc.php');
require('includes/dbh.inc.php');

$sql = "SELECT * FROM products WHERE productsId = (SELECT MAX(productsId) FROM products)";
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

    
}

<!-- // if ($conn) {
//     $sql = "SELECT * from products limit 2";
//     $result = mysqli_query($conn,$sql);
//     if (mysqli_num_rows($result) > 0) {
//         while ($row = mysqli_fetch_assoc($result)) {
//             echo $row["productsName"]. "<br>";
//         }
//     }
// }
?> -->
<div id="products">
</div>
<button>show more products</button>
<?php
include_once 'footer.php';
?>