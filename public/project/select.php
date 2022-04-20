<head>
<title>select</title>
</head>
<?php
include_once 'header.php';

if (!isset($_SESSION['useruid'])) {
    header("location: ./login.php");
    exit();
}
?>

<h1>select</h1>

<?php
require('includes/functions.inc.php');
$sql = "SELECT * FROM users WHERE isManager = 0 order by usersName asc;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: select.php?error=stmtfailed");
    exit();
}
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
    echo $row['usersName'] .' '. $row['usersEmail']. ' '. $row['usersId']; ?>
        <br> <?php
    }
}


include_once 'footer.php';
?>