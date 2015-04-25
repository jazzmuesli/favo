<?php
include("header.php");
?>
<p>Currently there are the following campaigns:</p>
<?php
$campaigns = getCampaigns();
foreach ($campaigns as $item) {?>
<p><?=$item['name'];?> <a href="status.php?id=<?=$item['id'];?>">status</a></p>
<?php } 
?>
<p>Create your own campaign</p>
<?php
include("campaign.html");
?>
<?php
include("footer.php");
?>
