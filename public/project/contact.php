<head>
    <title>contact</title>
    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  <!-- https://releases.jquery.com/ -->
    <script>
        $(document).ready(function() {
            $("#btn").click(function() {
                $("#test").load("data.txt", {Name: "Stef", LastName: "delnoye"
                }, function() {
                    alert('hi there');
                });
            });
        });
    </script>
</head>
<?php

include_once 'header.php';
require('includes/functions.inc.php');
?>

<div id="contact">
    <h1>contact</h1>
    <p>email: randomspullenkopen@gmail.com</p>
    <p>phone: 050- 337 227 27</p>


</div>
<?php
include_once 'footer.php'
?>