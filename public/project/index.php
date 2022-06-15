<head>
    <title>NYSTIAA | Dumbbell-specialist</title>
    <?php 
  echo "<link rel='stylesheet' type='text/css' href='/project/design.css' />"; 
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<?php
include_once 'header.php';
require('includes/functions.inc.php');
?>

<h2>Home</h2>
<img class="banner"src="productimg/photodumbbells.jpg" width="100%" height="100%">
<div class="content">


  <div class="column side">
    <?php
      if (isset($_SESSION['useruid'])) {
          echo "<h3>Hi " . $_SESSION["useruid"] . "</h3>";
          echo "<p>Je kunt nu producten bestellen.</p>"
          ?>
          
          <button onclick="window.location.href='includes/logout.inc.php';">Logout</button>
          <?php
      }
      else {  
        ?>   
            <div class="loginplace">
            <h3>Welkom</h3>
            <p>Log in om producten te bestellen.</p>
<section>
    <form  action="includes/login.inc.php" method="post">
        <input class="loginform" type="text" name="uid" placeholder="username/email">
        <input class="loginform" type="password" name="pwd" placeholder="password">
        <button type="submit" name="submit">Login</button>
    </form>

    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "fill in all fields";
        }
        else if ($_GET["error"] == "none") {
            echo 'You Are Signed In';
        }
        else if ($_GET["error"] == "wronglogin") {
            echo "wrong data typed in";
        }        
    }
?>
</section>
</div>
         <?php
      }
    ?> 

<h3>Datum</h3>
    <?php
    date_default_timezone_set("Europe/Amsterdam");
    $timestamp = date('Y-m-d H:i:s');
    print $timestamp;
    ?>
  </div>

  <div class="column mid">
    <h3>Onze Nieuwste Producten</h3>
    <?php
      $sql = "SELECT * FROM products ORDER BY productsId DESC LIMIT 4";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: select.php?error=stmtfailed");
        exit();
      }   
    ?>
            <div class="productengalerij">
            <?php
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            
            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>                  
                    <div class="producten">
                        <?php
                        if ($row['productsImage']!=null) {
                            $imglink = "productimg/".$row['productsImage'];
                            ?>
                            <img src="<?php echo $imglink; ?>" alt="" height="190" width="190">
                            <?php
                        }
                        echo "<h3>". $row['productsName'] . "</h3>";    
                        echo "<price>$". $row['productsPrice'] . "</price><br>";  
                        if ($_SESSION['ismanager'] === 1) {
                            print '<a  href="change_product.php?id=' . $row['productsId'] . '">Change product</a><br>';
                        }
                        print '<a href="product.php?id=' . $row['productsId'] . '">View product</a>';
                        if ($_SESSION['userid']!=null) {
                            ?>
                            <form method="post" action="includes/shopping_cart.inc.php">
                                <input class="loginform"type="number" name="productq" placeholder="quantity" value="1" min="1">
                                <input class="loginform"type="hidden" name="userid" placeholder="userid" value=<?php echo $_SESSION["userid"] ?>>
                                <input class="loginform"type="hidden" name="productid" placeholder="productid" value=<?php echo $row['productsId'] ?>>
                                <button class="buttoncard"  type="submit" name="submit">Add to cart</button>
                            </form>
                            <?php
                        }
                    ?>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>

    

  <div class="column side">
 

    <img class="banner4" src="productimg/dumbbell.webp" width="700" height="700">
 

  </div>

</div>
<img class="banner2"src="productimg/woman-with-dumbbells-on-floor-of-gym.jpg" width="100%" height="100%">

<?php
include_once 'footer.php'
?>
