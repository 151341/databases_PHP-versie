<?php
if (isset($_POST["submit"])) {
    require('dbh.inc.php');
    require_once 'functions.inc.php';  
    if (!empty($_POST["employees"])) {
        $deleted_employees = $_POST["employees"];
        foreach ($deleted_employees as $deleted_employee){
            addEmployee($conn, $deleted_employee);      
        }
    header("location: ../select.php");
    exit();
    }
}
