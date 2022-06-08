<head>
    <title>login</title>
</head>

<?php
include_once 'header.php';
if (isset($_SESSION["useruid"])) {
    header("location: ./index.php");
    exit();
}
?>
<h1>login</h1>
<section>
    <form action="includes/login.inc.php" method="post">
        <input class="loginform" type="text" name="uid" placeholder="username/email">
        <input class="loginform"type="password" name="pwd" placeholder="password">
        <button type="submit" name="submit">login</button>
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
<?php
include_once 'footer.php'
?>