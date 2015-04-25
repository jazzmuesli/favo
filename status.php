<?php
include("header.php");
$query = "select name, description, start_date, end_date from campaign where id=:id";
$params = array("id" => (int) $_REQUEST['id']);
$campaign=getRow($query, $params);
?>
<p><strong><?=$campaign['name'];?></strong><br />
<?=$campaign['description'];
?>
<table>
<?php
$outcomes = getRows("select o.id, value, sum(amount) as amount from outcome o left join bet b on o.id=b.outcome_id where o.campaign_id=:id group by o.id", $params);

foreach ($outcomes as $item) {
?>
<tr>
<td><?=$item['value'];?></td>
<td><?=$item['amount'];?> GBP</td>
</tr>
<?php
}
?>
</table>
<form method="post" action="promise.php">
<input type="hidden" name="campaign_id" value="<?=$params['id'];?>" />
Outcome: 
<select name="outcome_id">
<option value="0">My own</option>
<? foreach ($outcomes as $item) {?>
<option value="<?=$item['id'];?>"><?=$item['value'];?></option>
<?php } ?>
</select>
<br />
Or my own: <input type="text" size="100" name="value" /><br />
Amount: <input type="text" name="amount" /><br />
<input type="submit" />
</form>
<?php
include("confirm.php");
include("footer.php");
?>
