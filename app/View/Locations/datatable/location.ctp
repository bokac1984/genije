<?php
foreach ($dtResults as $result) {
    $this->dtResponse['aaData'][] = array(
        $result['Location']['id'],
        $result['Location']['name'],
        $result['Location']['address'],
        'View | Delete'
    );
}
