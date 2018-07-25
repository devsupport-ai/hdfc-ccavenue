<html>
<head>
    <title> Custom Form Kit </title>
</head>
<body>

<?php
include('ccavenue_crypto.php');
include("ccavenue_config.php");

?>
<?php

error_reporting(0);

$merchant_data = $merchant_id;

$postData = $_POST;
$postData["redirect_url"] = $redirect_url;
$postData["cancel_url"] = $redirect_url;
$postData["currency"] = "INR";
$postData["language"] = "EN";
$postData["amount"] = "500.00";
$postData["merchant_id"] = $merchant_id;
$postData["order_id"] = "ord-" . generateRandomString(10);


foreach ($postData as $key => $value) {
    $merchant_data .= $key . '=' . urlencode($value) . '&';
}

$encrypted_data = encrypt($merchant_data, $working_key); // Method for encrypting the data.


?>
<form method="post" name="redirect"
      action="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction">
    <?php
    echo "<input type=hidden name=encRequest value=$encrypted_data>";
    echo "<input type=hidden name=access_code value=$access_code>";
    ?>
</form>
<script language='javascript'>document.redirect.submit();</script>
</body>
</html>

