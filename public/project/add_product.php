<head>
    <title>add products</title>
</head>
<?php
include_once 'header.php';
if ($_SESSION['useremail'] !== 'stef.delnoye@gmail.com') {
    header("location: ./login.php");
    exit();
}
require('includes/dbh.inc.php');
$DBverbinding = mysqli_connect($serverName, $dbUserName, $dbPassword, $dbName);
if (!$DBverbinding) {
die("Verbinding mislukt: " . mysqli_connect_error());
}
else {
echo '<i>verbinding database succesvol</i>';
}
if ($_GET["error"] == "stmtfailed") {
    echo "sql query went wrong";
}
?>

<h1>add a new product</h1>
<?php
require('includes/functions.inc.php');


// showUsers($DBverbinding);

?>
