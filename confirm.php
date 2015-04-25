<span id="myContainer"></span>
<script src="https://www.paypalobjects.com/js/external/api.js"></script>
<script>
paypal.use( ["login"], function(login) {
  login.render ({
    "appid": "d3428641e41208c246d07b2e5f3cc7a5",
    "authend": "sandbox",
    "scopes": "profile email address phone https://uri.paypal.com/services/paypalattributes",
    "containerid": "myContainer",
    "locale": "en-gb",
    "returnurl": "http://favo.openfun.org/paypal.php"
  });
});
</script>
