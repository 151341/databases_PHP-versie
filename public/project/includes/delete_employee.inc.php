<?php
if (isset($_POST["submit"])) {
    require('dbh.inc.php');
    require_once 'functions.inc.php';  
    if (!empty($_POST["employees"])) {
        $deleted_employees = $_POST["employees"];
        foreach ($deleted_employees as $deleted_employee){
            deleteEmployee($conn, $deleted_employee);      
            // $sql = "UPDATE users SET isManager = 0 WHERE usersEmail='" .$deleted_employee. "';";
            // mysqli_query($conn, $sql);    
            // echo $deleted_employee;
        }
    header("location: ../select.php");
    exit();
    }
}
