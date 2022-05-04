<head>
<title>select</title>
</head>
<?php
include_once 'header.php';

require('includes/functions.inc.php');

// if ((!$_SESSION['useremail'] === 'stef.delnoye@gmail.com') || (!$_SESSION['useremail'] === 'christiaan.vlas@gmail.com')) {
//     header("location: ./login.php");
//     exit();
// }
if ($_SESSION['useremail'] == 'stef.delnoye@gmail.com') {
    echo 'hooi';
}
echo $_SESSION["useremail"];
?>

<h1>select new employees</h1>

<?php
$sql = "SELECT * FROM users WHERE NOT isManager = 1 order by usersName asc;";
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
                ?>
                <input type="checkbox" 
                
                id='products'
                name="employees[]" 

                value=
                "<?php
                echo $row["usersEmail"] 
                ?>"
                />

                <label
                for='products'
                >
                    <?php
                    echo $row['usersEmail'] . "<br>";
                    ?>
                </label><br />
                <?php
            }
            ?>
            <button type="submit" name="submit">Add</button>
        </form>
    </section>
    <?php
}
?>




<h1>delete employees</h1>

<?php
$sql = "SELECT * FROM users WHERE isManager = 1 and not usersEmail='stef.delnoye@gmail.com' order by usersName asc;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: select.php?error=stmtfailed");
    exit();
}
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0) {
    ?>
    <section>
        <form action="includes/delete_employee.inc.php" method="POST">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <input type="checkbox" 
                
                id='employees'
                name="employees[]" 

                value=
                "<?php
                echo $row["usersEmail"] 
                ?>"
                />

                <label
                for='employees'
                >
                    <?php
                    echo $row['usersEmail'] . "<br>";
                    ?>
                </label><br />
                <?php
            }
            ?>
            <button type="submit" name="submit">delete</button>
        </form>
    </section>
    <?php
}
include_once 'footer.php';
?>