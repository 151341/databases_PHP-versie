<head>
    <title>home page</title>
</head>
<?php
include_once 'header.php';
?>
<h1>home</h1>
<?php
if (isset($_SESSION['useruid'])) {
    echo "<p>Hi " . $_SESSION["useruid"] . "</p>";

}

include_once 'footer.php'
?>