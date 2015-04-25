<?php

include("dbo.php");
$campaign_id = (int)$_POST['campaign_id'];
$value = $_POST['value'];
$outcome_id = (int) $_POST['outcome_id'];
if ($campaign_id > 0) {

if (!$outcome_id) { 
$query = "insert into outcome(campaign_id,value) values(:campaign_id, :value)";
$sth = $dbh->prepare($query);
$sth->bindValue(":campaign_id", $campaign_id);
$sth->bindValue(":value", $value);
if(!$sth->execute()) {
$arr = $sth->errorInfo();
print_r($arr);
die("failed");
}
$outcome_id = $dbh->lastInsertId();
}


$query = "insert into bet(outcome_id, amount) values(:outcome_id, :amount)";
$sth = $dbh->prepare($query);
$sth->bindValue(":outcome_id", $outcome_id);
$sth->bindValue(":amount", (float) $_REQUEST['amount']);
execOrDie($sth);
}
redirect("status.php?id=".$campaign_id);
?>
