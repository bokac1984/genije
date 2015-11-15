<?php
foreach ($dtResults as $result) {
    $this->dtResponse['aaData'][] = array(
        $result['Product']['id'],
        $result['Product']['name'],
        $result['Product']['description'],
        'View | Delete'
    );
}
