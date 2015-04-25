<?php
include("dbo.php");
$name = $_POST['event_name'];
if (!empty($name)) {
$query = "insert into campaign(name) values('$name')";
$result = mysql_query($query);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
}
redirect("index.php");
?>
