<head>
<title>profile</title>
</head>
<?php
include_once 'header.php';

if (!isset($_SESSION['useruid'])) {
    header("location: ./login.php");
    exit();
}
?>
<h2>Your profile</h2>
<div class="content">

  <div class="column side">
</div>

<div class="column mid">

<div class="productinfo">
<?php

echo "<p>name:  " . $_SESSION["username"] . "</p>";
echo "<p>username:  " . $_SESSION["useruid"] . "</p>";
echo "<p>email:  " . $_SESSION["useremail"] . "</p>";
echo "<p>userid:  " . $_SESSION["userid"] . "</p>";
echo "<p>profile image:</p>";
$imglink = "profileimg/".$_SESSION["userimg"];
if ($_SESSION["userimg"] != null) {
    ?>
    <img src="<?php echo $imglink; ?>" alt="" height="100" width="100"><br>
    <?php
} else {
    echo 'you dont have a profile image yet<br>';
}

if ($_SESSION["ismanager"] === 1) {
echo "You are a manager";
}
?>

</div>

</div>

<div class="column side">
<form class="loginform" action="includes/profile.inc.php" method="POST" enctype="multipart/form-data">
    name: <input class="loginform" type="text" name="name"
    value=
    "<?php
    echo $_SESSION["username"] 
    ?>"
    ><br>
    username: <input class="loginform" type="text" name="uid"
    value=
    <?php
    echo $_SESSION["useruid"] 
    ?>
    ><br>
    email: <input class="loginform" type="text" name="email"
    value=
    <?php
    echo $_SESSION["useremail"] 
    ?>
    ><br>
    <input class="loginform" type="hidden" name="id"
    value=
    <?php
    echo $_SESSION["userid"] 
    ?>
    ><br>
    <input class="loginform" type="hidden" name="pwd"
    value=
    <?php
    echo $_SESSION["userpwd"] 
    ?>
    ><br>
    <input class="loginform" type="file" name="file"
    value=
    <?php
    echo $_SESSION["userimg"] 
    ?>
    ><br>
    <input class="loginform" type="checkbox" name="delete" value="delete">delete profile image<br>

    <button type="submit" name="submit">Change</button>
</form>
  </div>
</div>


<?php
include_once 'footer.php';
?>

<!-- /workspace/databases_PHP-versie/public/project/profileimg/62751df7170702.92458393.png -->