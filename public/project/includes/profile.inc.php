<?php
if (isset($_POST["submit"])) {
    require('dbh.inc.php');

    // if (!$conn) {
    // die("Verbinding mislukt: " . mysqli_connect_error());
    // }
    // else {
    // echo '<i>verbinding database succesvol</i><br>';
    // }
   
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $userid = $_POST["id"];
    $pwdHashed = $_POST["pwd"];


    
    updateUser($conn, $name, $email, $username, $userid);
    // header("location: ../profile.php?error=none");
    // exit();
    echo $pwd;


}
else {
    header("location: ../profile.php");
    exit();
}

// $stmt = mysqli_stmt_init($conn);
// if (!mysqli_stmt_prepare($stmt, $sql)) {
//     header("location: ../profile.php?error=stmtfailed");
//     exit();
// }
// mysqli_stmt_bind_param($stmt, "sss", $name, $email, $uid);
// mysqli_stmt_execute($stmt);
// mysqli_stmt_close($stmt);
// header("location: ../profile.php?error=none");
// exit();


// mysqli_query($DBverbinding, $sql);
// $sql = "DELETE FROM stations WHERE ws_id>5";
// mysqli_query($DBverbinding, $sql);      
// mysqli_close($DBverbinding); 