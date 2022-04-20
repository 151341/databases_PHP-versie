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
<a href="">change</a>
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
