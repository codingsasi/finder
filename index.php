<?php
$ip = get_client_ip();
$url = 'https://s18v7r0g3m.execute-api.us-east-2.amazonaws.com/default/FindaHead?ip=' . $ip;
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, $url);
$result = curl_exec($ch);
curl_close($ch);
$redirect = json_decode($result);
header("Location: $redirect"); /* Redirect browser */
exit();

function get_client_ip() {
    $ip = '';
    if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
    if (strpos($_SERVER["HTTP_X_FORWARDED_FOR"], ',') !== false) {
     // Separate client IP from proxies' IP
     // Format is in [X-Forwarded-For: client, proxy1, proxy2, ..]
     $ips = explode (',', $_SERVER["HTTP_X_FORWARDED_FOR"]);
     $ip = trim($ips[0]);
   }
   else {
     // There is no comma in the value; we use it as is.
     $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
   }
 }

 else {
   // Client is not using a proxy; we use the default REMOTE_ADDR.
   $ip = $_SERVER["REMOTE_ADDR"];
 }
    return $ip;
}

