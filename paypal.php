<?php
$baseurl = "http://favo.openfun.org:3000";
$token = join("", file("http://favo.openfun.org:3000/client_token"));
?>
<html>
<head></head><body>

<form id="checkout" method="post" action="<?=$baseurl;?>/checkout">
  <div id="dropin"></div>
  <input type="submit" value="Pay $10">
</form>

<script src="https://js.braintreegateway.com/v2/braintree.js"></script>

<script>
  braintree.setup(
    // Replace this with a client token from your server
    "<?=$token;?>",
    'dropin', {
      container: 'dropin'
    });
</script>
</body>
</html>
