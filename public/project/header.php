<?php
session_start();
?>
<div class="header">
<h1>Webshop</h1>
</div>
<body> 
<nav>
    <li><a class="active" href="index.php">Home</a></li>
    <li><a href="products.php">Products</a></li>
    <li><a href="about.php">About us</a></li>
    <li><a href="test2.php">test2</a></li>
    
    <?php
    if (isset($_SESSION["useruid"])) {
        echo "<li><a href='profile.php'>profile</a></li>";
        if ($_SESSION['useremail'] === 'stef.delnoye@gmail.com' or $_SESSION['useremail'] === 'stef.delnoye@gmail.com' or $_SESSION['useremail'] === 'stef.delnoye@gmail.com') {
            echo "<li><a href='select.php'>select new employees</a></li>";
        }
        echo "<li><a href='shopping_cart.php'>Shopping Cart</a></li>";
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
<?php 
  echo "<link rel='stylesheet' type='text/css' href='/project/design.css' />"; 
?>