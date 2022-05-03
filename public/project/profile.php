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
<h1>your profile</h1>
<form action="includes/profile.inc.php" method="POST">
    name: <input type="text" name="name"
    value=
    "<?php
    echo $_SESSION["username"] 
    ?>"
    ><br>
    username: <input type="text" name="uid"
    value=
    <?php
    echo $_SESSION["useruid"] 
    ?>
    ><br>
    email: <input type="text" name="email"
    value=
    <?php
    echo $_SESSION["useremail"] 
    ?>
    ><br>
    <input type="hidden" name="id"
    value=
    <?php
    echo $_SESSION["userid"] 
    ?>
    ><br>
    <input type="hidden" name="pwd"
    value=
    <?php
    echo $_SESSION["userpwd"] 
    ?>
    ><br>
    <button type="submit" name="submit">Change</button>

</form>
<?php
echo "<p>userid:  " . $_SESSION["userid"] . "</p>";
echo "<p>name:  " . $_SESSION["username"] . "</p>";
echo "<p>username:  " . $_SESSION["useruid"] . "</p>";
echo "<p>email:  " . $_SESSION["useremail"] . "</p>";
echo "<p>profile image:  " . $_SESSION["profileimg"] . "</p>";

if ($_SESSION["ismanager"] === 1) {
echo "you are a manager";
}
include_once 'footer.php';
?>
