<head>
    <title>sign up</title>
</head>

<?php
include_once 'header.php';
if (isset($_SESSION["useruid"])) {
    header("location: ./index.php");
    exit();
}
error_reporting(E_ALL & ~E_NOTICE);
require('includes/dbh.inc.php');
$DBverbinding = mysqli_connect($serverName, $dbUserName, $dbPassword, $dbName);
echo $dbUserName;
echo '<br>';
echo '<br>';
if (!$DBverbinding) {
die("Verbinding mislukt: " . mysqli_connect_error());
}
else {
echo '<i>verbinding database succesvol</i>';
}
?>
<h1>sign up</h1>
<section>
    <form action="includes/signup.inc.php" method="post">
        <input type="text" name="name" placeholder="full name"><br>
        <input type="text" name="email" placeholder="email"><br>
        <input type="text" name="uid" placeholder="username"><br>
<!-- added later -->
        <!-- <label for="profile_image">Pick Your Profile Image:</label> -->
        <!-- <input type="file" id="profile_image" name="file"> -->
<!-- added later -->
        <input type="password" name="pwd" placeholder="password"><br>
        <input type="password" name="pwdrepeat" placeholder="repeat password"><br>
        <button type="submit" name="submit">Sign Up</button>
    </form>
    
<?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == "emptyinput") {
        echo "fill in all fields";
    }
    else if ($_GET["error"] == "invaliduid") {
        echo "invalid username";
    }
    else if ($_GET["error"] == "invalidemail") {
        echo "invalid email";
    }
    else if ($_GET["error"] == "pwdnotmatch") {
        echo "not the same passwords";
    }
    else if ($_GET["error"] == "usernametaken") {
        echo "username already taken";
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
include_once 'footer.php';
?>