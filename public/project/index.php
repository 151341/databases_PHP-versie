<head>
    <title>Webshop | Koop hier je wiet</title>
    <?php 
  echo "<link rel='stylesheet' type='text/css' href='/project/design.css' />"; 
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<?php
include_once 'header.php';
require('includes/functions.inc.php');
?>

<h2>Home</h2>

<div class="content">
  <div class="column side">
    <h3>Welkom</h3>
<?php

if (isset($_SESSION['useruid'])) {
    echo "<p>Hi " . $_SESSION["useruid"] . "</p>";
}
else {
 echo "Login";

}


?>
</div>

<div class="column mid">
<h3>Content</h3>
  <p>Hier wat leuke dingen</p>
</div>

<div class="column side">
<h3>Datum</h3>
<?php
date_default_timezone_set("Europe/Amsterdam");
$timestamp = date('Y-m-d H:i:s');
print $timestamp;
?>

  </div>
</div>

<?php
include_once 'footer.php'
?>