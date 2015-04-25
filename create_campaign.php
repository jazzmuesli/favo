<?php
function convert_date($d) {
$ret = date_parse($d);
return sprintf("%04d-%02d-%02d", $ret['year'], $ret['month'], $ret['day']);
}
include("dbo.php");
$_REQUEST['start_date'] = convert_date($_REQUEST['start_date']);
$_REQUEST['end_date'] = convert_date($_REQUEST['end_date']);

$name = $_POST['name'];
if (!empty($name)) {
$query = "insert into campaign(name,description, start_date, end_date) values(:name, :description, :start_date, :end_date)";
$sth = $dbh->prepare($query);
foreach (array("name","description","start_date","end_date") as $param) {
  $sth->bindValue($param, $_REQUEST[$param]);
}
execOrDie($sth);
}
redirect("index.php");
?>
