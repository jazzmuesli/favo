var express = require('express');
var app = express();
// Parse application
var bodyParser = require('body-parser');
app.use(bodyParser.urlencoded({ extended: false }));
var braintree = require('braintree');
/*
npm install express body-parser braintree

*/

var gateway = braintree.connect({
  environment: braintree.Environment.Sandbox,
  merchantId: "cnxsrk6kz7j2qnhm",
  publicKey: "frzxy8w2xrn3r8sc",
  privateKey: "5883dfc099ac36aa11b97c79e74c93fd"
});

app.get("/client_token", function (req, res) {
gateway.clientToken.generate({
//customerId: aCustomerId
}, function (err, response) {
res.send(response.clientToken);
});
});
app.get('/', function(req, res) {
res.send('whatup son hey dad');
});
app.post("/checkout", function(req,res) {
var nonce = req.body.payment_method_nonce;
console.log('nonce: ' + nonce);
gateway.transaction.sale({
amount: '1.00',
paymentMethodNonce: nonce, //"braintree.Test.Nonces.Transactable" /*"nonce-from-the-client"*/,
}, function (err, result) {
var output = '';
var object = result.transaction;
for (var property in object) {
  output += property + ': ' + object[property]+'; ';
}
object = err;
for (var property in object) {
  output += property + ': ' + object[property]+'; ';
}
console.log('output: ' + output);
console.log('err: ' + err + ', result: ' + result.success + ', txn: ' + result.transaction.id);
res.sendStatus(200);
});
});
console.log("Starting server!");
app.listen(3000);
