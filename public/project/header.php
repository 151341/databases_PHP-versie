<?php
session_start();
?>
<body>
<nav>
    <li><a href="index.php">home</a></li>
    <li><a href="products.php">products</a></li>
    <?php
    if (isset($_SESSION["useruid"])) {
        echo "<li><a href='profile.php'>profile</a></li>";
        if ($_SESSION['useremail'] === 'stef.delnoye@gmail.com') {
            echo "<li><a href='select.php'>select new employees</a></li>";
        }
        echo "<li><a href='includes/logout.inc.php'>logout</a></li>";
    }
    else {
        echo "<li><a href='signup.php'>signup</a></li>";
        echo "<li><a href='login.php'>login</a></li>";
    }
    ?>
</nav>