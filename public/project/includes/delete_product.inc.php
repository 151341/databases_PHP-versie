<?php
if (isset($_POST["submit"])) {
    $aDoor = $_POST['delete'];
    if(empty($aDoor)) {
        echo("You didn't select any products.");
    } 
    else {
        $N = count($aDoor);
        echo("You selected $N product(s): ");
        for($i=0; $i < $N; $i++) {
            echo($aDoor[$i] . " ");
        }
    }
}