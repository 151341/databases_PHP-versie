<?php
session_start();
include 'includes/dbh.inc.php';
// include 'includes/functions.inc.php';
?>
<div class="header">
<img class="logo" src="productimg/logo.png" width="200" height="200">
</div>
<body> 
<nav>
    <li><a class="active" href="index.php">Home</a></li>
    <li><a href="products.php">Products</a></li>
    <li><a href="about.php">About us</a></li>
    
    <?php
    if (isset($_SESSION["useruid"])) {
        echo "<li><a href='profile.php'>profile</a></li>";
        if ($_SESSION['useremail'] === 'stef.delnoye@gmail.com' or $_SESSION['useremail'] === 'stef.delnoye@gmail.com' or $_SESSION['useremail'] === 'stef.delnoye@gmail.com') {
            echo "<li><a href='select.php'>select new employees</a></li>";
        }
        $sql = "SELECT SUM(productQ) FROM shopping_cart where usersId='".$_SESSION['userid']."';";
        $result = mysqli_query($conn, $sql);
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: products.php?error=stmtfailed");
            exit();
        }
        while($row = mysqli_fetch_array($result)){
            $countproduct = $row['SUM(productQ)'];
        }
        
        
        ?>
        <li><a href="shopping_cart.php">Shopping Cart 
            <?php 
            echo $countproduct;
            // echo countProducts($conn, $_SESSION['userid']);
            ?>
        </a></li>
        <?php

        echo "<li><a href='includes/logout.inc.php'>logout</a></li>";
    }
    else {
        echo "<li><a href='signup.php'>Signup</a></li>";
        echo "<li><a href='login.php'>Login</a></li>";
    }
    
    ?>
    <li><a href="contact.php">Contact</a></li>
</nav>
</body>
<link rel='stylesheet' type='text/css' href='/project/design.css' />
<?php
// include 'includes/functions.inc.php';
// require('includes/functions.inc.php');
// echo countProducts($conn, $_SESSION["userid"]); 
?>