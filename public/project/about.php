<head>
<title>over ons</title>
</head>
<?php
include_once 'header.php';

require('includes/functions.inc.php');

?>

<p>ontmoet onze trouwe managers. Het zijn echte spotfanaten</p>
<?php
$sql = "SELECT * FROM users WHERE isManager = 1 order by usersName asc;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: select.php?error=stmtfailed");
    exit();
}
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0) {?>
    <section>
        <form action="includes/add_employee.inc.php" method="POST">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
              echo $row['usersEmail'] . "<br>";
               
            }
            ?>
            <button type="submit" name="submit">Add</button>
        </form>
    </section>
    <?php
}

include_once 'footer.php';
?>