<?php
App::uses('AppModel', 'Model');
/**
 * MapObjectSubtypeRelation Model
 * @property ObjectSubtype $ObjectSubtype
 * ovo je valjda veza izmedju lokacije sa nekim tipom te lokacije
 *
 */
class MapObjectSubtypeRelation extends AppModel {
       
    public $useTable = 'map_objects_subtype_relations';
    /// VAZNO!!! Dodati id kljuc u ovu tabelu
    
    public $belongsTo = array(
        'ObjectSubtype' => array(
            'className' => 'ObjectSubtype',
            'foreignKey' => 'fk_id_object_subtypes',
        ),         
    );
    /**
     * Sacuvamo ali prvo pobrisemo stare :)
     * 
     * @param type $data
     * @return type
     */
    public function saveObjectSubtypes($id, $values = array()) {
        $dataToSave =  array();
        
        $this->deleteAll(array('fk_id_map_objects' => $id));
        
        foreach ($values as $subtype) {
            $dataToSave[]['MapObjectSubtypeRelation'] = array(
                'fk_id_map_objects' => $id,
                'fk_id_object_subtypes' => $subtype
            );
        }
        
        return $this->saveAll($dataToSave);
    }
}
