<?php
foreach ($dtResults as $result) {
    $this->dtResponse['aaData'][] = array(
        $result['Event']['id'],
        $result['Event']['name'],
        $result['Event']['address'],
        'View | Delete'
    );
}
