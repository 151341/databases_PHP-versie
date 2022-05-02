<head>
    <title>add products</title>
</head>
<?php
include_once 'header.php';
if ($_SESSION['ismanager'] !== 1) {
    header("location: ./login.php");
    exit();
}
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

<h1>add a new product</h1>
<?php
echo $_SESSION['userid']
?>
<section>
    <form action="includes/add_product.inc.php" method="post">
        <input type="text" name="productname" placeholder="name product"><br>
        <input type="text" name="productdesc" placeholder="description of product"><br>
        <input type="number" name="price" placeholder="price"><br>
<!-- added later -->
        <!-- <label for="profile_image">Pick Your Profile Image:</label> -->
        <!-- <input type="file" id="profile_image" name="file"> -->
<!-- added later -->
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
        echo 'you cannot upload files of this type';
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

<?php
require('includes/functions.inc.php');


// showUsers($DBverbinding);

?>
