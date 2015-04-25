<?php
include("header.php");
?>
<p>Currently there are the following campaigns:</p>
<table border="1">
<tr>
<th>name</th>
<th>description</th>
<th>total amount</th>
<th>start date</th>
<th>end date</th>
<th>Participate</th>
</tr>
<?php
$campaigns = getRows("Select c.id, c.description,c.start_date, c.end_date, c.name, sum(amount) as amount from campaign c left join outcome o on o.campaign_id=c.id left join bet b on o.id=b.outcome_id group by c.id");
foreach ($campaigns as $item) {?>
<tr>
<td><?=$item['name'];?></td>
<td><?=$item['description'];?></td>
<td><?=$item['amount'];?></td>
<td><?=$item['start_date'];?></td>
<td><?=$item['end_date'];?> <a href="decide.php?id=<?=$item['id'];?>">finished</a></td>
<td><a href="status.php?id=<?=$item['id'];?>">status</a></td>
</tr>
<?php } 
?>
</table>
<p>Create your own campaign</p>
<?php
include("campaign.html");
?>
<?php
include("footer.php");
?>
