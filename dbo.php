<?php
error_reporting(E_ALL);
include("/tmp/db.php");
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
create table outcome (
id bigint auto_increment,
value varchar(200),
amount decimal(10,2),
user_id bigint,
campaign_id bigint,
primary key(id)
);
create table user (
id bigint auto_increment,
email varchar(200),
primary key(id)
);
*/
function getRows($query) {
global $dbcon;
$ret = array();
$result = mysql_query($query);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
while($row=mysql_fetch_array($result)) {
$ret[] = $row;
}
return $ret;
}
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

?>
