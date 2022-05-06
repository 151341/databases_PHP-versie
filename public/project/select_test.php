<head>
    <title>select managers</title>
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

<h1>all managers</h1>
<?php
$sql = "SELECT * FROM users WHERE isManager = 1 order by usersName ASC;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../select.php?error=stmtfailed");
    exit();
}
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['usersEmail'] == 'stef.delnoye@gmail.com') {
            echo $row['usersName'] .' '. $row['usersEmail'] .  " <br>";
        } else {
            echo $row['usersName'] .' '. $row['usersEmail'] .  " delete<br>";
        }
    }
}
?>

<h1>select new employees</h1>
<h3>all users</h3>
<?php
require('includes/functions.inc.php');
$sql = "SELECT * FROM users WHERE isManager = 0 order by usersName asc;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../select.php?error=stmtfailed");
    exit();
}
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
    echo $row['usersName'] .' '. $row['usersEmail']. ' '. $row['usersId']; ?>
        <!-- <form method="post"> -->
        <button onclick="makeManager($row['usersId'])">add</button>
        <!-- </form> -->
        <br>
        <?php
    }
}
// echo 'hoi';




include_once 'footer.php'
?>

<script type="text/javascript" src="http://path/to/jquery-latest.min.js"></script>
<script type="text/javascript">
function makeManager(userId)
{
  $.ajax({
    'url': 'project/select.php', 
    'type': 'GET',
    'dataType': 'json', 
    'data': {userid: userId}, 
    'success': function(data) 
    {
      if(data.status)
      {
        if(data.added)
        {
          $("span#success"+userId).attr("innerHTML","Item added to your personal list");
        }
        else
        {
          $("span#success"+userId).attr("innerHTML","This item is already on your list");
        }
      }
    },
    'beforeSend': function() 
    {
      $("span#success"+userId).attr("innerHTML","Adding item to your bucketlist...");
    },
    'error': function(data) 
    {
      // this is what happens if the request fails.
      $("span#success"+userId).attr("innerHTML","An error occureed");
    }
  });
}
</script>

<!-- https://www.w3schools.com/xml/xml_http.asp -->
<?php
if($bucketlist < 1) 
{
//   mysql_query("INSERT INTO users (memberbucketid, userid, bucketid, complete) VALUES ('', '$userid', '$_GET['itemId]', '0')");
//   mysql_query("UPDATE `users` SET `isManager` = '1' WHERE `users`.`usersId` = 7;")
//   mysql_query of mysqli_query
  return json_encode(array("status" => true, "added" => true));
}
else
{
  return json_encode(array("status" => true, "added" => false));
}
?>