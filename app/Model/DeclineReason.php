<?php
App::uses('AppModel', 'Model');
/**
 * DeclineReason Model
 *
 */
class DeclineReason extends AppModel {
    public function reasonsForJson() {
        $data = $this->find('all', array('order' => array('DeclineReason.description ASC')));
        $temp =array();
        foreach($data as $reason) {
            $temp[] = $reason['DeclineReason'];
        }
        
        return $temp;
    }
}
