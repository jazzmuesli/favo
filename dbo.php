<?php
error_reporting(E_ALL);
include("/tmp/db.php");
try {
$dbh = new PDO('mysql:host=localhost;dbname=' . $DBNAME, $DBUSER, $DBPWD, array( PDO::ATTR_PERSISTENT => false));
} catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
  die();
}
$dbcon = mysql_connect("localhost", $DBUSER, $DBPWD) or die('Could not connect: ' . mysql_error());
mysql_select_db($DBNAME, $dbcon) or die('Could not select database.');
/*
create table campaign (
id bigint auto_increment,
name varchar(200),
description text,
start_date datetime,
end_date datetime,
primary key(id)
);
create table bet (
id bigint auto_increment,
user_id bigint,
outcome_id bigint,
amount decimal(10,2),
primary key(id)
);
create table outcome (
id bigint auto_increment,
value varchar(200),
campaign_id bigint,
primary key(id)
);
create table user (
id bigint auto_increment,
email varchar(200),
primary key(id)
);
*/

function getRows($query, $params=array(), $max_rows=-1) {
global $dbh;
$ret = array();
try {
 $stmt = $dbh->prepare($query);
 if (!$stmt) {
 die("error: " . mysql_error());
  }
 foreach ($params as $name=>$value) {
$stmt->bindValue(":".$name, $value);
  }
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
$ret [] =  $row;
if ($max_rows == 1) {
return $row;
}
 }
return $ret;
} catch (PDOException $e) {
die("Error: $e");
}
}

function getRow($query, $params=array()) {
  return getRows($query, $params, 1);
/*
global $dbcon;
global $dbh;
$ret = array();
try {
$stmt = $dbh->prepare($query);
$stmt->execute();
while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
 $ret[] = $rs;
}
} catch (PDOException $e) {
die ("Exception: $e");
}
/*
$result = mysql_query($query);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
while($row=mysql_fetch_array($result)) {
$ret[] = $row;
}

return $ret;
*/}
function getCampaigns() {
$query = "select c.id, name, description, count(u.id) as bets from campaign c left join outcome u on c.id=u.campaign_id group by c.id";
return getRows($query);
}

/**
* Base URL of this website.
*/
function getBaseUrl() {
	return "http://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . '/';
}
/**
* Redirect to $page in the same directory.
*/
function redirect($page) {
	header('Location: ' . getBaseUrl() . $page);
	exit();
}

function execOrDie($sth) {
if(!$sth->execute()) {
$arr = $sth->errorInfo();
print_r($arr);
die("failed");
return false;
}
return true;
}
?>
