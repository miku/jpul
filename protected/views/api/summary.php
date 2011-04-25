<?php 
header('Content-type: application/json'); 

$item = array();
$item["jobs"] = $data['jobs']; 
$item["active_jobs"] = $data['active_jobs'];
// $item["requests"] = $data['requests'];
// $item["requests_24h"] = $data['requests_24h'];
// $item["requests_7d"] = $data['requests_7d'];
$item["requests_30d"] = $data['requests_30d'];
// $item["visitors"] = $data['visitors'];
// $item["visitors_24h"] = $data['visitors_24h'];
// $item["visitors_7d"] = $data['visitors_7d'];
$item["visitors_30d"] = $data['visitors_30d'];
$item["first_request"] = $data['first_request'];
$item["last_request"] = $data['last_request'];
$item["homepage"] = "http://www.uni-leipzig.de/jobportal";
$item["info"] = "(C) 2010 - " .  date("Y") . "Jobportal des Career Centers der Universität Leipzig";
$item["address"] = "Career Center, Universität Leipzig, Burgstraße 21, 1. Etage, 04109 Leipzig";
$item["email"] = "martin.czygan@gmail.com, claudia.schoder@uni-leipzig.de";
$item["phone"] = "0049 341 9730030";
$item["fax"] = "0049 341 9730069";

echo json_encode($item);

?>