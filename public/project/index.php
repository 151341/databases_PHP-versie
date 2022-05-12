<head>
    <title>home page</title>
</head>
<?php
include_once 'header.php';
require('includes/functions.inc.php');
?>
<h1>home</h1>
<?php
if (isset($_SESSION['useruid'])) {
    echo "<p>Hi " . $_SESSION["useruid"] . "</p>";
}
echo "<br>";
include_once 'footer.php'
?>