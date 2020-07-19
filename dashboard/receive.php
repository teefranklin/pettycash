<?php
require "db/DB.php";
$api_key='da1cf669-4231-4621-bdd3-9dae03de3466';
$secret = "abc12345abc";
$xpub="xpub6C73ViYtBidN4uNE2rmeLzX6kDJCuciAXsA42sVqmzvyACe5L4GipsTpHYXY1wp8WLWAXaY8LPS9Poe2rxNBdxe2f8KUmKwG5WWsSC1y7Wg";

$orderID = uniqid();

$rootURL = 'https://tradeshacker.com';
$callback_url =$rootURL."/callback.php?invoice=".$orderID."&secret=".$secret."&user=".$_SESSION['id'];
$recieve_url="https://api.blockchain.info/v2/receive?key=".$api_key."&xpub=".$xpub."&callback=".urlencode($callback_url);

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_URL,$recieve_url);
$ccc = curl_exec($ch);
$json = json_decode($ccc, true);

$payTo = $json['address'];

header('Location:address.php?payTo='.$payTo);

?>
