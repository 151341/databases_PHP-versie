<head>
    <title>test page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var productCount = 0;
            $("#revbut").click(function() {
                productCount = productCount + 2;
                $("#reviewsdiv").load("load-products.php", {
                    productNewCount: productCount
                });
            });
        });
    </script>
</head>

<div id="reviewsdiv">
</div>
<button id="revbut">show more products</button><br>
<!--
// require('includes/dbh.inc.php');

// $sql = "SELECT * FROM products WHERE productsId = (SELECT MAX(productsId) FROM products)";
// $stmt = mysqli_stmt_init($conn);
// if (!mysqli_stmt_prepare($stmt, $sql)) {
//     header("location: products.php?error=stmtfailed");
//     // change later!!!
//     exit();
// }
// $result = mysqli_query($conn, $sql);
// $resultCheck = mysqli_num_rows($result);
// if ($resultCheck == 1) {
//     while ($row = mysqli_fetch_assoc($result)) {
//         $productname = $row['productsName'];
//         $productprice = $row['productsPrice'];
//         $productdescription = $row['productsDescription'];
//         $productquantity = $row['productsQuantity'];
//         $productimage = $row['productsImage'];
//         $productid = $row['productsId'];


//         $productcreator;
//         $sql = "SELECT * FROM users WHERE usersId = '" .$row['productAddedByUserId']. "';";
//         $stmt = mysqli_stmt_init($conn);
//         if (!mysqli_stmt_prepare($stmt, $sql)) {
//             header("location: products.php?error=stmtfailed");
//             // change later!!!
//             exit();
//         }
//         $result = mysqli_query($conn, $sql);
//         $resultCheck = mysqli_num_rows($result);
//         if ($resultCheck == 1) {
//             while ($row = mysqli_fetch_assoc($result)) {
//                 $productcreator = $row['usersEmail'];
//             }
//         }
//     }
// }
