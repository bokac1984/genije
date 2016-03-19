<?php
$temp = array();
foreach ($events as $event) {
    $temp[] = $event['Event'];
}
echo json_encode($temp, JSON_PRETTY_PRINT);
