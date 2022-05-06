<head>
    <title>home page</title>
</head>
<?php
include_once 'header.php';
?>
<h1>home</h1>
<label for="theinput">Input here:</label>
<input type='checkbox' name='whatever' id='theinput'>
<?php
if (isset($_SESSION['useruid'])) {
    echo "<p>Hi " . $_SESSION["useruid"] . "</p>";
    echo "<p>Hi " . $_SESSION["userpwd"];

}
echo "<br>";
?>
<img src="uploads/6274dc0e03f6f5.38572746.jpg" alt="">
<?php

 
echo $_SESSION['useremail'];

include_once 'footer.php'
?>