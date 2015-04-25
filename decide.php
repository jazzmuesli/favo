<?php
include("header.php");
$item = getRow("select * from campaign where id=:id", array("id" => (int) $_REQUEST['id']))
?>
<h1>The time to decide who won</h1>
<table>
<? foreach ($item as $name=>$value) {
?>
<tr>
<td><?=$name;?></td>
<td><?=$item[$name];?></td>
</tr>
<?php }?>
</table>
<h2>Outcomes</h2>
<table>
<tr>
<td><?=$item['value'];?></td>
<td><?=$item['amount'];?></td>
<td><?=$item['bids'];?></td>
<td><input type="text" name="portion" value="0" /></td>
</tr>
<?php
include("footer.php");
?>
