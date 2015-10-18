<?php
App::uses('AppModel', 'Model');
App::uses('CakeTime', 'Utility');
/**
 * Contact Model
 * @property Location $Location
 */
class Event extends AppModel {
       
    public $useTable = 'events'; 
    public $primaryKey = 'id';
    public $displayField = 'name';
    
    public $actsAs = array('Containable');
    
    public $belongsTo = array(
        'Location' => array(
            'className' => 'Location',
            'foreignKey' => 'fk_id_map_objects',
        ),
    );    
    
    public function afterFind($results, $primary = false) {
        parent::afterFind($results, $primary);
        
        foreach ($results as $key => $val) {
            if (isset($val['Event']['online_status'])) {
                $results[$key]['Event']['online_status'] = $this->modifyOnlineStatus($val['Event']['online_status'],$val['Event']['id'], '/events/editStatus/');
            } 
            
            if (isset($val['Event']['start_time'])) {
                $results[$key]['Event']['start_time'] = $this->formatTimeResult($val['Event']['start_time']);
            }
            
            if (isset($val['Event']['end_time'])) {
                $results[$key]['Event']['end_time'] = $this->formatTimeResult($val['Event']['end_time']);
            }
            
            if (isset($val['Event']['fk_id_map_objects'])) {
                $results[$key]['Event']['fk_id_map_objects'] = $this->getLocationName($val['Event']['fk_id_map_objects']);
                //debug($val['Location']);exit();
            }
        }
        return $results;
    }
    
    public function getLocationName($id) {
//        $loc = $this->Location->find('first', array(
//            'conditions' => array(
//                'Location.id' => $id
//            ),
//            'fields' => array(
//                'Location.name'
//            )
//        ));
//        debug($loc);exit();
//        return $loc['Location']['name'];
        return $this->Location->getLocationName($id);
    }
}
