<head>
    <title>add products</title>
</head>
<?php
include_once 'header.php';
require('includes/functions.inc.php');
if ($_SESSION['ismanager'] !== 1) {
    header("location: ./products.php");
    exit();
}
?>


<h2>Add a new product</h2>
<div class="content">
  <div class="column side">
<?php
require('includes/dbh.inc.php');
$DBverbinding = mysqli_connect($serverName, $dbUserName, $dbPassword, $dbName);
if (!$DBverbinding) {
die("Verbinding mislukt: " . mysqli_connect_error());
}
else {
echo '<i>verbinding database succesvol</i>';
}
if ($_GET["error"] == "stmtfailed") {
    echo "sql query went wrong";
}
?>    

</div>

<div class="column mid">
<div class="productinfo">
<?php
echo $_SESSION['userid']
?>
<section>
    <form action="includes/add_product.inc.php" method="POST" enctype="multipart/form-data">
        <input class="loginform"type="text" name="productname" placeholder="Name product"><br>
        <input class="loginform"type="text" name="productdesc" placeholder="Description of product"><br>
        <input class="loginform"type="number" name="price" placeholder="Price"><br>
        <input class="loginform"type="hidden" name="adderid" placeholder="userid" value=<?php echo $_SESSION["userid"]  ?>><br>
        <p>Voeg een product foto toe:<p>
        <input class="loginform"type="file" name="file"><br>
        <button type="submit" name="submit">Add</button>
    </form>
    
<?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == "emptyinput") {
        echo "fill in all fields";
    }
    else if ($_GET["error"] == "productnametaken") {
        echo "name already taken";
    }
    else if ($_GET["error"] == "stmtfailed") {
        echo "something went wrong. try again";
    }
    else if ($_GET["error"] == "imgtoobig") {
        echo "the image you uploaded was too big";
    }
    else if ($_GET["error"] == "unknown") {
        echo "There was an error";
    }
    else if ($_GET["error"] == "typeunaccepted") {
        echo 'you cannot upload files of this type';
    }
    else if ($_GET["error"] == "invalidproductname") {
        echo 'invalid product name';
    }
    else if ($_GET["error"] == "notint") {
        echo 'price has to be a number';
    }
    
// -------- self made delete soon -----------
    // else if ($_GET["error"] == "invalidimage") {
    //     echo "The File you Chose Was Not An Image";
    // }

// ----------

    else if ($_GET["error"] == "none") {
        header("location: ./login.php?error=none");
        exit();
    }
    
}
?>

</section>
</div>
</div>
<div class="column side">

  </div>
</div>
<?php
include_once 'footer.php'
?>
