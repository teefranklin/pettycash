<?php
require "db/DB.php";
$secret = "abc12345abc";
if($_GET['secret'] != $secret){
    die('stop trying to hack me');
}else{
    $value= $_GET['value'];
    $txhash = $_GET['transaction_hash'];
    $value_in_btc = $value / 100000000;
    $invoice= $_GET['invoice'];
    $user=$_GET['user'];
    insertPayment($invoice,$value_in_btc,$txhash,$user);
    echo "*ok*";
}




?>