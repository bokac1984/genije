<?php 
$jsonData = array();
foreach ($numberOfLocationsPerCity as $k => $v) {
    $jsonData[] = array(
        'label' => $v['City']['name'],
        'data' => $v[0]['cityCount']
    );
}
echo json_encode($jsonData);