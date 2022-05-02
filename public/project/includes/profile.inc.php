<?php

if (isset($_POST["submit"])) {
    require_once 'dbh.inc.php';

    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $userid = $_SESSION["userid"];
    updateUser($conn, $name, $email, $username, $userid);
    // echo $name, $email, $username, $userid;
    // echo  $_SESSION["userid"];

    // $sql = "UPDATE `users` SET usersName = '$name', usersEmail= '$email', usersEmail= '$username' WHERE usersId = 1;";
    // mysqli_query($conn, $sql);
    // header("location: ../profile.php?error=none");
    // exit();


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