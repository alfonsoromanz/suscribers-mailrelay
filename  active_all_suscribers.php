<?php
/*
* This code allows you to set all your suscribers
* as "Active" in MailRelay.
*
* Created by: Alfonso Román y Zubeldia
* github: alfonsoromanz
*/

$url = "insert mailrelay url here";
$curl = curl_init('https://'. $url .'/ccm/admin/api/version/2/&type=json');
 
$postData = array(
    'function' => 'getSubscribers',
    'apiKey' => 'Z4EcQGatBhJ00rIHF0bQHWtijX1uw8PL3ToKZE3b',
    'offset' => 0
);
 
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postData));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 
$json = curl_exec($curl);
if ($json === false) {
    die('Request failed with error: '. curl_error($curl));
}
 
$result = json_decode($json);
if ($result->status == 0) {
    die('Bad status returned. Error: '. $result->error);
}
 

$suscribers = $result->data;

$identifiers = array ();


foreach ($suscribers as $id) {
	
	
	$temp = $id->id;
	
	array_push($identifiers, intval($temp));
	
}


var_dump($identifiers);
$postData_2 = array(
    'function' => 'updateSubscribers',
    'apiKey' => 'Z4EcQGatBhJ00rIHF0bQHWtijX1uw8PL3ToKZE3b',
    'ids' => $identifiers,
    'activated' => 1
);
 
$post_2 = http_build_query($postData_2);
 
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $post_2);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 
$json_2 = curl_exec($curl);
if ($json_2 === false) {
    die('Request failed with error: '. curl_error($curl));
}
 
$result_2 = json_decode($json_2);
if ($result_2->status == 0) {
    die('Bad status returned. Error: '. $result_2->error);
}
 
var_dump($result_2->data);
?>
