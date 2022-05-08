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
}
echo "<br>";
$var1 = 'abc';
$var2 = 'ddd';
if ($var1 == 'abc' && $var2 == 'ddd') {
    echo 'hoi';
}


 
echo $_SESSION['useremail'];

include_once 'footer.php'
?>