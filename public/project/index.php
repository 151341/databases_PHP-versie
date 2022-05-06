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


 
echo $_SESSION['useremail'];

include_once 'footer.php'
?>